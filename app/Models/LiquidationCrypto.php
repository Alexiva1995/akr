<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiquidationCrypto extends Model
{
    protected $table = 'liquidation_cryptos';
    
    protected $fillable = [
        'iduser', 'total', 'hash',
        'wallet_used', 'status'
    ];

    /**
     * Permite la informacion del usuario que se esta liquidando
     *
     * @return void
     */
    public function getUserLiquidation()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }

}
