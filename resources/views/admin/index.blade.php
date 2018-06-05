@extends('layout.main_layout')

@section('title', 'Inicio')

@section('content')

<div id="app">
    <input type="hidden"  id="push" value="1">
    <div class="container" v-cloak>
        <a href="{{ route('nueva_orden') }}" class="btn btn-primary btn-lg offset-md-9">Realizar nueva orden</a>
       
            
        
        

    </div><!-- /container -->
</div> <!-- /inicio -->


@endsection