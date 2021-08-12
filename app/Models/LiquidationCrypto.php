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
    ];}
