@extends('layouts.plantilla')

@section('title', 'Home')

<ul>
    @foreach ($plugins as $plugin)
        <li>{{$plugin}}</li>
    @endforeach
</ul>