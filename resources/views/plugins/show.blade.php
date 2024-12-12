@extends('layouts.plantilla')

@section('title', 'Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <a href="{{route('plugins.create')}}">Crear</a>

    <h1>Bienvenido al curso {{$plugin->name}}</h1>

    <a href="{{route('plugins.edit', $plugin)}}">Editar curso</a>
    <form action="{{route('plugins.destroy',$plugin)}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Eliminar</button>
    </form>

@endsection