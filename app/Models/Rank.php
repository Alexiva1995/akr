<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ranks';

    protected $fillable = [
        'name', 'description', 'status', 'points'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }

    public function getCurrentRank()
    {
        return $this->hasMany('App\Models\Rank', 'rank_actual_id');
    }
}
