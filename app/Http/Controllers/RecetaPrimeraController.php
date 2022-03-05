<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $recetas = ['Receta Pizza', 'Recetas Hamburgesa', 'Receta Tacos'];
        $categorias =['Comida Mexicana', 'Comida ARgentina', 'Postres'];
        /* esta sitaxis es para enviar los datos con with, es un poco mas expicita 
        ya que envialos una llave y el array o los datos que contiene esa llave */
       return view('recetas.index')->with('recetas',$recetas)
                                    ->with('categorias',$categorias);

        /* Tambien se puede pasar datos con otra sintaxis que es con compact
        este solo se le envia la variable que como su fuera un STRING */
       //return view('recetas.index',compact('recetas','categorias'));
    }

    
}
