<?php
//aqui coloca o caminhi das paginas basicamente!.

/*
primeira parte é a rota, segunda parte é o que vai acontecer quando acessar essa rota
  1 parte: rota
  2 parte: ação
  3 parte: nome da rota (opcional)
*/
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// leva até C:\laragon\www\notes\resou=,rces\views\welcome.blade.php
// Route::get('/', function () {return view('welcome');});
Route::get('/olaMundo', function () { echo "Olá Mundo!"; });
//aqui executa a classe lá daquele main
Route::get('/main/{value}',[MainController::class,'index']);


//rotas de autenticação
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get( '/login',[AuthController::class,'login']);
    Route::post('/loginSubmit',[AuthController::class,'loginSubmit']);
});

//introdução a middleware(programa que tem que passar,aquela coisa de ver se esta online)
Route::middleware([CheckIsLogged::class])->group(function(){

    Route::get('/',[MainController::class,'index'])->name('home');
    Route::get( '/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/editNote/{id}',[MainController::class,'editNote'])->name('edit');
    Route::post('/editNoteSubmit',[MainController::class,'editNoteSubmit'])->name('editNoteSubmit');

    Route::get('/deleteNote/{id}',[MainController::class,'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}',[MainController::class,'deleteNoteConfirm'])->name('deleteConfirm');


    Route::get('/newNote',[MainController::class,'newNote'])->name('new');
    Route::post('/newNoteSubmit',[MainController::class,'newNoteSubmit'])->name(name: 'newNoteSubmit');
});
