@extends('layouts.plantilla')

@section('title', 'Nuevo Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>

    <form action="{{route('cursos.store')}}" method="POST">

        <label>
            Nombre:<br>
            <input type="text" name="name">
        </label>
        <br>
    
        <label>
            Descripción:<br>
            <textarea name="description" rows="5"></textarea>
        </label>
        <br>
    
    </form>

@endsection


