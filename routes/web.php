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

//Route::get('plugins', [PluginController::class, 'index']);

// uso de name en la ruta

Route::get('plugins', [PluginController::class, 'index'])->name('plugins.index');

Route::get('plugins/create', [PluginController::class, 'create'])->name('plugins.create');;

Route::get('plugins/{plugin}', [PluginController::class, 'show'])->name('plugins.show');

Route::post('plugins', [PluginController::class, 'store'])->name('plugins.store');

// Route::get('plugins/{id}/edit', [PluginController::class, 'edit'])->name('plugins.edit');
Route::get('plugins/{plugin}/edit', [PluginController::class, 'edit'])->name('plugins.edit');

Route::put('plugins/{plugin}', [PluginController::class, 'update'])->name('plugins.update');

Route::delete('plugins/{plugin}',[PluginController::class, 'destroy'])->name('plugins.destroy');

Route::get('plugins/{plugin}/generate', [PluginController::class, 'generate'])->name('plugins.generate');

/* uso de group */

/*

Route::controller(CursoController::class)->group(function(){
    Route::get('cursos','index');
    Route::get('cursos/create','create');
    Route::get('cursos/{curso}','show');
});

*/