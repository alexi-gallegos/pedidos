@extends('layout.main_layout')

@section('title', 'Pedidos Pendientes')

@section('content')



<div id="app">

@include('admin.partials.fecha.fecha')

@include('admin.partials.detalle_pedido.show')
<h3 class="display-4 mb-4">Pedidos Pendientes y Entregados</h3>
<input type="hidden" id="pendiente" value="1">



@include('admin.partials.pagination.paginate')
@if(Auth::user()->isAdmin == 0)
<input type="hidden" name="" id="check" value="{{Auth::user()->id_trabajador}}">
@endif

    <table class="table table-striped" v-if="dateSearch == ''">
        <thead>
            <tr>
                <th>ID pedido</th>
                <th>Garzón</th>
                <th>Estado Pedido</th>
                <th>Monto Total</th>
                <th>Mesa</th>
                <th>Fecha/Hora Pedido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(producto,index) in pendientes" v-cloak>
                <td> @{{ producto.id }}</td>
                <td> @{{ producto.trabajador['nombres'] +' '+ producto.trabajador['apellido_paterno']+' '+producto.trabajador['apellido_materno']  }}</td>
                <td> <span class="badge badge-warning">@{{ producto.estado_pedido['descripcion'] }}</span></td>
                <td>$ @{{ producto.valor_total.toLocaleString() }}</td>
                <td> @{{ producto.mesa['numero_mesa'] }}</td>
                <td> @{{ producto.created_at | moment }}</td>
                <td>
                    <button class="btn btn-primary" v-if="producto.estado_pedido_id == 1" @click.prevent="entregarPedido(producto.id)">Entregar</button>
                    <button class="btn btn-success" v-if="producto.estado_pedido_id == 2" @click.prevent="finalizarPedido(producto.id,producto.mesa_id)">Finalizar</button>
                    <button class="btn btn-danger" @click.prevent="cancelPedido(producto.id)">Cancelar</button>
                    <button class="btn btn-primary" role="button" data-toggle="modal" data-target="#show" @click.prevent="showDetalle(producto)">Ver detalles</button>
                
                </td>
            </tr>
                
        </tbody>
    </table>


    <legend v-if="dateSearch != ''" v-cloak><strong>@{{ totalResults }}</strong> Resultado(s) para búsqueda entre <strong>@{{ dateFrom | moments2 }}</strong> y <strong>@{{ dateTo | moments2}}</strong></legend>
        <table class="table table-striped" v-if="dateSearch != ''" v-cloak>
            <thead class="bg-info">
                <tr>
                    <th>ID pedido</th>
                    <th>Garzón</th>
                    <th>Estado Pedido</th>
                    <th>Valor Total</th>
                    <th>Mesa</th>
                    <th>Fecha/Hora Pedido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(producto,index) in dateSearch" v-cloak>
                    <td> @{{ producto.id }}</td>
                    <td> @{{ producto.trabajador['nombres'] +' '+ producto.trabajador['apellido_paterno']+' '+producto.trabajador['apellido_materno']  }}</td>
                    <td> <span class="badge badge-warning">@{{ producto.estado_pedido['descripcion'] }}</span></td>
                    <td>$ @{{ producto.valor_total.toLocaleString() }} </td>
                    <td> @{{ producto.mesa['numero_mesa'] }}</td>
                    <td> @{{ producto.created_at | moment }}</td>
                    <td>
                        <button class="btn btn-primary" role="button" data-toggle="modal" data-target="#show" @click.prevent="showDetalle(producto)">Ver detalles</button>
                    </td>
                </tr>
            </tbody>
        </table>

    {{-- <pre>
        @{{ pendientes }}
    </pre> --}}

</div>
    
@endsection