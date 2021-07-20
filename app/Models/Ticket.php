<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public $timestamps = false;
    
    protected $fillable = [
        'iduser','name', 'status', 'priority','issue','email','description','note_admin'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }
}
