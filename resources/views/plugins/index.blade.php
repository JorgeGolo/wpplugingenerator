@extends('layouts.plantilla')

@section('title', 'Plugins')

@section('content')
<h3>Lista de plugins</h3>
<ul>
    @foreach ($plugins as $plugin)
        <li>{{$plugin->name}}</li>
    @endforeach
</ul>
@endsection