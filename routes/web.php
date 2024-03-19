<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserController;
use App\Models\Permissions;
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
Route::resource('/aluno', AlunoController::class)->names('CRUD_Aluno');
Route::resource('/permission', PermissionController::class)->names('CRUD_Permission');
Route::resource('/user', UserController::class)->names('CRUD_User');
Route::resource('/turma', TurmaController::class)->names('CRUD_Turma');