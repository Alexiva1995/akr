<?php

namespace App\Http\Controllers;

use App\Models\Crypto_Value;
use App\Models\cryptos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CryptoValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cryptos = Crypto_Value::all();
            View::share('titleg', 'Generar VTR');
           $total = $this->getTotalLiquidaciones([], null);
            return view('VTR.Generacion', compact('cryptos'));
        } catch (\Throwable $th) {
            Log::error('VTR - index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function getTotalLiquidaciones(array $filtros, int $iduser = null): array
    {
        try {
            $cryptos = [];
            if ($iduser != null && $iduser != 1) {
                $cryptostmp = Crypto_Value::where([
                    ['status', '=', 0],
                    ['liquidation_crypto_id', '=', null],
                    // ['tipo_transaction', '=', 0],
                    ['iduser', '=', $iduser]
                ])->select(
                    DB::raw('sum(cantidad) as total'),
                    'iduser'
                )->groupBy('iduser')->get();
            } else {
                $cryptostmp = Crypto_Value::where([
                    ['status', '=', 0],
                    ['liquidation_crypto_id', '=', null],
                    // ['tipo_transaction', '=', 0],
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
            Log::error('VTR - getTotalComisiones -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function cryptos(Request $request)
    {
        $validate = $request->validate([
            
            'porcentaje_de_monedas' => 'required|numeric',
            'valor' => 'required|numeric'
            
        ]);
        try {
            if ($validate) {
    
                cryptos::create([
                    'porcentaje_de_cryptos' => (int)$request->porcentaje_de_monedas,
                    'valor' => (int)$request->valor
               
                ]);

                return redirect()->back()->with('msj-success', 'Operación Generada Exitosamente');

            }
        } catch (\Throwable $th) {
            Log::error('VTR - Cryptos -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

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
                    $this->generarLiquidation($request->iduser, $request->listComisiones);
                } else {
                    foreach ($request->listUsers as $iduser) {
                        $this->generarLiquidation($iduser, []);
                    }
                }
                return redirect()->back()->with('msj-success', 'Liquidaciones Generada Exitoxamente');
            }
        } catch (\Throwable $th) {
            Log::error('VTR - store -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
