<?php

namespace App\Http\Controllers;

use App\Models\Crypto_Value;
use App\Models\cryptos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\Liquidaction;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;

use App\Http\Controllers\WalletController;

use Illuminate\Support\Facades\Auth;


class CryptoValueController extends Controller
{



    //====================//
    // Permite asignar un valor y un procenteje de maneda//
    //====================//

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
           //$total = $this->getTotalComisiones([], null);
            return view('VTR.Generacion', compact('cryptos'));
        } catch (\Throwable $th) {
            Log::error('VTR - index -> Error: ' . $th);
        abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


    public function Pendientes()
    {
        try {
            View::share('titleg', 'Liquidaciones Pendientes');
            $indexs = Crypto_Value::where('status', 0)->get();
            foreach ($indexs as $index) {
                $index->fullname = $index->User->fullname;
            }
            return view('VTR.Pendientes', compact('indexs'));
        } catch (\Throwable $th) {
            Log::error('Liquidaction - indexPendientes -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function indexHistorys($status)
    {
     try {
            View::share('titleg', 'Liquidaciones ' . $status);
            $estado = ($status == 'Reservadas') ? 2 : 1;
            $liquidaciones = Crypto_Value::where('status', $estado)->get();
            foreach ($liquidaciones as $liqui) {
                $liqui->fullname = $liqui->getUserLiquidation->fullname;
            }
            return view('VTR.historys', compact('liquidaciones', 'estado'));
       } catch (\Throwable $th) {
           Log::error('Liquidaction - indexHistory -> Error: ' . $th);
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
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
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
