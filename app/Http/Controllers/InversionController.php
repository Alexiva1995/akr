<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class InversionController extends Controller
{
    /**
     * Lleva a a la vista de las inversiones
     *
     * @param [type] $tipo
     * @return void
     */
    public function index($tipo)    
    {
       
       try {
           $this->checkStatus();
            if ($tipo == '') {
                $inversiones = Inversion::all();
            } else {
                if (Auth::id() == 1) {
                    $inversiones = Inversion::where('status', '=', $tipo)->get();
                }else{
                    $inversiones = Inversion::where([['status', '=', $tipo], ['iduser', '=',Auth::id()]])->get();
                }
            }

            foreach ($inversiones as $inversion) {
                $inversion->correo = $inversion->getInversionesUser->email;
            }
            
            return view('inversiones.index', compact('inversiones', 'tipo'));
        } catch (\Throwable $th) {
            Log::error('InversionController - index -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    // Asi estaba Anteriormente
    // public function saveInversion(int $paquete, int $orden, float $invertido, string $vencimiento, int $iduser)
    public function saveInversion(int $orden, $invertido, int $iduser)
    {
        try {
            $check = Inversion::where([
                ['iduser', '=', $iduser],
                // ['package_id', '=', $paquete],
                ['orden_id', '=', $orden],
            ])->first();
            if ($check == null) {
                $data = [
                    'iduser' => $iduser,
                    // 'package_id' => $paquete,
                    'orden_id' => $orden,
                    'invertido' => $invertido,
                    'ganacia' => 0,
                    'retiro' => 0,
                    'capital' => $invertido,
                    'progreso' => 0,
                    // 'fecha_vencimiento' => $vencimiento,
                ];
                Inversion::create($data);
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - saveInversion -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


    public function checkStatus()
    {
        Inversion::whereDate('fecha_vencimiento', '<', Carbon::now())->update(['status' => 2]);
    }

    public function updateGanancia(int $iduser, $paquete, float $ganacia, int $ordenId=0, $porcentaje=null)
    {
        try {
            if($ordenId != 0){
                $inversion = Inversion::where([
                    ['iduser', '=', $iduser],
                    ['status', '=', 1],
                    ['orden_id', '=',$ordenId]
                ])->first();
            }else{
                $inversion = Inversion::where([
                    ['iduser', '=', $iduser],
                    ['status', '=', 1]
                ])->first();
            }
          
            if ($inversion != null) {
             
                $capital = ($inversion->capital + $ganacia);
                $inversion->ganacia = ($inversion->ganacia + $ganacia);
                $inversion->capital = $capital;      
                $inversion->porcentaje_fondo = $porcentaje;
          
                $inversion->save();
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - updateGanancia -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

     public function updatePorcentaje(int $iduser, int $paquete, float $ganacia, int $ordenId=0, $porcentaje=null)
    {
        try {
            if($ordenId != 0){
                $inversion = Inversion::where([
                    ['iduser', '=', $iduser],
                    ['status', '=', 1],
                    ['orden_id', '=',$ordenId]
                ])->first();
            }else{
                $inversion = Inversion::where([
                    ['iduser', '=', $iduser],
                    ['package_id', '=', $paquete],
                    ['status', '=', 1]
                ])->first();
            }
        
            if ($inversion != null) {
                
                $inversion->porcentaje_fondo = $porcentaje;
          
                $inversion->save();
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - updateGanancia -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function test(){
        $texto = "me llamo luis";
        Storage::append('text.txt', $texto);
    }
}
