@extends('layout.main_layout')

@section('title', 'Pedidos Finalizados')

@section('content')

<div id="app">

@include('admin.partials.detalle_pedido.show')

    <input type="hidden"  id="finalizados" value="1">
    {{-- <div class="row col-md-2">
        <p>Fecha Inicio: </p><input type="date" class="form-control" name="" id="">
        <p class="mt-3">Fecha Termino: </p><input type="date" class="form-control" name="" id="">
    </div> --}}

@include('admin.partials.pagination.paginate')


@include('admin.partials.fecha.fecha')

@if(Auth::user()->isAdmin == 0)
<input type="hidden" name="" id="check" value="{{Auth::user()->id_trabajador}}">
@endif
    <table class="table table-striped" v-if="dateSearch == ''">
            <thead>
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
                <tr v-for="(producto,index) in finalizados" v-cloak>
                    <td> @{{ producto.id }}</td>
                    <td> @{{ producto.trabajador['nombres'] +' '+ producto.trabajador['apellido_paterno']+' '+producto.trabajador['apellido_materno']  }}</td>
                    <td> <span class="badge badge-success">@{{ producto.estado_pedido['descripcion'] }}</span></td>
                    <td>$ @{{ producto.valor_total.toLocaleString() }} </td>
                    <td> @{{ producto.mesa['numero_mesa'] }}</td>
                    <td> @{{ producto.created_at | moment }}</td>
                    <td>
                        
                        <button class="btn btn-primary" role="button" data-toggle="modal" data-target="#show" @click.prevent="showDetalle(producto)">Ver detalles</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <legend v-if="dateSearch != ''" v-cloak><strong>@{{ totalResults }}</strong> Resultados para búsqueda entre <strong>@{{ dateFrom | moments2 }}</strong> y <strong>@{{ dateTo | moments2}}</strong></legend>
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
                    <td> <span class="badge badge-success">@{{ producto.estado_pedido['descripcion'] }}</span></td>
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
        @{{ finalizados }}
    </pre> --}}
</div>
    
@endsection