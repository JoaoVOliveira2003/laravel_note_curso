<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\User;
use App\services\Operations;

class MainController extends Controller
{
    public function index()
    {

        //trazendo do banco
        $id = session('user.id');
        $user  =  User::find($id)->toArray();
        $notes =  User::find($id)->notes()->Wherenull('deleted_at')->get()->toArray();

        //echo print_r($user);
        //echo '<br>';
        //echo print_r($notes);

        // die();

        //Carrega usuario além de enviar as notas
        return view('home', ['notes' => $notes]);
    }

    // private function descriptar($id){
    //     try {
    //         $id = Crypt::decrypt($id);
    //     } catch (DecryptException $e) {
    //         return redirect()->route('home');
    //     }
    //     return $id;
    // }

    //envia para a tela do formulario da nota
    public function newNote()
    {
        return view('new_note');
    }

    //Provavelmente é o insert no banco
    public function newNoteSubmit(Request $request)
    {

    $request->validate(
        [
            'text_title' => 'required|min:3|max:200',
            'text_note'  => 'required|min:3|max:3000'
        ],
        [
            'text_title.required' => 'O título é obrigatório.',
            'text_title.min'      => 'O título deve ter no mínimo :min caracteres.',
            'text_title.max'      => 'O título pode ter no máximo :max caracteres.',

            'text_note.required'  => 'O texto é obrigatório.',
            'text_note.min'       => 'O texto deve ter no mínimo :min caracteres.',
            'text_note.max'       => 'O texto pode ter no máximo :max caracteres.',
        ]
    );

    //pegar id
    $id = session('user.id');

    // echo 'ok';
    $note = new Note();
    $note->user_id = $id;
    $note->title = $request->text_title;
    $note->text = $request->text_note;
    $note->save();

    return redirect()->route('home');
    }


    public function editNote($id)
    {
        // $id = $this->descriptar($id);

       $id = Operations::descriptar($id);
       $note = Note::find($id);
       return view('edit_note',['note'=> $note]);
    }

    public function editNoteSubmit(request $request){
            $request->validate(
        [
            'text_title' => 'required|min:3|max:200',
            'text_note'  => 'required|min:3|max:3000'
        ],
        [
            'text_title.required' => 'O título é obrigatório.',
            'text_title.min'      => 'O título deve ter no mínimo :min caracteres.',
            'text_title.max'      => 'O título pode ter no máximo :max caracteres.',

            'text_note.required'  => 'O texto é obrigatório.',
            'text_note.min'       => 'O texto deve ter no mínimo :min caracteres.',
            'text_note.max'       => 'O texto pode ter no máximo :max caracteres.',
        ]
    );

    if(!$request->note==null){
        return redirect()->route('home');
    }

    $id = Operations::descriptar($request->note_id);

    //carregando nota
    $note = Note::find($id);

    // update note
    $note->title = $request->text_title;
    $note->text = $request->text_note;
    $note->save();

    return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        // $id = $this->descriptar($id);
        $id = Operations::descriptar($id);

        $note = Note::find($id);

        return view ('delete_note',['note'=>$note]);
    }

    public function deleteNoteConfirm($id)
    {
        // $id = $this->descriptar($id);
        $id = Operations::descriptar($id);

        $note = Note::find($id);

        // 1)hard delete,que é apagar do banco
        // $note->delete();

        // 2)soft,que é um update
        // $note->deleted_at = date('Y-m-d H:i:s');
        // $note->save();

        // 3)software delete com o Note.php diferente
        $note->delete();

        // 4)hard delete com o Note.php diferente
        // $note->forcDelete();

        return redirect()->route('home');
    }

}
