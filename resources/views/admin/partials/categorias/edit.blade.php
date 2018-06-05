<form method="POST" @submit.prevent="updateCategory(fillCategory.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="">Editar Categoria</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">
                  <div class="form-group">
                   <ul class="list-group mb-2">
                    <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                   </ul>
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" v-model="fillCategory.descripcion">
                </div>
                </div>
  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                </div>
            </div>
        </div>
    </div>
    </form>