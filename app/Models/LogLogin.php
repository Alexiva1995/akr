<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    protected $table = 'log_logins';

    protected $fillable = [
        'iduser', 
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }    
}
