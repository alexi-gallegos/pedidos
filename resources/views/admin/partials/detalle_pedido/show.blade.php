
        <div class="modal fade" id="show">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h4 class="">Crear Mesa</h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                       
                    </div>
      
                    <div class="modal-body" v-if="showDetail != ''">

                    <div class="form-group">
                        <label for="numero_mesa"><i>Número Mesa</i></label>
                        <p><strong>* @{{ showDetail.mesa['numero_mesa'] }} </strong></p>
                    </div>
                    <div class="form-group">
                            <label for="numero_mesa"><i>Persona que atendió la mesa</i></label>
                            <p><strong> * @{{ showDetail.trabajador['nombres']+' '+showDetail.trabajador['apellido_paterno']+' '+showDetail.trabajador['apellido_materno'] }} </strong></p>
                    </div>
                    <div class="form-group">
                           <table class="table table-striped">
                               <thead>
                                   <tr>
                                       <th>Producto</th>
                                       <th>Valor Unidad</th>
                                       <th>Cantidad</th>
                                       <th>Valor Total</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr v-for="(producto,index) in showDetail.productos">
                                       <td>@{{ producto.nombre_producto }}</td>
                                       <td>$ @{{ producto.pivot['valor_unidad'].toLocaleString() }}</td>
                                       <td>@{{ producto.pivot['cantidad'] }}</td>
                                       <td>$ @{{ producto.pivot['valor_total'].toLocaleString() }}</td>
                                   </tr>
                                   <tr class="bg-info">
                                       <td></td>
                                       <td></td>
                                       <td><strong>Valor Total Cuenta : </strong></td>
                                       <td><strong>$ @{{ showDetail.valor_total.toLocaleString() }} </strong></td>
                                   </tr>
                                   
                               </tbody>
                           </table>
                    </div>

                    </div> <!-- / modal-body -->
      
                </div>
            </div>
        </div>
