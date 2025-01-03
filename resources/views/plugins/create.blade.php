@extends('layouts.plantilla')

@section('title', 'Nuevo Plugin')

@section('content')

    <a href="{{route('plugins.index')}}">Plugins</a>
    <a href="{{route('plugins.create')}}">Crear</a>

    <form action="{{route('plugins.store')}}" method="POST">

        @csrf

        <label>
            Nombre:
            <input type="text" name="name" value="{{old('name')}}">
        </label>
        @error('name')
        <br>
            <small>*{{$message}}</small>
        <br>
        @enderror 
        <br>

        <label>
            Prefijo:
            <input type="text" name="prefix" value="{{old('prefix')}}">
        </label>
        @error('prefix')
        <br>
            <small>*{{$message}}</small>
        <br>
        @enderror 

        <br>
        <label>
            Descripción:
            <textarea name="description" rows="5">{{old('description')}}</textarea>
        </label>
        <br>
        @error('description')
            <small>*{{$message}}</small>
            <br>
        @enderror
        <button type="submit">Enviar formulario</button>

    </form>

    <hr/>

    <p><b>Nota para el prefijo:</b> El prefijo debe cumplir cierts normas para la validación del plugin.</p>
    <p>A efectos de continuidad, es preferible que el prefijo comience con los acaracteres "mittsfc".</p>
    
@endsection