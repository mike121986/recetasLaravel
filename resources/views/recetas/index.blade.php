@extends('layouts.app')
@section('botones')
@include('ui.navegacion')
@endsection
@section('content')

    <h1 class="text-center mb-5">Recetas</h1>
    <div class="col-md-10 mx-auto -bg-white p3">
        <table class="table">
            <thead class="bg-primary text-ligth">
                <tr>
                    <td scole="col">Tutulo</td>
                    <td scole="col">Categoría</td>
                    <td scole="col">Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($recetas as $receta)
                    <tr>
                        <td>{{$receta->titulo}}</td>
                        <td>{{$receta->categoria->nombre}}</td>
                        <td>
                           <eliminar-receta receta-id="{{$receta->id}}"></eliminar-receta>
                            <a href="{{ route('receta.edit',['receta'=>$receta->id])}}" class="btn btn-dark  d-block mb-2 mr-1">Editar</a>
                            <a href="{{ route('receta.show',['receta'=>$receta->id])}}" class="btn btn-success  d-block  mr-1">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>
    </div>

    <h2 class="text-center my-5">RECETAS QUE TE GUSTARON</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        @if (count($usuario->meGusta) > 0)
            
        @else
            <p class="text-center"> Aún no tienes recetas guardadas <small>Dale me gusta a las recetas y apareceran aqui</small></p>
        @endif
        <ul class="list-group">
            @foreach ($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{$receta->titulo}}</p>
                    <a class="btn btn-outline-success" href="{{ route('receta.show',['receta'=>$receta->id])}}"> VER </a>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
