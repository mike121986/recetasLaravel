@extends('layouts.app')
@section('botones')
    <a href="{{route('receta.create')}}" class="btn btn-primary mr-2"> Crear Receta</a>
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
                            <a href="" class="btn btn-danger mr-1">Eliminar</a>
                            <a href="" class="btn btn-dark mr-1">Editar</a>
                            <a href="{{ route('receta.show',['receta'=>$receta->id])}}" class="btn btn-success mr-1">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
