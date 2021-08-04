<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorMoneda extends Model
{
    protected $table = 'ValorMoneda';

    
    protected $fillable = [
        'id', 'iduser', 'ValorMoneda',
    ];
}
