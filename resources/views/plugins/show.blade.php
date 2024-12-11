@extends('layouts.plantilla')

@section('title', 'Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <a href="{{route('plugins.create')}}">Crear</a>

    <h1>Bienvenido al curso {{$plugin->name}}</h1>

    <a style="display:none" href="{{route('plugins.edit', $plugin)}}">Editar curso</a>


@endsection