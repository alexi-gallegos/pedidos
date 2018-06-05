<form method="POST" @submit.prevent="createTable">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="">Crear Mesa</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">
                  <div class="form-group">
                   <ul class="list-group mb-2">
                    <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                   </ul>
                    <label for="numero_mesa">Número Mesa</label>
                    <input type="number" min="0" step="1" name="numero_mesa" class="form-control" v-model="newTable.numero_mesa">
                </div>
                </div>
  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    </form>