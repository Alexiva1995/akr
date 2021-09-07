<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\RankRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rangos = Rank::get();

        return view('ranks.index', compact('rangos'));
    }

    
    /**
     * Permite verificar el rango de un usuario
     *
     * @param integer $iduser
     * @return void
     */
    public function testRank()
    {
        Log::info('Inicio Cron CheckRango '.Carbon::now());
        $userRanks = User::all()->where('point_rank', '>', 0);
        foreach ($userRanks as $user) {
            $this->checkRank($user->id);
        }
        Log::info('Fin Cron CheckRango '.Carbon::now());
    }

    public function checkRank(int $iduser)
    {
        $totalRanks = Rank::all()->count();
        $user = User::find($iduser);
        $rol_actual = $user->rank_id;
        $rol_new = ($rol_actual + 1);
        if ($rol_new <= $totalRanks) {
            $rolCheck = Rank::find($rol_new);
            if ($user->point_rank >= $rolCheck->points) {
                $this->saveRanksRecord($rol_new, $rol_actual, $iduser);
            }
        }
    }

    /**
     * Permite actualizar el rango y guardar el registro del mismo 
     *
     * @param integer $rol_new
     * @param integer $rol_actual
     * @param integer $iduser
     * @return void
     */
    public function saveRanksRecord(int $rol_new, int $rol_actual, int $iduser)
    {

        // verifica el rango anterior 
        if($rol_new <= 1){
            $this->guardarRank( $rol_new, $rol_actual, $iduser);
        }else{
            switch ($rol_new) {
                case 2:
                    $izquierda = User::where('status', '1')->where('binary_side', 'I')->where('referred_id', $iduser)->where('rank_id', 1)->first();
                    $derecha = User::where('status', '1')->where('binary_side', 'D')->where('referred_id', $iduser)->where('rank_id', 1)->first();
                    if(isset($izquierda) && isset($derecha)){
                        $this->guardarRank( $rol_new, $rol_actual, $iduser);
                    }
                    break;
                case 3:
                    $izquierda = User::where('status', '1')->where('binary_side', 'I')->where('referred_id', $iduser)->where('rank_id', 2)->first();
                    $derecha = User::where('status', '1')->where('binary_side', 'D')->where('referred_id', $iduser)->where('rank_id', 2)->first();
                    if(isset($izquierda) && isset($derecha)){
                        $this->guardarRank( $rol_new, $rol_actual, $iduser);
                    }
                    break;
                case 4:
                    $izquierda = User::where('status', '1')->where('binary_side', 'I')->where('referred_id', $iduser)->where('rank_id', 3)->first();
                    $derecha = User::where('status', '1')->where('binary_side', 'D')->where('referred_id', $iduser)->where('rank_id', 3)->first();
                    if(isset($izquierda) && isset($derecha)){
                        $this->guardarRank( $rol_new, $rol_actual, $iduser);
                    }
                    break;
                case 5:
                    $izquierda = User::where('status', '1')->where('binary_side', 'I')->where('referred_id', $iduser)->where('rank_id', 4)->first();  
                    $derecha = User::where('status', '1')->where('binary_side', 'D')->where('referred_id', $iduser)->where('rank_id', 4)->first();
                    if(isset($izquierda) && isset($derecha)){
                        $this->guardarRank( $rol_new, $rol_actual, $iduser);
                    }
                    break;
                case 6:
                    $izquierda = User::where('status', '1')->where('binary_side', 'I')->where('referred_id', $iduser)->where('rank_id', 5)->first();
                    $derecha = User::where('status', '1')->where('binary_side', 'D')->where('referred_id', $iduser)->where('rank_id', 5)->first();
                    if(isset($izquierda) && isset($derecha)){
                        $this->guardarRank( $rol_new, $rol_actual, $iduser);
                    }
                    break;
                case 7:
                    $izquierda = User::where('status', '1')->where('binary_side', 'I')->where('referred_id', $iduser)->where('rank_id', 6)->first();
                    $derecha = User::where('status', '1')->where('binary_side', 'D')->where('referred_id', $iduser)->where('rank_id', 6)->first();
                    if(isset($izquierda) && isset($derecha)){
                        $this->guardarRank( $rol_new, $rol_actual, $iduser);
                    }
                    break;                   
                default:
      
                    break;
            }
        }
    }  

    public function guardarRank(int $rol_new, int $rol_actual, int $iduser)
    {
        RankRecord::where([
            ['iduser', '=', $iduser],
            ['rank_actual_id', '=', $rol_actual],
            ['fecha_fin', '=', null]
        ])->update(['fecha_fin' => Carbon::now()]);

        $record = RankRecord::where([
            ['iduser',$iduser],
        ])->first();

        if($record){
            $record->rank_actual_id = $rol_new;
            $record->rank_previou_id = ($rol_actual == 0) ? null: $rol_actual;
            $record->save();
        }else{
            // registra un nuevo rango
            RankRecord::create([
                'iduser' => $iduser, 
                'rank_actual_id' => $rol_new,
                'rank_previou_id' => ($rol_actual == 0)? null : $rol_actual,
                'fecha_inicio' => Carbon::now(),
            ]);        
        }
    
        // actualiza el rango
        User::where('id', $iduser)->update(['rank_id' => $rol_new]); 
    }

    public function currentRank()
    {
        $user = Auth::user();
        // $rango = user::where('id', $user->id)->first(); 

        if($user->rank_id != 0){
            $rango = $user->rank->name;
            $idr = $user->rank->id+1;
            $rango2 = Rank::where('id', $idr)->first();    
            $porcentaje = round((($user->point_rank/$rango2->points)*100),2);
        }else{
            $rango = "Aún no tienes un rango";
            $rango2 = 0;    
            $porcentaje = 0;
        }

        
        return view('ranks.currentRank', compact('rango', 'user', 'porcentaje', 'rango2'));        
    }
}
