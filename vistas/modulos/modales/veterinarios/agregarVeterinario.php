<div id="modalAgregarVeterinario" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:85%;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Vacunador</h4>

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

                            <input type="text" class="form-control input-lg" name="nombre" placeholder="Nombre" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Matricula</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="matricula" placeholder="Matricula" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Domicilio</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="domicilio" placeholder="Domicilio" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Telefono</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="text" class="form-control input-lg" name="telefono" placeholder="Telefono" required>

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

                            <input type="text" class="form-control input-lg" name="email" placeholder="E-mail">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>CUIT</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                            <input type="text" class="form-control input-lg" name="cuit" placeholder="CUIT">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Tipo</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="tipo" id="tipo" class="form-control input-lg" required>

                                <option value="Veterinario">Veterinario</option>
                                
                                <option value="Idóneo">Id&oacute;neo</option>
                                
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

          <button type="submit" class="btn btn-primary">Guardar Vacunador</button>

        </div>

      </form>

      <?php

        $crearVeterinario = new ControladorVeterinarios();
        $crearVeterinario -> ctrCrearVeterinario();

      ?>

    </div>

  </div>

</div>