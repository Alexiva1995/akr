<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cryptos extends Model
{
    protected $table = 'Cryptos';

    
    protected $fillable = [
        'id', 'iduser', '% de monedas',
    ];
}
