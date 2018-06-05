<form method="POST" @submit.prevent="createUser">
    <div class="modal fade" id="create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="">Crear Usuario</h4>
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
                             <input type="text" name="nombre" class="form-control" v-model="newUser.nombre">
                  </div>
                  <div class="form-group">
                        <label for="detalle">E-mail</label>
                            <input type="email" id="correo" class="form-control"  v-model="newUser.email">
                    </div>

                    <label for="alimento">Contraseña</label>
                    <div class="input-group mb-3">
                            <input type="password" id="contra" class="form-control toggle-pass" placeholder="Contraseña" aria-label="Password" value="" aria-describedby="basic-addon2" v-model="newUser.password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" @click.prevent="showPass">Mostrar</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="detalle">¿Administrador?</label>
                        <select class="form-control" name="trabajador" id="worker" v-model="newUser.admin">
                            <option value="0" selected>No administrador</option>
                            <option value="1">Administrador</option>
                            

                        </select>
                    </div>

                    <div class="form group">
                        <label for="trabajador">Seleccione Trabajador(opcional)</label>
                            <select class="form-control" name="trabajador" id="worker" v-model="newUser.trabajador">
                                <option value="" selected>Ninguno</option>
                                <option v-for="user in users" :value="user.id">@{{ user.nombres +' '+user.apellido_paterno}}</option>

                            </select>
                        
                    </div>

                </div>
  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Crear">
                </div>
            </div>
        </div>
    </div>
    </form>