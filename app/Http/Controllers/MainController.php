<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    public function index(){

        //trazendo do banco
        $id = session('user.id');
        $user  =  User::find($id)->toArray();
        $notes =  User::find($id)->notes()->get()->toArray();

        //echo print_r($user);
        //echo '<br>';
        //echo print_r($notes);

        // die();

        //Carrega usuario além de enviar as notas
        return view('home',['notes'=>$notes]);
    }

    public function newNote(){
        echo 'b';
    }
}
