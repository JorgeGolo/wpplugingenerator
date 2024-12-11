@extends('layouts.plantilla')

@section('title', 'Nuevo Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <a href="{{route('plugins.create')}}">Crear</a>

    <form action="{{route('plugins.store')}}" method="POST">

        @csrf

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
        <button type="submit">Enviar formulario</button>

    </form>

@endsection