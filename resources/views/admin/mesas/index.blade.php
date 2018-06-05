@extends('layout.main_layout')

@section('title', 'Módulo Mesas')

@section('content')
    
<div id="app">
    <input type="hidden" id="url" value="tables">
    <div class="row px-5">
    
@include('admin.partials.mesas.create')
            
@include('admin.partials.mesas.edit')
            
            <div class="d-inline col-md-6">
            <legend class=""><strong>Mesas Restaurante</strong></legend>
            </div>
            <div class="d-inline col-md-6">
            <a class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#create" @click="clearErrors"><i class="fas fa-user-tie mr-2"></i>  Agregar Mesa</a>
            </div>
            
                    <table class="table table-striped table-hover table-inverse" v-cloak>
                        <thead class="thead-inverse bg-secondary text-light">
                            <tr>
                                <th>Número mesa</th>
                                <th>Disponibilidad</th>
                                <th class="text-center" colspan="3">Acciones</th>
            
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <tr v-for="mesa in datos" v-cloak>
                                    <td v-text="mesa.numero_mesa"></td>
                                    <td v-if="mesa.disponible == 1"><span class="badge badge-success">Disponible</span></td>
                                    <td v-else><span class="badge badge-warning">No Disponible</span></td>
                                    <td>
                                        <td width="10px">
                                            <a class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#edit" @click.prevent="editTable(mesa)">Editar</a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-danger btn-sm" href="#" role="button" @click.prevent="deleteData(mesa,'tables/')">Eliminar</a>
                                        </td>
                                    </td>
                                </tr>
                            </tbody>
                            </tbody>
                    </table>
               
            </div>
    </div>

@endsection