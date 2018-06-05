<form method="POST" @submit.prevent="updateWorker(fillWorker.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="">Editar datos Trabajador</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">
                  <div class="form-group">
                   <ul class="list-group mb-2">
                    <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                   </ul>
                    <label for="nameWarranty">R.U.T.</label>
                    <input type="text" name="rut" class="form-control" v-model="fillWorker.rut">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Nombres</label>
                    <input type="text" name="nombres" class="form-control" v-model="fillWorker.nombres">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Apellido Paterno</label>
                    <input type="text" name="apellido_p" class="form-control" v-model="fillWorker.apellido_p">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Apellido Materno</label>
                    <input type="text" name="apellido_m" class="form-control" v-model="fillWorker.apellido_m">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Cargo</label>
                    
                    <select name="cargo" class="form-control" v-model="fillWorker.cargo">
                        <option value="" selected hidden>Seleccione cargo</option>
                        <option v-for="cargo in cargos" :value="cargo.id"> @{{ cargo.cargo }}</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Dirección</label>
                    <input type="text" name="direccion" class="form-control" v-model="fillWorker.direccion">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Télefono</label>
                    <input type="text" name="telefono" class="form-control" v-model="fillWorker.telefono">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Nombre contacto emergencia</label>
                    <input type="text" name="nombre_emergencia" class="form-control" v-model="fillWorker.nombre_emergencia">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Télefono contacto emergencia</label>
                    <input type="text" name="telefono_emergencia" class="form-control" v-model="fillWorker.telefono_emergencia">
                </div>

                </div>
  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    </form>