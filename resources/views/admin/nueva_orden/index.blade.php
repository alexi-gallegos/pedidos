@extends('layout.main_layout')

@section('title', 'Nueva Orden')

@section('content')
<div id="app">
    <input type="hidden" id="new" value="1">
    <input type="hidden" id="id_worker" value="{{ Auth::user()->id_trabajador  }}">
    <div class="row">
        <div class="col-md-6">

            <div class="form-group" v-cloak>
                <label for="categoria">Mesas Disponibles</label>
                <select name="categoria" class="form-control" v-model="mesa">
                    <option value="" selected hidden>Seleccione una mesa</option>
                    <option v-for="table in tables" :value="table.id" v-text="table.numero_mesa"></option>
                </select>
            </div>

            <div class="form-group" v-cloak>
                <label for="categoria">Categoria</label>
                <select name="categoria" class="form-control" v-model="currentProduct">
                    <option value="" selected hidden>Seleccione una categoria</option>
                    <option v-for="category in categories" :value="category.id" v-text="category.descripcion"></option>
                </select>
            </div>

            <div v-if="products != ''" v-cloak>
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
                

        </div> <!-- /col-md-6 -->

        <div class="col-md-5 ml-5">

            <h3 class="offset-md-4">Detalle Pedido</h3>
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
              <button v-if="productosDetalle != ''" class="btn btn-primary btn-lg offset-md-8 my-5" @click.prevent="sendPedido" v-cloak>Realizar Pedido</button>
        </div>
    </div>
</div>
@endsection