<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //volta a tela login
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {

        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            //mensagem de erro
            [
                'text_username.required' => 'O username é obrigatorio',
                'text_username.email' => 'O username deve ser um email',

                'text_password.required' => 'Deve escrever senha.',
                'text_password.min' => 'Deve ter :min caracteres.',
                'text_password.max' => 'Deve ter :max caracteres',
            ]

        );

        // $nome = $request ->input('text_username');
        // echo $nome . '<br>';
        // echo $request ->input('text_password');

        try {
            DB::connection()->getPdo();
            echo 'deu boa';
        } catch (\PDOException $e) {
            echo 'deu b.o' . $e->getMessage();
        }
    }

    public function logout() {}
}
