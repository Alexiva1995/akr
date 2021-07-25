<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{

    protected $table = 'groups';

    protected $fillable = [
        'name', 'status', 'description', 'img','package','ganacia', 'progreso','email'
    ];


    /**
     * Permite obtener todos los paquetes de un grupo
     *
     * @return void
     */
    public function getPackage()
    {
        return $this->hasMany('App\Models\Packages', 'group_id');
    }

    /**
     * Permite obtener todos los paquetes de un grupo
     *
     * @return void
     */
    public function getOrdenPurchase()
    {
        return $this->hasMany('App\Models\OrdenPurchases', 'group_id');
    }
}
