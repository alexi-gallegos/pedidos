@extends('layout.main_layout')

@section('title','Reportes')

@section('content')
    
    <div class="container" id="app">

        <button type="button" class="btn btn-primary" @click.prevent="createPDF(1)">Crear PDF</button>

    </div>

@endsection