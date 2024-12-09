<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    /*return view('welcome');*/
return "Bienvenido a mi proyecto de Laravel";
});


Route::get('plugins', function () {
    return "Bienvenido a la página de plugins";
});

/*
Route::get('plugins/create', function () {
    return "Inserción de formulario";
});
*/

Route::get('plugins/{plugin}', function ($plugin) {
    return "Url con la variable $plugin";
});

Route::get('otrascosas/{subruta}/{otrasubruta}', function($subruta, $otrasubruta) {
    return "Estamos en la ruta $subruta y en la subruta $otrasubruta";
});

Route::get('nuevaruta/{subruta}/{otrasubruta?}', function($subruta, $otrasubruta = null) {
    if ($otrasubruta) {
        return "Estamos en la ruta $subruta y en la subruta $otrasubruta";
    }
    else {
        return "Estamos en la ruta $subruta";
    }
});