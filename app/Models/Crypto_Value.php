<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto_Value extends Model
{
    protected $table = 'Crypto_Value';

    protected $fillable = [
        'iduser','cantidad', 'status'
    ];

    public function user(){
        return $this->belongsto('App\Models\User', 'iduser', 'id', 'email');
    }
    
}
