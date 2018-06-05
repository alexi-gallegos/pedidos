@extends('layout.main_layout')

@section('title', 'Cargos del Personal')

@section('content')

<div id="app">
<input type="hidden" id="url" value="position">
<div class="row px-5">

      @include('admin.partials.cargos.create')
        
    @include('admin.partials.cargos.edit')
        
        <div class="d-inline col-md-6">
        <legend class=""><strong>Cargos Trabajadores</strong></legend>
        </div>
        <div class="d-inline col-md-6">
        <a class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#create" @click="clearErrors">Crear Cargo</a>
        </div>
        
                <table class="table table-striped table-hover table-inverse">
                    <thead class="thead-inverse bg-success text-light">
                        <tr>
                            <th>Nombre Cargo</th>
                            <th>Descripción</th>
                            <th class="text-center" colspan="3">Acciones</th>
        
                        </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            <tr v-for="position in datos" v-cloak>
                                <td>@{{ position.cargo }}</td>
                                <td>@{{ position.descripcion }}</td>
                                <td>
                                    <td width="10px">
                                        <a class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#edit" @click.prevent="editPosition(position)">Editar</a>
                                    </td>
                                    <td width="10px">
                                        <a class="btn btn-danger btn-sm" href="#" role="button" @click.prevent="deleteData(position,'position/')">Eliminar</a>
                                    </td>
                                </td>
                            </tr>
                        </tbody>
                        </tbody>
                </table>
           
        </div>
</div>
@endsection