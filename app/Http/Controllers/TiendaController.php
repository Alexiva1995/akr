<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\OrdenPurchases;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\InversionController;
use Hexters\CoinPayment\CoinPayment;
use Hexters\CoinPayment\Helpers\CoinPaymentHelper;


class TiendaController extends Controller
{

    public $apis_key_nowpayments;
    public $inversionController;

    public function __construct()
    {
        $this->inversionController = new InversionController();
        $this->apis_key_nowpayments = 'ECQYK47-JYNMC98-GZ3FHBW-WWRH660';
    }
    
    /**
     * Lleva a la vista de la tienda
     *
     * @return void
     */ 
    public function index()
    {
        try {
            // title
            View::share('titleg', 'Paquetes de Inversión');

            // $categories = Groups::all()->where('status', 1);

            return view('shop.index');
        } catch (\Throwable $th) {
            Log::error('Tienda - Index -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }



    public function ordenHistory()
    {
        try {
            // title
            // View::sxhare('titleg', 'Tienda - Grupos');

            $ordenes = OrdenPurchases::all()->where('iduser', '=', Auth::user()->id);

            
            return view('shop.orderhistory', compact('ordenes'));
        } catch (\Throwable $th) {
            // Log::error('Tienda - Index -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }



    /**
     * Lleva a la vista de productos de un paquete en especificio
     *
     * @param integer $idgroup
     * @return void
     */
    public function products($idgroup)
    {
        try {
            // title
            View::share('titleg', 'Tienda - Productos');
            $category = Groups::find($idgroup);
            $services = $category->getPackage->where('status', 1);
            
            return view('shop.products', compact('services'));
        } catch (\Throwable $th) {
            Log::error('Tienda - products -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permiete procesar la orden de compra
     *
     * @param Request $request
     * @return void
     */
    public function procesarOrden(Request $request)
    {
        $validate = $request->validate([
            'idproduct' => 'required',
            'deposito' => 'required|numeric|min:20'
        ]);
    
        try {
            if ($validate) {
                $paquete = Packages::find($request->idproduct);

                $porcentaje = ($request->deposito * 0.03);
                $total = ($request->deposito + $porcentaje);
                
                $data = [
                    'iduser' => Auth::id(),
                    'group_id' => $paquete->getGroup->id,
                    'package_id' => $paquete->id,
                    'cantidad' => $request->deposito,
                    'total' => $total
                ];

                $data['idorden'] = $this->saveOrden($data);
                $data['descripcion'] = $paquete->description;
                //$data['Amount'] = $request->deposito;
                $url = $this->generalUrlOrden($data);
                if (!empty($url)) {
                    return redirect($url);

                }else{
                    OrdenPurchases::where('id', $data['idorden'])->delete();
                    return redirect()->back()->with('msj-info', 'Problemas al general la orden, intente mas tarde');
                }
            }
        } catch (\Throwable $th) {
            Log::error('Tienda - procesarOrden -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Guarda la informacion de las ordenes nuevas 
     *
     * @param array $data
     * @return integer
     */
    public function saveOrden($data): int
    {
        $orden = OrdenPurchases::create($data);
        return $orden->id;
    }

    /**
     * Notifica el estado de la compra una vez realizada
     *
     * @param integer $orden
     * @param string $status
     * @return void
     */
    public function statusProcess($orden, $status)
    {
        $type = ($status == 'Completada') ? 'success' : 'danger';
        $msj = 'Compra '.$status;

        if ($status == 'Completada') {
            $this->registeInversion($orden);
        }

        return redirect()->route('shop')->with('msj-'.$type, $msj);
    }

    /**
     * Permite Registrar las ordenes de forma manual
     *
     * @return void
     */
    public function getOrdenes()
    {
        $ordenes = OrdenPurchases::all()->where('status', '1');
        foreach ($ordenes as $orden) {
            $this->registeInversion($orden->id);
        }
    }

    /**
     * Permite llamar al funcion que registra las inversiones
     *
     * @param integer $idorden
     * @return void
     */
    private function registeInversion($idorden)
    {
        $orden = OrdenPurchases::find($idorden);
        $paquete = $orden->getPackageOrden;
        $this->inversionController->saveInversion($paquete->id, $idorden, $orden->cantidad, $paquete->expired, $orden->iduser);
    }

    /**
     * Permite recibir el estado de las ordenes 
     *
     * @param Request $resquet
     * @return void
     */
    public function ipn(Request $resquet)
    { 
        Log::info('ipn prueba ->', $resquet);
    }

    /**
     * Permite general el url para pagar la compra
     *
     * @param array $data
     * @return string
     */
    private function generalUrlOrden($data): string
    {
       try {
            $headers = [
                'x-api-key: '.$this->apis_key_nowpayments,
                'Content-Type:application/json'
            ];

            $resul = ''; 
            $curl = curl_init();

            $dataRaw = collect([
                'price_amount' => floatval($data['total']),
                "price_currency" => "usd",
                "order_id" => $data['idorden'],
                'pay_currency' => 'USDTTRC20',
                "order_description" => $data['descripcion'],
                "ipn_callback_url" => route('shop.ipn'),
                "success_url" => route('shop.proceso.status', [$data['idorden'], 'Completada']),
                "cancel_url" => route('shop.proceso.status', [$data['idorden'], 'Cancelada']),
                //"Amount" => $data['Amount']
            ]);
            

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.nowpayments.io/v1/invoice",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $dataRaw->toJson(),
                CURLOPT_HTTPHEADER => $headers
            ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    Log::error('Tienda - generalUrlOrden -> Error curl: '.$err);        
                } else {
                    $response = json_decode($response);
                    OrdenPurchases::where('id', $data['idorden'])->update(['idtransacion' => $response->id]);
                    $resul = $response->invoice_url;
                }
                  
            return $resul;
        } catch (\Throwable $th) {
            Log::error('Tienda - generalUrlOrden -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function cambiar_status(Request $request)
    {
        $orden = OrdenPurchases::findOrFail($request->id);
        $orden->status = $request->status;
        $orden->save();

        $this->registeInversion($request->id);

        $user = User::findOrFail($orden->iduser);
        $user->status = '1';
        $user->save();

        return redirect()->back()->with('msj-success', 'Orden actualizada exitosamente');
    }


    public function makeInversion(Request $request)
    {

        $validate = $request->validate([
            'range' => 'required|numeric|min:70|max:10000',
        ]);

        try{
            if($validate){
                $data = OrdenPurchases::latest('id')->first();
                
                $transacion = [
                    'amountTotal' => (INT)$request->range,
                    'note' => 'Inversión realizada por un precio de $'.(INT)$request->range,
                    // 'order_id' => $this->guardarOrden($infoOrden),
                    'order_id' => 1,
                    'tipo' => 'Compra de un paquete',
                    'tipo_transacion' => 3,
                    'buyer_name' => Auth::user()->fullname,
                    'buyer_email' => Auth::user()->email,
                    'redirect_url' => url('/dashboard/home'),
                    'cancel_url' => url('/dashboard/home')
                ];
                $transacion['items'][] = [
                    'itemDescription' => 'Inversión de  $'.(INT)$request->range,
                    'itemPrice' => (INT)$request->range, // USD
                    'itemQty' => (INT) 1,
                    'itemSubtotalAmount' => (INT)$request->range + 10 // USD
                ];
                $ruta = \CoinPayment::generatelink($transacion);
                return redirect($ruta);
            }
        } catch (\Throwable $th) {
            Log::error('Tienda - MakeInversion -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    

        // $product = ProductWarehouse::find($id);
        $user = Auth::user()->id;
        $hayData = $data? $data->id+1 : 1;

        $infoOrden = [
            'user_id' => Auth::user()->id,
            // 'product_id' => $product->id,
            // 'amount' => $product->price,
            'status' => '0'
        ];
    }

    public function guardarOrden($infoOrden)
    {
        $orden = OrdenPurchases::create($infoOrden);

        return $orden->id;

    }
}
