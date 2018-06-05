@extends('layout.main_layout')

@section('title', 'Usuarios')

@section('content')
    
<div id="app">
    <input type="hidden" id="url" value="users">
    <input type="hidden" id="usuarios" value="1">
    <div class="row px-5">
    
@include('admin.partials.usuarios.create')
            
@include('admin.partials.usuarios.edit')

@include('admin.partials.usuarios.newpass')
            
            <div class="d-inline col-md-6">
            <legend class=""><strong>Usuarios Sistema</strong></legend>
            </div>
            <div class="d-inline col-md-6">
            <a class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#create" @click="clearErrors"><i class="fas fa-user-tie mr-2"></i>  Agregar Usuario</a>
            </div>
            
                    <table class="table table-striped table-hover table-inverse" v-cloak>
                        <thead class="thead-inverse bg-secondary text-light">
                            <tr>
                                <th>ID Usuario</th>
                                <th>Admin</th>
                                <th>Nombre Usuario</th>
                                <th>E-mail</th>
                                <th>Nombre Trabajador</th>
                                <th class="text-center" colspan="4">Acciones</th>
            
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <tr v-for="user in datos" v-cloak>
                                    <td v-text="user.id"></td>
                                    <td v-if="user.isAdmin == 1"><span class="badge badge-success">Administrador</span></td>
                                    <td v-else><span class="badge badge-dark">No Administrador</span></td>
                                    <td v-text="user.name"></td>
                                    <td v-text="user.email"></td>
                                    <td v-if="user.trabajador == null"></td>
                                    <td v-else>@{{ user.trabajador['nombres'] +' '+ user.trabajador['apellido_paterno']+' '+user.trabajador['apellido_materno'] }}</td>

                                    <td>
                                        <td width="10px">
                                            <a class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#edit" @click.prevent="editUser(user)">Editar</a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-danger btn-sm" href="#" role="button" @click.prevent="deleteData(user,'users/')">Eliminar</a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-primary btn-sm" href="#" role="button" data-toggle="modal" data-target="#newpass" @click.prevent="newPassFill(user.id)">Nueva Contraseña</a>
                                        </td>
                                       
                                    </td>
                                </tr>
                            </tbody>
                            </tbody>
                    </table>
               
            </div>
    </div>

@endsection