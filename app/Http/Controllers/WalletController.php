<?php

namespace App\Http\Controllers;


use App\Models\OrdenPurchases;
use App\Models\PorcentajeUtilidad;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\InversionController;
use App\Models\CierreComision;
use App\Models\Inversion;
use App\Models\User;
use App\Models\Liquidaction;
use App\Models\WalletBinary;

class WalletController extends Controller
{
    //

    public $treeController;
    public $inversionController;

    public function __construct()
    {
        $this->inversionController = new InversionController;
        $this->treeController = new TreeController;
        View::share('titleq', 'Billetera');
    }

    /**
     * Lleva a la vista de la billetera
     *
     * @return void
     */
    public function index()
    {
        if (Auth::user()->admin == 1) {
            $wallets = Wallet::all()->where('iduser', Auth::user()->id)->where('tipo_transaction', 0);
        } else {
            $wallets = Auth::user()->getWallet->whereIn('tipo_transaction', ['0', '1']);
        }

        //$saldoDisponible = $wallets->where('status', 0)->sum('monto');
        $saldoDisponible = 0;

        foreach ($wallets->where('status', 0) as $monto) {
            if ($monto->tipo_transaction == 1) {

                $monto->monto = $monto->monto * (-1);
            }
            $saldoDisponible += $monto->monto;
        }
        return view('wallet.index', compact('wallets', 'saldoDisponible'));
    }

    /**
     * Lleva a la vista de pagos
     *
     * @return void
     */
    public function payments()
    {

        $payments = Liquidaction::where([['iduser', '=', Auth::user()->id], ['status', '=', '1']])->get();

        return view('wallet.payments', compact('payments'));
    }
    /** 
     * Permite pagar las comisiones a los usuarios
     *
     * @param float $monto
     * @param integer $iduser
     * @param string $name_referred
     * @param integer $idcierre
     * @return void
     */
    public function payComision($monto, $iduser, $name_referred, $inversion_id = null, $orden_id = null, $package_id = null)
    {
        //try {
        $ultimoNivel = 0;
        $comisionAcumulada = 0;
        $user = User::findOrFail(1); //ADMIN

        $sponsors = $this->treeController->getSponsor($iduser, [], 0, 'ID', 'referred_id');
        // dd($sponsors);
        if (!empty($sponsors)) {
            foreach ($sponsors as $sponsor) {
                if ($sponsor->id != $iduser) {
                    $concepto = 'Pago de ' . $name_referred . ' Nivel = ' . $sponsor->nivel;
                    $pocentaje = $this->getPorcentage($sponsor->nivel);
                    $comision = ($monto * $pocentaje);
                    $comisionAcumulada += $comision;
                    if ($sponsor->nivel <= 5) {
                        $ultimoNivel = $sponsor->nivel;
                        if ($sponsor->status == 1) {

                            $this->preSaveWallet($sponsor->id, $iduser, null, $comision, $concepto, $sponsor->nivel, $sponsor->fullname, $pocentaje, $sponsor->reinvertir_comision);
                        } else {
                            $this->preSaveWallet($user->id, $iduser, null, $comision, $concepto, $sponsor->nivel, $user->fullname, $pocentaje);
                        }
                    } else {
                        //$this->preSaveWallet(2, $iduser, $idcierre, $monto, $concepto, $sponsor->nivel, $sponsor->fullname);
                    }
                }
            }
            dump('ultimo nivel');
            dump($ultimoNivel);
            $recorrer = 5 - $ultimoNivel;
            dump('recorrer');
            dump($recorrer);

            //PAGAMOS LAS COMISIONES RESTANTES AL ADMIN
            if ($recorrer > 0) {
                for ($i = 0; $i < $recorrer; $i++) {
                    $ultimoNivel++;
                    $concepto = 'Pago de ' . $name_referred . ' Nivel = ' . $ultimoNivel;
                    $pocentaje = $this->getPorcentage($ultimoNivel);
                    $comision = ($monto * $pocentaje);
                    $comisionAcumulada += $comision;
                    $this->preSaveWallet($user->id, $iduser, null, $comision, $concepto, $ultimoNivel, $user->fullname, $pocentaje);
                }
            }
            //PAGAMOS 10% al admin
            $pocentaje = $this->getPorcentage(6);
            $concepto = "Ganancia de HDLR por ususario " . $name_referred;
            $comision = ($monto * $pocentaje);
            $comisionAcumulada += $comision;
            $user = User::findOrFail(1);
            $this->preSaveWallet($user->id, $iduser, null, $comision, $concepto, 6, $user->fullname, $pocentaje);

            dump('comision acumulada');
            dump($comisionAcumulada);
            //actualizamos la ganancia

            $inversion = Inversion::where([
                //['iduser', '=', $sponsor->id],
                //['package_id', '=', $package_id],
                ['orden_id', '=', $orden_id]
            ])->first();

            $inversion->ganancia_acumulada += $inversion->ganacia - $comisionAcumulada;
            $inversion->ganacia = 0;
            $inversion->capital -= $comisionAcumulada;
            $inversion->save();
        }
        /*} catch (\Throwable $th) {
            Log::error('Wallet - payComision -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }*/
    }

