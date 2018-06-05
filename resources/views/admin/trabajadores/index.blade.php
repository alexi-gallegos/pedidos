@extends('layout.main_layout')

@section('title', 'Sección Trabajadores')

@section('content')

<div id="app">
    <input type="hidden" id="url" value="workers">
    <input type="hidden"  id="worker" value="1">
    <div class="row">
    
@include('admin.partials.trabajadores.create')
            
@include('admin.partials.trabajadores.edit')
            
            <div class="d-inline col-md-6">
            <legend class=""><strong>Personal Restaurante</strong></legend>
            </div>
            <div class="d-inline col-md-6">
            <a class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#create" @click="clearErrors"><i class="fas fa-user-tie mr-2"></i>  Agregar Trabajador</a>
            </div>
            
                    <table class="table table-striped table-hover table-inverse">
                        <thead class="thead-inverse bg-dark text-light">
                            <tr>
                                <th>R.U.T.</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Cargo</th>
                                <th>Dirección</th>
                                <th>Télefono</th>
                                <th>Nombre Emergencia</th>
                                <th>N° Emergencia</th>
                                
                                <th class="text-center" colspan="3">Acciones</th>
            
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <tr v-for="worker in datos" v-cloak>
                                    <td>@{{ worker.rut }}</td>
                                    <td>@{{ worker.nombres }}</td>
                                    <td>@{{ worker.apellido_paterno }} @{{ worker.apellido_materno }}</td>
                                    <td>@{{ worker.cargo.cargo }}</td>
                                    <td>@{{ worker.direccion }}</td>
                                    <td>@{{ worker.telefono }}</td>
                                    <td>@{{ worker.nombre_contacto_emergencia }}</td>
                                    <td>@{{ worker.numero_contacto_emergencia }}</td>
                                    
                                    <td>
                                        <td width="10px">
                                            <a class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#edit" @click.prevent="editWorker(worker)">Editar</a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-danger btn-sm" href="#" role="button" @click.prevent="deleteData(worker,'workers/')">Eliminar</a>
                                        </td>
                                    </td>
                                </tr>
                            </tbody>
                            </tbody>
                    </table>
               
            </div>
    </div>

@endsection