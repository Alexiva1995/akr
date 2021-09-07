<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankRecord extends Model
{
    use HasFactory;

    protected $table = 'rank_records';

    protected $fillable = [
        'iduser', 'rank_actual_id', 'rank_previou_id',
        'fecha_inicio', 'fecha_fin'
    ];

    public function rank()
    {
        return $this->belongsTo('App\Models\Rank', 'id');
    }
}
