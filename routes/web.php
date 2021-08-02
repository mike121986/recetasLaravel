<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PerfilController;
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

Route::get('/', [InicioController::class, 'index'])->name('inicio.index');

// recetas
Route::get('/recetas',[RecetaController::class, 'index'])->name('receta.index');
Route::get('/recetas/create',[RecetaController::class, 'create'])->name('receta.create');
Route::post('/recetas',[RecetaController::class , 'store'])->name('receta.store');
Route::get('/recetas/{receta}',[RecetaController::class , 'show'])->name('receta.show');
Route::get('/recetas/{receta}/edit', [RecetaController::class, 'edit'])->name('receta.edit');
Route::put('/recetas/{receta}', [RecetaController::class, 'update'])->name('receta.update');
Route::delete('/recetas/{receta}', [RecetaController::class, 'destroy'])->name('receta.destroy');

// perfiles
Route::get('perfiles/{perfil}',[PerfilController::class, 'show'])->name('perfiles.show');
Route::get('perfiles/{perfil}/edit', [PerfilController::class, 'edit'])->name('perfil.edit');
Route::put('/perfiles/{perfil}', [PerfilController::class, 'update'])->name('perfil.update');

// almacena los likes de las recetas
Route::post('/recetas/{receta}',[LikesController::class , 'update'])->name('likes.update');

Auth::routes();
