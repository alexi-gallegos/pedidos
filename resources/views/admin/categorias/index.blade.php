@extends('layout.main_layout')

@section('title', 'Categorias')

@section('content')

<div id="app">
    <input type="hidden" id="url" value="categories">
    <div class="row px-5">
    
@include('admin.partials.categorias.create')
            
@include('admin.partials.categorias.edit')
            
            <div class="d-inline col-md-6">
            <legend class=""><strong>Categorias de comida</strong></legend>
            </div>
            <div class="d-inline col-md-6">
            <a class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#create" @click="clearErrors"><i class="fas fa-user-tie mr-2"></i>  Agregar Categoria</a>
            </div>
            
                    <table class="table table-striped table-hover table-inverse col-md-9 offset-md-1" v-cloak>
                        <thead class="thead-inverse bg-secondary text-light">
                            <tr>
                                <th>Descripción</th>
                                <th class="text-center" colspan="3">Acciones</th>
            
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <tr v-for="category in datos">
                                    <td v-text="category.descripcion"></td>
                                    <td>
                                        <td width="10px">
                                            <a class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#edit" @click.prevent="editCategory(category)">Editar</a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-danger btn-sm" href="#" role="button" @click.prevent="deleteData(category,'categories/')">Eliminar</a>
                                        </td>
                                    </td>
                                </tr>
                            </tbody>
                            </tbody>
                    </table>
               
            </div>
    </div>

@endsection