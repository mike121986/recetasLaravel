<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth',['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //obtener las recetas con paginacion
        $recetas = Receta::where('user_id', $perfil->user_id)->paginate(10);
        return view('perfil.show')->with('perfil', $perfil)
                                  ->with('receta',$recetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view',$perfil);
        return view('perfil.edit')->with('perfil', $perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        // ejecutar policy
        $this->authorize('update', $perfil);
        // validar
        $data = request()->validate([
            'name' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);
        // si el usaurio sube una imagen
        if ($request['imagen']) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            // Resize de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //crear un arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }
        // asignar nombre y url
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();
        // eliminar url y name de data
        unset($data['url']);
        unset($data['name']);
        // asignar biografia e imagen
        auth()->user()->perfil()->update(array_merge(
            $data,
            $array_imagen ?? []   // pasa el array $array_imagen si no existe Pasa un array vacio
            ));

        // guardar
        //reidrecionar
        return redirect(route('receta.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
