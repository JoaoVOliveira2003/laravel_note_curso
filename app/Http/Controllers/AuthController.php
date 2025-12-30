<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        //Validação dos inputs:

        // $request->validate(
        //     [
        //         'text_username' => 'required|email',
        //         'text_password' => 'required|min:6|max:16'
        //     ],
        //     //mensagem de erro
        //     [
        //         'text_username.required' => 'O username é obrigatorio',
        //         'text_username.email' => 'O username deve ser um email',

        //         'text_password.required' => 'Deve escrever senha.',
        //         'text_password.min' => 'Deve ter :min caracteres.',
        //         'text_password.max' => 'Deve ter :max caracteres',
        //     ]
        // );

        // $nome = $request ->input('text_username');
        // echo $nome . '<br>';
        // echo $request ->input('text_password');
        // try {
        //     DB::connection()->getPdo();
        //     echo 'deu boa';
        // } catch (\PDOException $e) {
        //     echo 'deu b.o' . $e->getMessage();
        // }

        // pegar todos usuarios do banco
        //basicamente um select * from User
        // $user = User::all()->toArray();


        //criando um objeto
        // $userModel = new User();
        // $user = $userModel->all()->toArray();
        // echo '<pre>';
        // print_r($user);

        $text_username = $request->input('text_username');
        $text_password = $request->input('text_password');

        $user = User::where('username',$text_username)->where('deleted_at',NULL)->first();
        // echo '<pre>' .  $user;

        //ver se tem algum usuario aqui dentro
        if(!$user){
            return redirect()->back()->withInput()->with('loginError','dados errados');
        }

        //verificação de senha
        if(!password_verify($text_password,$user->password)){
            return redirect()->back()->withInput()->with('loginError','Erro na senha');
        }

        //isso é um update no banco, serio!
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //variaveis de sessão
        session([
            'user'=>[
                'id'=>$user->id,
                'username'=>$user->username,
            ]
        ]);

        echo session('user.id');

        // echo  '<pre>';
        // echo  $user;
    }

    public function logout() {
        //logout da aplicação

        //sempre que rodar isso, limpa essa variavel
        session()->forget('user');

        //manda para a rota que escreveu
        return redirect()->to('/login');
    }
}
