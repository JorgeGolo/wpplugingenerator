<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>

-->
@extends('layouts.plantilla')

@section('title', 'Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <h1>Bienvenido al curso {{$plugin->name}}</h1>

@endsection