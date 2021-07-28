<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user()->id;
        /* auth()->user()->recetas->dd(); */
// recetas sin paginacion
        /* $recetas = auth()->user()->recetas; */
        //recetas con paginacion
        $recetas = Receta::where('user_id',$usuario)->paginate(5);
        return view('recetas.index')->with('recetas', $recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // forna de obtener las categorias sin modelp
        // $categorias =DB::table('categoria_recetas')->get();
        // Con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required',
        ]);

        // obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        // Resize de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        // almacenar en la bd (sin modelo)
        /*          DB::table('recetas')->insert([
             'titulo' => $data['titulo'],
             'preparacion' => $data['preparacion'],
             'ingredientes' => $data['ingredientes'],
             'imagen' => $ruta_imagen,
             'user_id' =>Auth::user()->id,
             'categoria_id' => $data['categoria']
         ]); */

        // almacenar en la BD (con modelo)
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']
        ]);
        return redirect()->route('receta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show')->with('receta', $receta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //$this->authorize('update',$receta);
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit')->with('categorias', $categorias)
            ->with('receta', $receta);
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
        //reivsa el pilicy
        $this->authorize('update',$receta);

        // validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required',
        ]);

        // asignar valores
        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        // si el usuario sube una nueva imagen
        if (request('imagen')) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            // signar al objeto
            $receta->imagen = $ruta_imagen;
        }

        $receta->save();
        return redirect()->route('receta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        
        $this->authorize('delete',$receta); 
        $receta->delete();
        return redirect()->route('receta.index');
    }
}
