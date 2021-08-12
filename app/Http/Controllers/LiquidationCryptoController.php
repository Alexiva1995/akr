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

}
