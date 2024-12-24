@extends('layouts.plantilla')

@section('title', 'Plugins')

@section('content')

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

<a href="{{ route('plugins.index') }}">Plugins</a>
<a href="{{ route('plugins.create') }}">Crear</a>

<h3>Lista de Plugins</h3>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
            <th>Descargar</th>
            <th>Borrar</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($plugins as $plugin)
            <tr>
                <td>{{ $plugin->id }}</td>
                <td>{{ $plugin->name }}</td>
                <td>{{ $plugin->description }}</td>
                <td>
                    <!-- Botón para generar -->
                    <a href="{{ route('plugins.show', $plugin) }}">Ver</a>
                    
                    <!-- Botón para editar -->
                    <a href="{{ route('plugins.edit', $plugin) }}">Editar</a>
                </td>


                <td>

                    <!-- Botón para descargar -->
                    <form action="{{ route('plugins.download', $plugin) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Descargar</button>
                    </form>

                </td>

                <td>

                    <!-- Botón para borrar -->
                    <form action="{{ route('plugins.destroy', $plugin) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este plugin?')">Borrar</button>
                    </form>

                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>

@endsection