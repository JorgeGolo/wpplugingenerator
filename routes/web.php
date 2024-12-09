<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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


/*
Route::get('/', function () {
    //return view('welcome');
return "Bienvenido a mi proyecto de Laravel";
});
*/

Route::get('/', HomeController::class);

/*
Route::get('plugins', function () {
    return "Bienvenido a la página de plugins";
});


Route::get('plugins/create', function () {
    return "Inserción de formulario";
});

Route::get('plugins/{plugin}', function ($plugin) {
    return "Url con la variable $plugin";
});
*/

use App\Http\Controllers\PluginController;

Route::get('/', HomeController::class);

Route::get('plugins', [PluginController::class, 'index']);

Route::get('plugins/create', [PluginController::class, 'create']);

Route::get('plugins/{plugin}', [PluginController::class, 'show']);