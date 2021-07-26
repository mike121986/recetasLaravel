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

    public function usuario(){
        return $this->belongsTo('App\Models\User');
    }
}
