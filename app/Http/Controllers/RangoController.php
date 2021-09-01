<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RangoController extends Controller
{
    
    public function index(){

        return view('rangos.index');
    }
}
