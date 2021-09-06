<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SobreNosController extends Controller
{
 /*   public function __construct(){
        $this->middleware('log.acesso'); // não precisei usar o use, pois o kernel ja faz isso para nos usarmos apenas o apelido

    }*/

   
    public function sobrenos(){
        return view('site.sobre-nos');
    }
}
