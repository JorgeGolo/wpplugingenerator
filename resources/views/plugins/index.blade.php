@extends('layouts.plantilla')

@section('title', 'Plugins')

@section('content')

<a href="{{route('plugins.index')}}">Plugins</a>
<a href="{{route('plugins.create')}}">Crear</a>

<h3>Lista de plugins</h3>
<ul>
    @foreach ($plugins as $plugin)
        <li>
            <a href="{{route('plugins.show', $plugin->id)}}">{{$plugin->name}}</a> 
        </li>
    @endforeach
</ul>

@endsection