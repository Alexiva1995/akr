<?php

namespace App\Http\Controllers;

use App\Models\OrdenPurchases;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    //

    /**
     * lleva a la vista de informen de pedidos
     *
     * @return void
     */
    public function indexPedidos()
    {

        if($this->isAdmin()){
           
            $ordenes = OrdenPurchases::all();
        }else{
      
            $id = Auth::user()->id;
           
            $ordenes = OrdenPurchases::where('iduser',$id)->get();
        }

        foreach ($ordenes as $orden) {
            $orden->name = $orden->getOrdenUser->fullname;
            $orden->admin = $orden->getOrdenUser->admin;
        }        
        return view('reports.perdido', compact('ordenes'));
    }

    public function UserOrders()
    {
        $user_id = Auth::user()->id;

        $ordenes = OrdenPurchases::where('iduser', $user_id);

        return view('reports.UserOrders', compact('ordenes'));

    }

    /**
     * Permitener las ordenes 
     *
     * @param integer $limite Si limite es igua a 0 es igual a sin limite
     * @return object
     */
    public function getOrdenes($limite): object
    {
        if ($limite == 0) {
            $ordenes = OrdenPurchases::all();
        }else{
            $ordenes = OrdenPurchases::orderBy('id', 'asc')->get()->take($limite);
        }

        foreach ($ordenes as $orden) {
            $orden->name = $orden->getOrdenUser->fullname;
            // $orden->grupo = $orden->getGroupOrden->name;
            // $orden->paquete = $orden->getPackageOrden->name;
        }

        return $ordenes;
    }

    /**
     * Lleva a la vista de informa de comisiones
     *
     * @return void
     */
    public function indexComision()
    {
        $wallets = Wallet::where([
            ['tipo_transaction', '=', 0],
            ['status', '!=', '3']
        ])->get();

        foreach ($wallets as $wallet) {
            $wallet->name = $wallet->getWalletUser->fullname;
            $wallet->referido = $wallet->getWalletReferred->fullname;
        }

        return view('reports.comision', compact('wallets'));
    }

    
    public function graphisDashboard()
    {
        
    }

    public function isAdmin(){
        if(Auth::user()->admin == 1){
            return 1;
        }else{
            return 0;
        }
    }
}
