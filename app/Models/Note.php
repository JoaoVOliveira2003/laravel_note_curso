<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //Muitos para um
    public function notes(){
        return $this->hasMany(Note::class);
    }
}
