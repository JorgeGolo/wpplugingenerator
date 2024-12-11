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
            <input type="text" name="name" value="{{old('name',$plugin->name)}}">
        </label>
        @error('name')
        <br>

            <small>*{{$message}}</small>
        <br>
        @enderror 
        <br>
    
        <label>
            Descripción:<br>
            <textarea name="description" rows="5">{{old('description',$plugin->description)}}</textarea>
        </label>
        @error('description')
        <br>

            <small>*{{$message}}</small>
        @enderror 
        <br>
        <button type="submit">Enviar formulario</button>

    </form>

@endsection