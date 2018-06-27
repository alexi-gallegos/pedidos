@extends('layout.main_layout')

@section('title','Creación de Menus')

@section('content')

<div id="app">
</div>

<div id="menu" v-cloak>

@include('admin.partials.menus.show')

<legend class="h3">Creación, edición y eliminación de Menus</legend>
    <button class="btn btn-primary btn-lg float-right ml-3" @click.prevent="newMenu">Crear Menú</button>
    <button v-if="nuevoMenu == true" class="btn btn-warning btn-lg float-right" @click.prevent="cancelarNuevoMenu">Cancelar creación</button>


    <table v-if="nuevoMenu == false" class="table table-striped table-hover table-inverse">
        <thead class="thead-inverse bg-dark text-light">
            <tr>
                <th>Nombre Menú</th>
                <th>Valor</th>
                <th>Disponibilidad</th>
                <th class="text-center" colspan="4">Acciones</th>

            </tr>
            </thead>
            <tbody>
            <tbody>
                <tr v-for="product in datos" v-cloak>
                    <td>@{{ product.nombre_menu }}</td>
                    <td>$ @{{ product.valor_total.toLocaleString() }}</td>
                    <td v-if="product.disponible == true"><span class="badge badge-success">Disponible</span></td>
                    <td v-else><span class="badge badge-danger">No Disponible</span></td>
                    <td>
                        <td width="10px">
                                <button class="btn btn-sm btn-primary" role="button" data-toggle="modal" data-target="#show" @click.prevent="showDetalle(product)">Ver detalles</button>
                        </td>
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


    <div id="name_menu1" >
    <input v-if="nuevoMenu == true" type="text" class="form-control col-md-5 mt-5" v-model="nombreMenu" id="name_menu" placeholder="Nombre del Menú, ej. Combo Super Lunes">

    </div>
    <div v-if="nuevoMenu == true" class="form-group col-md-5 mt-3" v-cloak>
        <label for="categoria">Categoria</label>
        <select name="categoria" class="form-control" v-model="currentCategory">
            <option value="" selected hidden>Seleccione una categoria</option>
            <option v-for="category in categorias" :value="category.id" v-text="category.descripcion"></option>
        </select>
    </div>
    <div class="row">
    <div class="col-md-5" v-if="products != ''" v-cloak>
        <table class="table table-bordered">
             <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Agregar Producto</th>
                    
                </tr>
            </thead>
            <tbody>

                <tr v-for="product in products" v-if="product.disponible === 1">
                        <td>@{{ product.nombre_producto }}</td>
                        <td width="80">$ @{{ product.valor_unidad.toLocaleString() }}</td>
                        <td width="50"><input :id="product.id" type="number" min="0" step="1" class="form-control"></td>
                        <td><button class="btn btn-xs btn-primary" @click.prevent="valorProducto(product,product.id)">Agregar</button></td>
                        
                </tr>
                
            </tbody>
        </table>
</div>

<div class="col-md-6 ml-5" v-if="products != ''">

    <h3 class="offset-md-6">Detalle Menú</h3>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio Unidad</th>
            <th>Cantidad</th>
            <th colspan="2">Precio Total</th>
          </tr>
        </thead>
       
        <tbody v-if="productosDetalle != ''">
                <tr v-for="producto in productosDetalle" v-cloak>
                    <td>@{{ producto.nombre_producto }}</td>
                    <td>$ @{{ producto.valor_unidad.toLocaleString() }}</td>
                    <td>@{{ producto.cantidad }}</td>
                    <td>$ @{{ producto.valor_total.toLocaleString() }}</td>
                    <td><button type="button" class="btn btn-outline-danger btn-sm" @click.prevent="deleteProductoDetalle(producto)">x</button></td>
                </tr>
        </tbody>
    
      </table>
      <div class="row">
          <table class="table table-striped col-md-8 offset-md-4" v-if="total != 0" v-cloak>
              <tbody class="bg-light">
                
                  <tr>
                      <td></td>
                      <td scope="row"></td>
                      <td><strong>Total</strong></td>
                      <td><strong>$ @{{ total.toLocaleString() }}</strong></td>
                  </tr>
              </tbody>
          </table>
      </div>
      <button v-if="productosDetalle != ''" class="btn btn-primary btn-lg offset-md-8 my-5" @click.prevent="crearMenu" v-cloak>Crear Menú</button>
</div>
</div>


</div>


@endsection

@section('scriptspages')
    <script src="{{ asset('js/menu.js') }}"></script>
@endsection