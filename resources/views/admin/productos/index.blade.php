@extends('layout.main_layout')

@section('title', 'Productos')

@section('content')

<div id="app">
    <input type="hidden" id="url" value="products">
    <div class="row px-5">
    
@include('admin.partials.productos.create')
            
@include('admin.partials.productos.edit')
            
            <div class="d-inline col-md-6">
            <legend class=""><strong>Productos del Restaurante</strong></legend>
            </div>
            <div class="d-inline col-md-6">
            <a class="btn btn-primary float-right" href="#" role="button" data-toggle="modal" data-target="#create" @click="clearErrors"><i class="fas fa-user-tie mr-2"></i>  Agregar Producto</a>
            </div>
            
                    <table class="table table-striped table-hover table-inverse">
                        <thead class="thead-inverse bg-primary text-light">
                            <tr>
                                <th>Nombre Producto</th>
                                <th>Precio</th>
                                <th>Categoria</th>
                                <th>Disponibilidad</th>
                                <th class="text-center" colspan="3">Acciones</th>
            
                            </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <tr v-for="product in datos" v-cloak>
                                    <td>@{{ product.nombre_producto }}</td>
                                    <td>$ @{{ product.valor_unidad.toLocaleString() }}</td>
                                    <td>@{{ product.categoria['descripcion'] }}</td>
                                    <td v-if="product.disponible === 1"><span class="badge badge-success">Disponible</span></td>
                                    <td v-else><span class="badge badge-danger">No Disponible</span></td>
                                    <td>
                                        <td width="10px">
                                            <a class="btn btn-warning btn-sm" href="#" role="button" data-toggle="modal" data-target="#edit" @click.prevent="editProduct(product)">Editar</a>
                                        </td>
                                        <td width="10px">
                                            <a class="btn btn-danger btn-sm" href="#" role="button" @click.prevent="deleteData(product,'products/')">Eliminar</a>
                                        </td>
                                    </td>
                                </tr>
                            </tbody>
                            </tbody>
                    </table>
               
            </div>
    </div>

@endsection