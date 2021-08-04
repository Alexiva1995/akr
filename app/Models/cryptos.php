<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cryptos extends Model
{
    protected $table = 'cryptos';

    protected $fillable = [
        'porcentaje_de_cryptos' 
       ];

}
