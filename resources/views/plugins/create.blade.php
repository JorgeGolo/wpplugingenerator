@extends('layouts.plantilla')

@section('title', 'Nuevo Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <a href="{{route('plugins.create')}}">Crear</a>

    <form action="{{route('plugins.store')}}" method="POST">

        @csrf

        <label>
            Nombre:<br>
            <input type="text" name="name" value="{{old('name')}}">
        </label>
        @error('name')
            <small>*{{$message}}</small>
            <br>
        @enderror
        <br>
    
        <label>
            Descripción:<br>
            <textarea name="description" rows="5">{{old('description')}}</textarea>
        </label>
        <br>
        @error('description')
            <small>*{{$message}}</small>
        <br>
        @enderror

        <button type="submit">Enviar formulario</button>

    </form>

@endsection