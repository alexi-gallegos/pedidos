<form method="POST" @submit.prevent="newPass(idNewPass)">
    <div class="modal fade" id="newpass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="">Nueva Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">

                  
                    <label for="alimento">Contraseña</label>
                    <div class="input-group mb-3">
                            <input type="password" id="contra" class="form-control toggle-pass" placeholder="Contraseña" aria-describedby="basic-addon2" v-model="password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" @click.prevent="showPass">Mostrar</button>
                        </div>
                    </div>

                </div>
  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar">
                </div>
            </div>
        </div>
    </div>
    </form>