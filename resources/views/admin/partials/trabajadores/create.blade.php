<form method="POST" @submit.prevent="createWorker">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="">Crear Trabajador</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">
                  <div class="form-group" v-cloak>
                   <ul class="list-group mb-2">
                    <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                   </ul>
                    <label for="nameWarranty">R.U.T.</label>
                    <input type="text" name="rut" class="form-control" v-model="newWorker.rut">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Nombres</label>
                    <input type="text" name="nombres" class="form-control" v-model="newWorker.nombres">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Apellido Paterno</label>
                    <input type="text" name="apellido_p" class="form-control" v-model="newWorker.apellido_p">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Apellido Materno</label>
                    <input type="text" name="apellido_m" class="form-control" v-model="newWorker.apellido_m">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Cargo</label>
                    
                    <select name="cargo" class="form-control" v-model="newWorker.cargo" v-cloak>
                        <option value="" selected hidden>Seleccione cargo</option>
                        <option v-for="cargo in cargos" :value="cargo.id"> @{{ cargo.cargo }}</option>
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Dirección</label>
                    <input type="text" name="direccion" class="form-control" v-model="newWorker.direccion">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Télefono</label>
                    <input type="text" name="telefono" class="form-control" v-model="newWorker.telefono">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Nombre contacto emergencia</label>
                    <input type="text" name="nombre_emergencia" class="form-control" v-model="newWorker.nombre_emergencia">
                </div>
                <div class="form-group">
                    <label for="nameWarranty">Télefono contacto emergencia</label>
                    <input type="text" name="telefono_emergencia" class="form-control" v-model="newWorker.numero_emergencia">
                </div>

                </div>
  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    </form>