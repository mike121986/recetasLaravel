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

Auth::routes();
