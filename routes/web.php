<?php

use App\Http\Controllers\EixoController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/eixo', EixoController::class)->names('CRUD_Eixo');
Route::resource('/nivel', LevelController::class)->names('CRUD_Nivel');
Route::resource('/curso', CursoController::class)->names('CRUD_Cursos');