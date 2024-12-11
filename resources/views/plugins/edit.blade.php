@extends('layouts.plantilla')

@section('title', 'Edit Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <a href="{{route('plugins.create')}}">Crear</a>

    <form action="{{route('plugins.update', $plugin)}}" method="POST">

        @csrf

        @method('put')

        <label>
            Nombre:<br>
            <input type="text" name="name" value="{{$plugin->name}}">
        </label>
        <br>
    
        <label>
            Descripción:<br>
            <textarea name="description" rows="5" value="">{{$plugin->description}}</textarea>
        </label>
        <br>
        <button type="submit">Enviar formulario</button>

    </form>

@endsection