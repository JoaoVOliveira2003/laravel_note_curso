<?php
//aqui coloca o caminhi das paginas basicamente!.

/*
primeira parte é a rota, segunda parte é o que vai acontecer quando acessar essa rota
  1 parte: rota
  2 parte: ação
  3 parte: nome da rota (opcional)
*/

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// leva até C:\laragon\www\notes\resou=,rces\views\welcome.blade.php
Route::get('/', function () {return view('welcome');});

Route::get('/olaMundo', function () { echo "Olá Mundo!"; });

//aqui executa a classe lá daquele main
Route::get('/main/{value}',[MainController::class,'index']);

//rotas de autenticação
Route::get( '/login',[AuthController::class,'login']);
Route::post('/loginSubmit',[AuthController::class,'loginSubmit']);
Route::get( '/logout',[AuthController::class,'logout']);
