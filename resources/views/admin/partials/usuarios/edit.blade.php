<form method="POST" @submit.prevent="updateUser(fillUser.id)">
    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">

                  <div class="form-group">
                        <ul class="list-group mb-2">
                            <li class="list-group-item list-group-item-danger" v-for="error in errors">* @{{ error[0] }}</li>
                        </ul>
                            <label for="alimento">Nombre o Nickname</label>
                             <input type="text" name="nombre" class="form-control" v-model="fillUser.nombre">
                  </div>
                  <div class="form-group">
                        <label for="detalle">E-mail</label>
                            <input type="email" id="correo" class="form-control"  v-model="fillUser.email">
                    </div>

                    <div class="form-group">
                        <label for="detalle">¿Administrador?</label>
                        <select class="form-control" name="trabajador" id="worker" v-model="fillUser.admin">
                            <option value="0" selected>No administrador</option>
                            <option value="1">Administrador</option>
                            

                        </select>
                    </div>

                    <div class="form group">
                        <label for="trabajador">Seleccione Trabajador(opcional)</label>
                            <select class="form-control" name="trabajador" id="worker" v-model="fillUser.trabajador">
                                <option value="" selected>Ninguno</option>
                                <option v-for="user in users" :value="user.id">@{{ user.nombres +' '+user.apellido_paterno}}</option>

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