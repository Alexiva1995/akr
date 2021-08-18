<?php

namespace App\Http\Controllers;

use App\Models\Crypto_Value;
use App\Models\LiquidationCrypto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LiquidationCryptoController extends Controller
{
   
    public function index()
    {
        try {
            View::share('titleg', 'Generar Liquidaciones');
            $cryptos = $this->getTotalCryptos([], null);
            return view('VTR.Generacion', compact('cryptos'));
        } catch (\Throwable $th) {
            Log::error('Liquidaction Crypto- index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function getTotalCryptos(array $filtros, int $iduser = null): array
    {
        try {
            $cryptos = [];
            if ($iduser != null && $iduser != 1) {
                $cryptostmp = Crypto_Value::where([
                    ['status', '0'],
                    ['liquidation_crypto_id', null],                    
                    ['iduser', $iduser]
                ])->select(
                    DB::raw('sum(cantidad) as total'),
                    'iduser'
                )->groupBy('iduser')->get();
            } else {
                $cryptostmp = Crypto_Value::where([
                    ['status', '0'],
                    ['liquidation_crypto_id', null],                    
                ])->select(
                    DB::raw('sum(cantidad) as total'),
                    'iduser'
                )->groupBy('iduser')->get();
            }

            foreach ($cryptostmp as $crypto) {
                $crypto->user;
                if ($crypto->user != null) {
                    if ($filtros == []) {
                        $cryptos[] = $crypto;
                    } else {
                        if (!empty($filtros['activo'])) {
                            if ($crypto->status == 1) {
                                if (!empty($filtros['mayorque'])) {
                                    if ($crypto->total >= $filtros['mayorque']) {
                                        $cryptos[] = $crypto;
                                    }
                                } else {
                                    $cryptos[] = $crypto;
                                }
                            }
                        } else {
                            if (!empty($filtros['mayorque'])) {
                                if ($crypto->total >= $filtros['mayorque']) {
                                    $cryptos[] = $crypto;
                                }
                            } else {
                                $cryptos[] = $crypto;
                            }
                        }
                    }
                }
            }
            return $cryptos;
        } catch (\Throwable $th) {
            Log::error('Liquidaction Crypto - getTotalCrypto -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function show($id)
    {
        try {
            $cryptos = Crypto_Value::where([
                ['status', '0'],
                ['liquidation_crypto_id',  null],
                ['iduser', '=', $id]
            ])->get();

            foreach ($cryptos as $crypto) {
                $fecha = new Carbon($crypto->created_at);
                $crypto->fecha = $fecha->format('Y-m-d');
                // $comi->referido = User::find($comi->referred_id)->only('fullname');
            }

            $user = User::find($id);

            $detalles = [
                'iduser' => $id,
                'fullname' => $user->fullname,
                'cryptos' => $cryptos,
                'total' => number_format($cryptos->sum('cantidad'), 2, ',', '.')
            ];

            return json_encode($detalles);
        } catch (\Throwable $th) {
            Log::error('Liquidaction Crypto - show -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->tipo == 'detallada') {

            $validate = $request->validate([
                'listComisiones' => ['required', 'array'],
                'iduser' => ['required']
            ]);
        } else {
            $validate = $request->validate([
                'listUsers' => ['required', 'array']
            ]);
        }

        try {
            if ($validate) {
                if ($request->tipo == 'detallada') {
                    $this->generarLiquidationCrypto($request->iduser, $request->listComisiones);
                } else {
                    foreach ($request->listUsers as $iduser) {
                        $this->generarLiquidationCrypto($iduser, []);
                    }
                }
                return redirect()->back()->with('msj-success', 'Liquidaciones Generada Exitoxamente');
            }
        } catch (\Throwable $th) {
            Log::error('LiquidactionCrypto- store -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function generarLiquidationCrypto(int $iduser, array $listComision)
    {
        try {
            $user = User::find($iduser);
            $comisiones = collect();

            if ($listComision == []) {
                $comisiones = Crypto_Value::where([
                    ['iduser', $iduser],
                    ['status', '0'],
                ])->get();
            } else {
                $comisiones = Crypto_Value::whereIn('id', $listComision)->get();
            }

            $total = $comisiones->sum('cantidad');
            // $feed = ($bruto * 0.10);
            // $total = ($bruto - $feed);

            $arrayLiquidation = [
                'iduser' => $iduser,
                'total' => $total,
                'hash',
                'wallet_used' => $user->wallet_address,
                'status' => 0,
            ];

            $idLiquidation = $this->saveLiquidationCrypto($arrayLiquidation);

            $arrayWallet = [
                'iduser' => $user->id,
                'cantidad' => $total,
                'status' => '0',
                'liquidation_crypto_id' => $idLiquidation
            ];

            // $this->saveCryptoValue($arrayWallet);

            if (!empty($idLiquidation)) {
                $listComi = $comisiones->pluck('id');
                Crypto_Value::whereIn('id', $listComi)->update([
                    'status' => '1',
                    'liquidation_crypto_id' => $idLiquidation
                ]);
            }
        } catch (\Throwable $th) {
            Log::error('LiquidactionCrypto - generarLiquidationCrypto -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function saveLiquidationCrypto(array $data): int
    {
        try{            
            $liquidacion = LiquidationCrypto::create($data);
            return $liquidacion->id;

        } catch (\Throwable $th) {
            Log::error('LiquidactionCrypto - saveLiquidationCrypto -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
    
    public function saveCryptoValue(array $data)
    {
        Crypto_Value::create($data);

    }

    public function pendientes()
    {
        try {
            View::share('titleg', 'Liquidaciones Pendientes');
            $cryptos = LiquidationCrypto::where('status', 0)->get();
            foreach ($cryptos as $liqui) {
                $liqui->fullname = $liqui->getUserLiquidation->fullname;
            }
            return view('VTR.Pendientes', compact('cryptos'));
        } catch (\Throwable $th) {
            Log::error('LiquidactionCrypto - indexPendientes -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function edit($id)
    {
        try {
            $cryptos = Crypto_Value::where([
                ['liquidation_crypto_id', '=', $id],
            ])->get();

            foreach ($cryptos as $crypto) {
                $fecha = new Carbon($crypto->created_at);
                $crypto->fecha = $fecha->format('Y-m-d');
            }
            $user = User::find($cryptos->pluck('iduser')[0]);

            $detalles = [
                'idliquidaction' => $id,
                'iduser' => $user->id,
                'fullname' => $user->fullname,
                'cryptos' => $cryptos,
                'total' => number_format($cryptos->sum('cantidad'), 2, ',', '.')
            ];

            return json_encode($detalles);
        } catch (\Throwable $th) {
            Log::error('LiquidactionCrypto - edit -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function procesarLiquidacion(Request $request)
    {
        if ($request->action == 'aproved') {
            $validate = $request->validate([
                'hash' => ['required'],
            ]);
        } else {
            $validate = 1;
        }
        try {
            if ($validate) {
                $idliquidation = $request->idliquidation;
                $accion = 'No Procesada';
                if ($request->action == 'reverse') {
                    $accion = 'Reversada';
                    $this->reversarLiquidacionCrypto($idliquidation);
                } elseif ($request->action == 'aproved') {
                    $accion = 'Aprobada';
                    $this->aprobarLiquidacionCrypto($idliquidation, $request->hash);
                }

                return redirect()->back()->with('msj-success', 'La Liquidacion fue ' . $accion . ' con exito');
                
            }
        } catch (\Throwable $th) {
            Log::error('LiquidactionCrypto - procesarLiquidacion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite aprobar las liquidaciones
     *
     * @param integer $idliquidation
     * @param string $hash
     * @return void
     */
    public function aprobarLiquidacionCrypto($idliquidation, $hash)
    {
        LiquidationCrypto::where('id', $idliquidation)->update([
            'status' => '1',
            'hash' => $hash
        ]);

        Crypto_Value::where('liquidation_crypto_id', $idliquidation)->update(['status' => '1']);
    }

    public function reversarLiquidacionCrypto($idliquidation)
    {
        $liquidacion = LiquidationCrypto::find($idliquidation);

        Crypto_Value::where('liquidation_crypto_id', $idliquidation)->update([
            'status' => '0',
            'liquidation_crypto_id' => null,
        ]);

        $liquidacion->status = '2';
        $liquidacion->save();
    }

    public function indexHistory($status)
    {
        try {
            View::share('titleg', 'Liquidaciones ' . $status);
            $estado = ($status == 'Reservadas') ? 2 : 1;
            $liquidaciones = LiquidationCrypto::where('status', $estado)->get();
            foreach ($liquidaciones as $liqui) {
                $liqui->fullname = $liqui->getUserLiquidation->fullname;
            }
            return view('VTR.historys', compact('liquidaciones', 'estado'));
        } catch (\Throwable $th) {
            Log::error('Liquidaction - indexHistory -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

}
