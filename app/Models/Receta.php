<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    use HasFactory;
    protected $fillable = [
        'titulo',
        'preparacion',
        'ingredientes',
        'imagen',
        'categoria_id'
    ];

    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }

    public function autor(){
        /* si sabes que esta bien las relaciones y aun asi no se hace la relacion
        debemos mandar un segundo parmetro. este parametro sirve para decirle a laravel
        donde debe buscar las realciones */
        return $this->belongsTo(User::class, 'user_id');
    }
}
