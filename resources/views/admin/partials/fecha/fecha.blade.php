
    <div class="modal fade" id="date">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="">Ingresar Fechas</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                   
                </div>
  
                <div class="modal-body">
                  <div class="form-group">
                    <label for="descripcion">Desde :</label>
                    <input type="date" name="descripcion" class="form-control" v-model="dateFrom">
                </div>
                <div class="form-group">
                    <label for="descripcion">Hasta :</label>
                    <input type="date" name="descripcion" class="form-control" v-model="dateTo">
                </div>
                </div>
  
                <div class="modal-footer">
                   <button class="btn btn-primary" @click.prevent="datesSearch">Buscar</button>
                </div>
            </div>
        </div>
    </div>
   