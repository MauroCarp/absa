<div id="modalEditarVeterinario" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:85%;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Vacunador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Nombre</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="hidden"  name="idEdit" id="idEdit">
                            
                            <input type="text" class="form-control input-lg" name="nombreEdit" id="nombreEdit" placeholder="Nombre" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Matricula</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="matriculaEdit" id="matriculaEdit" placeholder="Matricula" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Domicilio</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="domicilioEdit" id="domicilioEdit" placeholder="Domicilio">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Telefono</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="text" class="form-control input-lg" name="telefonoEdit" id="telefonoEdit" placeholder="Telefono">

                        </div>

                    </div>
                
                </div>
            </div>
            
            <div class="row">

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>E-mail</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                            <input type="text" class="form-control input-lg" name="emailEdit" id="emailEdit" placeholder="E-mail">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>CUIT</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                            <input type="text" class="form-control input-lg" name="cuitEdit" id="cuitEdit" placeholder="CUIT">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Tipo</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="tipoEdit" id="tipoEdit" class="form-control input-lg" required>
                                
                            </select>

                        </div>

                    </div>
                
                </div>
            
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Modificar Vacunador</button>

        </div>

      </form>

      <?php

        $editarVeterinario = new ControladorVeterinarios();
        $editarVeterinario -> ctrEditarVeterinario();

      ?>

    </div>

  </div>

</div>