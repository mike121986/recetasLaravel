@extends('layouts.app')
@section('botones')
   <a href="{{route('recetas.create')}}" class="btn btn-primary mr-2 text-white">Crear Receta</a>
@endsection
@section('content')    
    <h2 class="text-center mb-5">Administra tus recetas</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-ligth">
               <tr>
                   <th scole="col">Titulo</th>
                   <th scole="col">Categoías</th>
                   <th scole="col">Acciones</th>
               </tr>
               <tbody>
                   <tr>
                       <td>Pizza</td>
                       <td>Pizzass</td>
                       <td></td>
                   </tr>
               </tbody>
            </thead>
        </table>
    </div>
@endsection