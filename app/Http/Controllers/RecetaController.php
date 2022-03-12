<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class RecetaController extends Controller
{
    /* se eejcuta primero el constructor y este verifica que todo lo que quiere entrar aqui debe estar autenticado 
       como segundo parametro le podemos pasar una exepcion para que un metodo no necesite autent8icacions*/
    public function __construct()
    {

        $this->middleware('auth',['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* mandamos a traer la relacion que hicimos en el mModelo de usuario que se llama RECETAS */
        //Auth::user()->recetas; // ->este es una forma de mandar a trae la relacion
        //auth()->user()->recetas->dd(); // ->este es otra forma de mandar a trae la relacion
        $recetas = auth()->user()->recetas;
        return view('recetas.index')->with('recetas',$recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* para mostrar los datos sin MODELO es de esta manera
        nombre de la tabla. get () pluck = sirve para traer solo los campos que son requeridos 
        DB::table('categoria_receta')->get()->pluck('nombre','id')->dd();
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');*/

        /* obtener las categorias con el MODELO osea con relacion de bd de uno a muchos 
            Adentro de los prentesis se escribe los campos que se necesitas*/
        $categorias = CategoriaReceta::all(['id','nombre']);
        return view('recetas.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*  aqui estamos tomando el link simbolico que laravel le dio a la imagen que en este caso lo esta guardando en una carpeta 
       llamada UPLOAD-RECETAS en STORAGE, para poder tomar el link debemos insertar un codigo con arttisan que es 
       PHP ARTISAN STORAGE:LINK
       dd($request['imagen']->store('upload-recetas','public')); */
        /* ingresar datos a la bd sin modelo o sea en forma directa */
        $data = request()->validate([
            'titulo'=> 'required|min:6',
            'categoria'=>'required',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            //'imagen'=>'required|image'
        ]);
        $rutaImagen = $request['imagen']->store('upload-recetas','public');

        // resize de la imagen con intervetion image
        $img=Image::make(public_path("storage/{$rutaImagen}"))->fit(1000,550);
        $img->save();

        // usamo un fasat (este fasat sirve para traer todas las operaciones complejas y nosotro no tenemos que preocuparnos poe ello)
        // aqui insertamos sin modelo
        /* DB::table('recetas')->insert([
            'titulo'=> $data['titulo'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion' =>$data['preparacion'],
            'imagen'=>$rutaImagen,
            'user_id'=>Auth::user()->id,
            'categoria_id'=>$data['categoria']
        ]); */

        /* almacenaar en la base de datos con el modelo */
        //1.- primero debemos tomar el usaurio autentucado
        //2.- debemos ingresar a la informacion del usuario
        //3.- debemos ingresar a el modelo (a la fk de la tabla USer)
        //4.- como se tiene un modelo con ORM podemos pasar un arerglo
    //    (1)    (2)      (3)       (4)
        auth()->user()->recetas()->create([
            'titulo'=> $data['titulo'],
            'ingredientes'=>$data['ingredientes'],
            'preparacion' =>$data['preparacion'],
            'imagen'=>$rutaImagen,
            'categoria_id'=>$data['categoria']
        ]);

        return redirect()->action([RecetaController::class,'index']);
       //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show',compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //
    }
}
