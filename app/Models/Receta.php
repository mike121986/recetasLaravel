<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
    // campos que se agregaran
    protected $fillable = [
        'titulo',
        'ingredientes',
        'preparacion',
        'imagen',
        'categoria_id'
    ];

    /* obtiene la cateforia de la recerta via fk */
    public function categoria(){
        /* esta es una relacion inversa */
        return $this->belongsTo(CategoriaReceta::class);
    }

    /* obtiene la informacion del usaurio via foreign key */
    public function autor(){
        /* CUANDO HACMOS ALGUNA PRUEBA DE CONEXION CON TIKER Y NO FUNCION AL RELACION, DEBEMOS PASAR COMO SEGUNDO 
        PARAMETRO EL CAMPO QUE ESTA RELACIONADO CON LA OTRA TABLA  */
        return $this->belongsTo(User::class,'user_id');
    }
}
