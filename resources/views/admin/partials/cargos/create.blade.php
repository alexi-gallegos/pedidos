<form method="POST" @submit.prevent="createPosition">
        <div class="modal fade" id="create">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h4 class="">Crear Cargo</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                       
                    </div>
      
                    <div class="modal-body">
                      <div class="form-group">
                       <ul class="list-group mb-2">
                        <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                       </ul>
                        <label for="nameWarranty">Nombre Cargo</label>
                        <input type="text" name="cargo" class="form-control" v-model="newPosition.cargo">
                    </div>
                    <div class="form-group">
                        <label for="nameWarranty">Breve descripción</label>
                        <input type="text" name="descripcion" class="form-control" v-model="newPosition.descripcion">
                    </div>
                    </div>
      
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </div>
            </div>
        </div>
        </form>