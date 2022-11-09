<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    //Aller à la page Home
    public function director()
    {
        $data = ['InfoActeur'=>Acteurs::where('id','=',session('acteursid'))->first()];
        return view('director.home', $data);
    }
}
