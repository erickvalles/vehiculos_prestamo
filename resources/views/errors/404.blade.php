@extends('layout')

@section('title', "¿Perdido?")

@section('content')

    <br><br><br><br>
    <div class="col-centered" style="align-content: center">
        <h1>Parece ser que no deberías estar aquí</h1>
        <h2>Recurso no encontrado</h2>
        <a href="{{route('solicitud.index')}}" class="btn btn-success">Regresar</a>

    </div>

    
    @stop