    /**
     * Permita general el arreglo que se guardara en la wallet
     *
     * @param integer $iduser
     * @param integer $idreferido
     * @param integer $idorden
     * @param float $monto
     * @param string $concepto
     * @return void
     */
    public function preSaveWallet(int $iduser, int $idreferido, int $cierre_id = null,  float $monto, string $concepto)
    {
        $data = [
            'iduser' => $iduser,
            'referred_id' => $idreferido,
            'orden_purchases_id' => $cierre_id,
            'monto' => $monto,
            'descripcion' => $concepto,
            'status' => 0,
            'tipo_transaction' => 0,
        ];

        $this->saveWallet($data);
        // $aceleracion = $this->saveWallet($data);
        // if ($aceleracion) {
        //     $this->aceleracion($iduser, $idreferido, $monto, $concepto);
        // }
    }

    public function preSaveWallet2(int $iduser, int $idreferido, int $cierre_id = null,  float $monto, string $concepto)
    {
        $data = [
            'iduser' => $iduser,
            'referred_id' => $idreferido,
            'orden_purchases_id' => $cierre_id,
            'monto' => $monto,
            'descripcion' => $concepto,
            'status' => 0,
            'tipo_transaction' => 0,
        ];

        $this->saveWallet($data);
        // $aceleracion = $this->saveWallet($data);
        // if ($aceleracion) {
        //     $this->aceleracion($iduser, $idreferido, $monto, $concepto);
        // }
    }

    /**
     * Permite obtener el porcentaje a pagar
     *
     * @param integer $nivel
     * @return float
     */
    public function getPorcentage(int $nivel): float
    {
        $nivelPorcentaje = [
            1 => 0.20, 2 => 0.05, 3 => 0.02, 4 => 0.01, 5 => 0.02, 6 => 0.10
        ];

        return $nivelPorcentaje[$nivel];
    }

