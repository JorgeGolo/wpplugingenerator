@extends('layouts.plantilla')

@section('title', 'Home')

@section('content')


<a href="{{route('plugins.index')}}">Plugins</a>
<a href="{{route('plugins.create')}}">Crear</a>

    <h1>Bienvenido a la página principal</h1>
@endsection