<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PLuginController extends Controller
{
    public function index(){
       // return "Bienvenido a la página de cursos";
       return view("plugins.index");
    }

    public function create(){
       return view("plugins.create");
    }

    public function show($plugin){
        //return "Url con la variable $curso";
        
        // definición de la variable
        //return view("plugins.show", ['plugin' => $plugin]);

        // Cuando tenemos intención de pasarle una variable a la vista que coincide con el nombre
        return view("plugins.show", compact("plugin"));

    }

}