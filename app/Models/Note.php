<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    //com essa coisa faz soft e hard
    use SoftDeletes;

    //Muitos para um
    public function notes(){
        return $this->hasMany(Note::class);
    }
}
