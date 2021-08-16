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
use App\Models\Inversion;
use App\Models\Wallet;
use Hexters\CoinPayment\CoinPayment;
use Hexters\CoinPayment\Helpers\CoinPaymentHelper;
use App\Models\cryptos;
use \App\Models\Crypto_Value;

class TiendaController extends Controller
{

    public $apis_key_nowpayments;
    public $inversionController;
    public $walletController;

    public function __construct()
    {
        $this->inversionController = new InversionController();
        $this->walletController = new WalletController;
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
        
        // Asi estaba Anteriormente        
        // $paquete = $orden->getPackageOrden;
        // $this->inversionController->saveInversion($paquete->id, $idorden, $orden->cantidad, $paquete->expired, $orden->iduser);
        $this->inversionController->saveInversion($idorden, $orden->total, $orden->iduser);
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

        $user = User::findOrFail($orden->iduser);

        $this->registeInversion($request->id);
        if($request->status == '1'){
            $this->registerDirectBonus($request->id);
        
            $last = Wallet::get()->last();
            $this->investment($last->id);
            
            $this->walletController->payPointsBinary();

            if($user->status == '0'){
                $user->status = '1';
                $user->save();
            }
            if($request->status == '1'){
             try{
               
                   $crypto = cryptos::orderBy('id', 'desc')->first();
             
                   // aqui obtengo el ultimo valor de la tabla         $ordenes = Ordenes::where('status', '=', 1)->get(); // obtengo todas las ordenes activas        foreach ($ordenes as $orden) {
                    
                       $resulPorcentage = ($orden->total * $crypto->porcentaje_de_cryptos); // multiplico la cantidad entre el porcentaje final obtenido
                       $resultDivision = ($resulPorcentage / $crypto->valor);
                       
                      
                       // divido el resultado del porcentaje por el valor del crypto final obtenido            //Aqui guardo toda la informacion de la transacion anterior
                      
                      Crypto_Value::create([
                          'iduser' => $orden->iduser,
                           'cantidad' => $resultDivision,
                           'status' => 1,
                          
                       ]);}
                      
                       catch (\Throwable $th) {
                        Log::error('Tienda - generalUrlOrden -> Error: '.$th);
                        abort(403, "Ocurrio un error, contacte con el administrador");
                    }
               }        
              
        
        }

    
      
        // return redirect('/dashboard/reports/purchase')->with('msj-success', 'Orden actualizada exitosamente');
        //  $user->notify(new \App\Notifications\Order_approved);
        return redirect('/dashboard/reports/purchase')->with('msj-success', 'Orden actualizada exitosamente'); 
    }

    public function registerDirectBonus($id)
    {
        $orden = OrdenPurchases::findOrFail($id);
        $comision = ($orden->total * 0.1);
        $sponsor = User::find($orden->getOrdenUser->referred_id);
        if ($sponsor->status == '1') {
            $concepto = 'Bono directo del Usuario '.$orden->getOrdenUser->fullname;
            $this->walletController->preSaveWallet2($sponsor->id, $orden->iduser, $orden->id, $comision, $concepto);
        }else{
            $concepto = 'Bono directo del Usuario '.$orden->getOrdenUser->fullname;
            $this->walletController->preSaveWallet2($sponsor->id, $orden->iduser, $orden->id, 0, $concepto);
        }
    }

    public function makeInversion(Request $request)
    {

        $validate = $request->validate([
            'range' => 'required|numeric|min:70|max:10000',
        ]);

        try{
            if($validate){
            
                $usuario = [];
                if(isset($request->user)){
                    $usuario = User::findOrFail($request->user);     

                    $infoOrden = [
                        'iduser' => $usuario->id,
                        'cantidad' => 1,
                        'total' => $request->range+10,
                        'status' => 1,
                    ];

                    $saveOrden = $this->guardarOrden($infoOrden);

                    if($saveOrden){
                        $usuario->update(['status'=>'1']);

                        $orden = OrdenPurchases::findOrFail($saveOrden);
                        $orden->status = "1";
                        $orden->save();

                        $this->registeInversion($saveOrden);

                        if(isset($request->comision)){
                            $this->registerDirectBonus($saveOrden);
                            $last = Wallet::get()->last();
                            $this->investment($last->id);
                            
                            $this->walletController->payPointsBinary();
                        }

                        return redirect('/dashboard/user/user-list')->with('msj-success', 'Orden creada - Cliente verificado');
                    }

                }else{
                     $infoOrden = [
                         'iduser' => Auth::user()->id,
                        //  'status' => 0,
                         'cantidad' => 1,
                         'total' => $request->range,
                     ];
                    
                    $transacion = [
                        'amountTotal' => (INT)$request->range +10,
                        'note' => 'Inversión realizada por un precio de $'.(INT)$request->range,
                        'order_id' => $this->guardarOrden($infoOrden),
                        'tipo' => 'Compra de un paquete',
                        'tipo_transacion' => 3,
                        'buyer_name' =>  Auth::user()->fullname,
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

            }
        } catch (\Throwable $th) {
            Log::error('Tienda - MakeInversion -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    

        // $product = ProductWarehouse::find($id);
        // $user = Auth::user()->id;
        // $hayData = $data? $data->id+1 : 1;

        // $infoOrden = [
        //     'user_id' => Auth::user()->id,
        //     // 'product_id' => $product->id,
        //     // 'amount' => $product->price,
        //     'status' => '0'
        // ];
    }

    public function investment($id)
    {

        try{
            $wallet = Wallet::findOrFail($id);

            $inv = Inversion::where([
                ['iduser', '=', $wallet->iduser],
                ['status', '=', 1]
            ])->first();            

            if($inv != null){
                // $inv = Inversion::where('iduser', '=', $wallet->iduser)->where('status', 1)->first();
                $inv->ganacia += $wallet->monto;
                $inv->save();
            }

        } catch (\Throwable $th) {
            Log::error('Tienda - investment -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }

    }

    public function guardarOrden($infoOrden)
    {
        $orden = OrdenPurchases::create($infoOrden);

        return $orden->id;
    }
}
