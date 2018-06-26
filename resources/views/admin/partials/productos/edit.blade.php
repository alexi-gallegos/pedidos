<form method="POST" @submit.prevent="updateProduct(fillProduct.id)">
        <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h4 class="">Editar Producto</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                       
                    </div>
      
                    <div class="modal-body">
    
                      <div class="form-group">
                        <ul class="list-group mb-2">
                            <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                        </ul>
                            <label for="alimento">Nombre Producto</label>
                            <input type="text" name="nombre_producto" class="form-control" v-model="fillProduct.nombre_producto">
                      </div>
                      <div class="form-group">
                            <label for="detalle">Precio</label>
                            
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            
                            <input type="text" name="precio" placeholder="Sin puntos ni comas, Ej: 1000, 1500, etc." aria-describedby="basic-addon1" class="form-control" v-model="fillProduct.valor_unidad">
                            
                        </div>
                        <small id="priceHelp" class="form-text text-muted">Sin puntos ni comas, Ej: 1000, 1500, etc.</small>
                        </div>

                        
    
                      <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" class="form-control" v-model="fillProduct.categoria_id">
                                <option value="" selected hidden>Seleccione una nueva categoria</option>
                                <option v-for="category in categories" :value="category.id">@{{ category.descripcion }}</option>
                            </select>
                      </div>
    
                      <div class="form-group">
                            <label for="disponibilidad">Disponibilidad</label>
                            <select name="disponibilidad" class="form-control" v-model="fillProduct.disponibilidad">
                                <option value="" selected hidden>Seleccione Disponibilidad</option>
                                <option value="0">No disponible</option>
                                <option value="1">Disponible</option>
                            </select>
                      </div>
    
                    </div>
      
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                    </div>
                </div>
            </div>
        </div>
        </form>