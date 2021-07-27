<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recetas',[RecetaController::class, 'index'])->name('receta.index');
Route::get('/recetas/create',[RecetaController::class, 'create'])->name('receta.create');
Route::post('/recetas',[RecetaController::class , 'store'])->name('receta.store');
Route::get('/recetas/{receta}',[RecetaController::class , 'show'])->name('receta.show');
Route::get('/recetas/{receta}/edit', [RecetaController::class, 'edit'])->name('receta.edit');
Route::put('/recetas/{receta}', [RecetaController::class, 'update'])->name('receta.update');
Route::delete('/recetas/{receta}', [RecetaController::class, 'destroy'])->name('receta.destroy');

Auth::routes();
