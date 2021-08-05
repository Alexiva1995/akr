<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\View;
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
            
            if($tipo == 1){
                View::share('titleg', 'Inversiones Activas');        
            }elseif($tipo == 2){
                View::share('titleg', 'Inversiones Culminadas');        
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
                ['status', '=', 1],
            ])->first();
            if ($check == null) {
                // dd('No hay inversion');
                $data = [
                    'iduser' => $iduser,
                    'orden_id' => $orden,
                    'invertido' => $invertido-10,
                    'ganacia' => 0,
                    'retiro' => 0,
                    'capital' => $invertido-10,
                    'progreso' => 0,
                    // 'fecha_vencimiento' => $vencimiento,
                ];
                Inversion::create($data);
            }else{
                $check->invertido += $invertido-10;
                $check->capital += $invertido-10;
                $check->save();
                // dd("Al parecer todo salio bien, revisa");
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
