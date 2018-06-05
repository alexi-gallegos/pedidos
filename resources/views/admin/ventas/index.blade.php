@extends('layout.main_layout')

@section('title', 'Estadisticas de ventas')

@section('content')

<div id="app">
@include('admin.partials.fecha.fecha_chart')
    <div class="row">
<button class="btn btn-primary ml-2" @click.prevent="createChart(0)">Ventas del día</button>
<button class="btn btn-primary ml-2" @click.prevent="createChart(1)">Ventas de la semana</button>
<button class="btn btn-primary ml-2" @click.prevent="createChart(2)">Ventas del mes</button>
<button class="btn btn-primary ml-2" @click.prevent="createChart(3)">Ventas del año</button>
<button class="btn btn-success ml-2" href="#" role="button" data-toggle="modal" data-target="#date">Fecha Personalizada</button>
</div>
<div id="canv">
        <canvas id="myChartDia" width="100%" height="38%"></canvas>
        <canvas id="myChartSemana" width="100%" height="38%"></canvas>
        <canvas id="myChartMes" width="100%" height="38%"></canvas>
        <canvas id="myChartYear" width="100%" height="38%"></canvas>
        <canvas id="myChartCustom" width="100%" height="38%"></canvas>
</div>

</div>


@endsection