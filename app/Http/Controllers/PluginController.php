<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PLuginController extends Controller
{
    public function index(){
        return "Bienvenido a la página de cursos";
    }

    public function create(){
        return "Inserción de formulario";
    }

    public function show($curso){
        return "Url con la variable $curso";
    }
}