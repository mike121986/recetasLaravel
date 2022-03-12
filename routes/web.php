<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;

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
Esta ruta nos lleva a la primera ruta que hemos creado ahi tenemos unas notas importante que hice como principiante
Route::get('/recetas', RecetaController::class); */

Route::get('/', function () {
    return view('welcome');
});
/* este rouete nos lleva a donde se visualizan todas las recetas */
Route::get('/recetas',[RecetaController::class,'index'])->name('recetas.index');

// este route nos lleva a donde se crean todas las recetas
Route::get('/recetas/create',[RecetaController::class,'create'])->name('recetas.create');
// este route nos lleva a el controller y es un store
Route::post('/recetas',[RecetaController::class,'store'])->name('recetas.store');
// este route nos lleva a el controlador en un show
Route::get('/recetas/{receta}',[RecetaController::class,'show'])->name('recetas.show');
// este route nos llevara a editar una receta
Route::get('/recetas/{receta}/edit',[RecetaController::class,'edit'])->name('recetas.edit');
// este Route nos manada al apartado donde se llevara la logica para el guardado de la receta que se esta editnado
Route::put('/recetas/{receta}',[RecetaController::class,'update'])->name('recetas.update');
Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