    /**
     * Permite obtener las compras de saldo de los ultimos 5 dias
     *
     * @param integer $iduser
     * @return object
     */
    public function getOrdens($iduser = null): object
    {
        try {
            $fecha = Carbon::now();
            if ($iduser == null) {
                // $saldos = OrdenPurchases::where([
                //     ['status', '=', 1]
                // ])->whereDate('created_at', '>=', $fecha->subDay(5))->get();
                $saldos = OrdenPurchases::get()->where('status', 1);
            } else {
                $saldos = OrdenPurchases::where([
                    ['iduser', '=', $iduser],
                    ['status', '=', 1]
                ])->whereDate('created_at', '>=', $fecha->subDay(5))->get();
            }
            return $saldos;
        } catch (\Throwable $th) {
            Log::error('Wallet - getOrdes -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite guardar la informacion de la wallet
     *
     * @param array $data
     * @return void
     */
    public function saveWallet($data)
    {
        try {
            //if ($data['iduser'] != 1) {
            if ($data['tipo_transaction'] == 1) {
                $wallet = Wallet::create($data);
                $saldoAcumulado = ($wallet->getWalletUser->wallet - $data['monto']);
                $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                //$wallet->update(['balance' => $saldoAcumulado]);
            } else {
                if ($data['orden_purchases_id'] != null) {
                    if ($data['iduser'] == 2 || $data['iduser'] == 1) {
                        $wallet = Wallet::create($data);
                    } elseif ($data['iduser'] > 2) {
                        $check = Wallet::where([
                            ['iduser', '=', $data['iduser']],
                            ['orden_purchases_id', '=', $data['orden_purchases_id']]
                        ])->first();
                        if ($check == null) {
                            $wallet = Wallet::create($data);
                        }
                    }
                } else {
                    $wallet = Wallet::create($data);
                }

                // dd($wallet->getWalletUser->wallet);
                $saldoAcumulado = ($wallet->getWalletUser->wallet + $data['monto']);
                $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                //$wallet->update(['balance' => $saldoAcumulado]);

                return $wallet->id;
            }
            //}
        } catch (\Throwable $th) {
            Log::error('Wallet - saveWallet -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite obtener el total disponible en comisiones
     *
     * @param integer $iduser
     * @return float
     */
    public function getTotalComision($iduser): float
    {
        try {
            $wallet = Wallet::where([['iduser', '=', $iduser], ['status', '=', 0]])->get()->sum('monto');
            if ($iduser == 1) {
                $wallet = Wallet::where([['status', '=', 0]])->get()->sum('monto');
            }
            return $wallet;
        } catch (\Throwable $th) {
            Log::error('Wallet - getTotalComision -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite obtener el total de comisiones por meses
     *
     * @param integer $iduser
     * @return void
     */
    public function getDataGraphiComisiones($iduser)
    {
        try {
            $totalComision = [];
            if (Auth::user()->admin == 1) {
                $Comisiones = Wallet::select(DB::raw('SUM(monto) as Comision'))
                    ->where([
                        ['status', '<=', 1]
                    ])
                    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                    ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                    ->take(6)
                    ->get();
            } else {
                $Comisiones = Wallet::select(DB::raw('SUM(monto) as Comision'))
                    ->where([
                        ['iduser', '=',  $iduser],
                        ['status', '<=', 1]
                    ])
                    ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                    ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                    ->take(6)
                    ->get();
            }
            foreach ($Comisiones as $comi) {
                $totalComision[] = $comi->Comision;
            }
            return $totalComision;
        } catch (\Throwable $th) {
            Log::error('Wallet - getDataGraphiComisiones -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


    public function pagarUtilidad()
    {
        $inversiones = Inversion::where('status', 1)->get();

        foreach ($inversiones as $inversion) {
            //establecemos maxima ganancia
            if ($inversion->max_ganancia == null) {
                $inversion->max_ganancia = $inversion->invertido * 2;
            }

            $porcentaje = 0.0111;
            $cantidad = $inversion->invertido * $porcentaje;
            $resta = $inversion->max_ganancia - $cantidad;

            if ($resta < 0) { //comparamos si se pasa de lo que puede ganar
                $cantidad = $inversion->max_ganancia;
                $inversion->max_ganancia = 0;
                $inversion->ganacia = $inversion->invertido * 2;
                $inversion->status = 2;
            } else {
                $inversion->max_ganancia = $resta;
                $inversion->ganacia += $cantidad;
            }

            $data = [
                'iduser' => $inversion->iduser,
                'referred_id' => $inversion->iduser,
                'orden_purchases_id' => null,
                'monto' => $cantidad,
                'descripcion' => 'Profit de ' . ($porcentaje * 100) . ' %',
                'status' => 0,
                'tipo_transaction' => 0,
                'orden_purchases_id' => $inversion->orden_id
            ];

            if ($data['monto'] > 0) {
                $wallet = Wallet::create($data);
                $saldoAcumulado = ($wallet->getWalletUser->wallet - $data['monto']);
                $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
            }

            $inversion->save();
        }
    }


    /**
     * Permite pagar el bono directo
     *
     * @return void
     */
    public function bonoDirecto()
    {
        try {
            $ordenes = $this->getOrdens(null);
            // dd($ordenes);
            foreach ($ordenes as $orden) {
                $comision = ($orden->total * 0.1);
                $sponsor = User::find($orden->getOrdenUser->referred_id);
                if ($sponsor->status == '1') {
                    $concepto = 'Bono directo del Usuario ' . $orden->getOrdenUser->fullname;
                    $this->preSaveWallet($sponsor->id, $orden->iduser, $orden->id, $comision, $concepto);
                } else {
                    $concepto = 'Bono directo del Usuario ' . $orden->getOrdenUser->fullname;
                    $this->preSaveWallet($sponsor->id, $orden->iduser, $orden->id, 0, $concepto);
                }
            }
        } catch (\Throwable $th) {
            Log::error('Wallet - bonoDirecto -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    // Metodos para los puntos binarios

    /**
     * Permite pagar los puntos binarios
     *
     * @return void
     */
    public function payPointsBinary()
    {
        try {
            $ordenes = $this->getOrdens(null);
            foreach ($ordenes as $orden) {
                $sponsors = $this->treeController->getSponsor($orden->iduser, [], 0, 'id', 'binary_id');
                $side = $orden->getOrdenUser->binary_side;
                foreach ($sponsors as $sponsor) {
                    if ($sponsor->id != $orden->iduser) {
                        if ($sponsor->id != 1) {

                            $check = WalletBinary::where([
                                ['iduser', '=', $sponsor->id],
                                ['referred_id', '=', $orden->iduser],
                                ['orden_purchase_id', '=', $orden->id]
                            ])->first();
                            if (empty($check)) {
                                $concepto = 'Puntos binarios del Usuario ' . $orden->getOrdenUser->fullname;
                                $puntosD = $puntosI = 0;
                                if ($sponsor->status == '1') {
                                    if ($side == 'I') {
                                        $puntosI = $orden->total;
                                    } elseif ($side == 'D') {
                                        $puntosD = $orden->total;
                                    }
                                }
                                $dataWalletPoints = [
                                    'iduser' => $sponsor->id,
                                    'referred_id' => $orden->iduser,
                                    'orden_purchase_id' => $orden->id,
                                    'puntos_d' => $puntosD,
                                    'puntos_i' => $puntosI,
                                    'side' => $side,
                                    'status' => 0,
                                    'descripcion' => $concepto
                                ];

                                WalletBinary::create($dataWalletPoints);
                            }
                        }
                    }
                    $side = $sponsor->binary_side;
                }
            }
        } catch (\Throwable $th) {
            Log::error('Wallet - payPointsBinary -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite pagar el bono binario
     *
     * @return void
     */
    public function bonoBinario()
    {
        $binarios = WalletBinary::where([
            ['status', '=', 0],
            ['puntos_d', '>', 0],
        ])->orWhere([
            ['status', '=', 0],
            ['puntos_i', '>', 0],
        ])->selectRaw('iduser, SUM(puntos_d) as totald, SUM(puntos_i) as totali')->groupBy('iduser')->get();

        // dd($binarios);

        foreach ($binarios as $binario) {
            // dd('Puntos por la izquierda: '.$binario->totali.'   ||   Puntos por la derecha: '.$binario->totald);

            $puntos = 0;
            $side_mayor = $side_menor = '';
            if ($binario->totald >= $binario->totali) {
                $puntos = $binario->totali;
                $side_mayor = 'D';
                $side_menor = 'I';
                $restante = $binario->totald - $binario->totali;
            } else {
                $puntos = $binario->totald;
                $side_mayor = 'I';
                $side_menor = 'D';
                $restante = $binario->totali - $binario->totald;
            }
            // dd($puntos);
            $sponsor = User::find($binario->iduser);
            $inv = Inversion::where([
                ['iduser', '=', $binario->iduser],
                ['status', '=', 1]
            ])->first();

            if ($inv != null) {
                if ($puntos > 0) {
                    if ($inv->invertido >= 70 && $inv->invertido <= 509) {
                        $por = '5%';
                        $porcentaje = 0.05;
                    } else if ($inv->invertido >= 510 && $inv->invertido <= 1009) {
                        $por = '8%';
                        $porcentaje = 0.08;
                    } else if ($inv->invertido >= 1010) {
                        $por = '10%';
                        $porcentaje = 0.10;
                    }
                    $comision = ($puntos * $porcentaje);
                    // dd('Porcentaje: '.$por.' monto: '.$comision);

                    $concepto = 'Bono Binario - ' . $puntos;
                    // $idcomision = $binario->iduser.Carbon::now()->format('Ymd');
                    $this->setPointBinaryPaid($puntos, $side_menor, $binario->iduser, $side_mayor);
                    $this->preSaveWallet($sponsor->id, $sponsor->id, null, $comision, $concepto);

                    $this->restante($sponsor->id, $restante, $side_mayor, $comision);
                    // $sponsor->save();
                }
            }
        }
    }

    public function restante(int $iduser, $restante, string $ladomayor, float $monto)
    {

        if ($ladomayor == 'I') {
            $puntosD = 0.00;
            $puntosI = $restante;
        } else {
            $puntosI = 0.00;
            $puntosD = $restante;
        }
        $fecha = Carbon::now()->subDay(1);
        WalletBinary::create([
            'iduser' => $iduser,
            'referred_id' => $iduser,
            'puntos_d' => $puntosD,
            'puntos_i' => $puntosI,
            'side' => $ladomayor,
            'status' => 0,
            'restante' => 1,
            'descripcion' => 'Puntos restantes del dia ' . $fecha
        ]);

        $inv = Inversion::where([
            ['iduser', '=', $iduser],
            ['status', '=', 1]
        ])->first();

        if ($inv != null) {
            // $inv = Inversion::where('iduser', '=', $wallet->iduser)->where('status', 1)->first();
            $inv->ganacia += $monto;
            $inv->save();
        }
    }

    /**
     * Permite descontar los puntos ya pagados
     *
     * @param float $pagar
     * @param string $ladomenor
     * @param integer $iduser
     * @param string $ladomayor
     * @return void
     */
    private function setPointBinaryPaid(float $pagar, string $ladomenor, int $iduser, string $ladomayor)
    {
        WalletBinary::where('iduser', $iduser)->update(['status' => '1']);

        // $lisComision = [];
        // $binarios = WalletBinary::where([
        //     ['side', '=', $ladomayor],
        //     ['iduser', '=', $iduser],
        //     ['status', '=', 0]
        // ])->get();
        // $field_side = ($ladomayor == 'D') ? 'puntos_d' : 'puntos_i';
        // $sum = 0;
        // foreach ($binarios as $binario) {
        //     $sum += $binario->$field_side;
        //     if ($sum <= $pagar) {
        //         $lisComision[] = $binario->id;
        //     }elseif($sum > $pagar){
        //         $sum -= $binario->$field_side;  
        //     }
        // }

        // WalletBinary::where([
        //     ['side', '=', $ladomenor],
        //     ['iduser', '=', $iduser],
        //     ['status', '=', 0]
        // ])->update(['status' => '1']);

        // WalletBinary::whereIn('id', $lisComision)->update(['status' => '1']);
    }

    public function payAll()
    {
        // $this->bonoDirecto();
        // Log::info('Bono Directo Pagado');
        $this->payPointsBinary();
        Log::info('Puntos Binarios Pagado');
        // if (env('APP_ENV' != 'local')) {
        $this->bonoBinario();
        // }
    }

    public function flujoDeGanancia()
    {
        $comision = Wallet::where([['tipo_transaction', '0'], ['status', '0']])->get()->sum('monto');

        $ingreso = OrdenPurchases::all()->where('status', '1')->sum('total');
        $retiro = Liquidaction::all()->where('status', '1')->sum('total');
        $fee = Liquidaction::all()->where('status', '1')->sum('feed');
        $profit = Wallet::all();

        return view('profit.index')
            ->with('profit', $profit)
            ->with('comision', $comision)
            ->with('ingreso', $ingreso)
            ->with('retiro', $retiro)
            ->with('fee', $fee);
    }

    public function transaction()
    {
        $transac = OrdenPurchases::where('iduser', Auth::user()->id)->get();;
        return view('regis.transaction')->with('transac', $transac);
    }

    public function retreats()
    {
        $retiro = Liquidaction::where('iduser', Auth::user()->id)->get();

        return view('regis.retreats')->with('retiro', $retiro);
    }




    public function invertion()
    {
        $inver = inversion::where('iduser', Auth::user()->id)->get();

        foreach ($inver as $inv) {

            $orden = OrdenPurchases::find($inv->orden_id);

            $inv->fee = $orden->fee;
        }

        return view('regis.invertion')->with('inver', $inver);
    }

    public function binario()
    {
        $binan = WalletBinary::where('iduser', Auth::user()->id)->get();
        return view('regis.binario')->with('binan', $binan);
    }
}
