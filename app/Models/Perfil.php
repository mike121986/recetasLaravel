<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    // relacion de uno a uno de perfil a usuario
    // esta relacion en inversa
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
