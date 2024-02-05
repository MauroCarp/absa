
<div id="modalEditarProductor" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:90%;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Productor/Establecimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="row">

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>RENSPA</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                            <input type="hidden" class="form-control input-lg" name="idEdit" id="idEdit">
                            
                            <input type="text" class="form-control input-lg" name="renspaEdit" id="renspaEdit" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Propietario</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="propietarioEdit" id="propietarioEdit" placeholder="Propietario" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Establecimiento</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                            <input type="text" class="form-control input-lg" name="establecimientoEdit" id="establecimientoEdit" placeholder="Establecimiento" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Tipo Explotaci&oacute;n</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="tipoExplotacionEdit" id="tipoExplotacionEdit" id="tipoExplotacion" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Regimen</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="regimenEdit" id="regimenEdit" id="regimen" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>
            
            </div>

            <div class="row">

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Tipo Doc.</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span> 

                            <select name="tipoDocEdit" id="tipoDocEdit" id="tipoDoc" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>N° Documento</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="numDocEdit" id="numDocEdit" placeholder="N° Documento" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>IVA</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="ivaEdit" id="ivaEdit" id="iva" class="form-control input-lg" required>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Telefono</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="text" class="form-control input-lg" name="telefonoEdit" id="telefonoEdit" placeholder="Telefono">

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>E-mail</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                            <input type="text" class="form-control input-lg" name="mailEdit" id="mailEdit" placeholder="E-mail">

                        </div>

                    </div>
                
                </div>
            
            </div>

            <div class="row">

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Domicilio</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="domicilioEdit" id="domicilioEdit" placeholder="Domicilio" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Localidad</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="localidadEdit" id="localidadEdit" placeholder="Localidad" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Provincia</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                            <input type="text" class="form-control input-lg" name="provinciaEdit" id="provinciaEdit" placeholder="Provincia" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Departamento</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="departamentoEdit" id="departamentoEdit" value="<?php echo $departamento;?>" readonly>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">
    
                        <label>Distrito</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                            <select name="distritoEdit" id="distritoEdit"  class="form-control input-lg" required>
                            <?php

                                foreach ($distritos as $key => $value) {
                                    
                                    echo "<option value='$key'>$value</option>";

                                }
                                    
                                ?>
                            </select>

                        </div>

                    </div>
                
                </div>
            
            </div>
            
            <div class="row"> 

                <div class="col-md-2">
            
                    <div class="form-group">
    
                        <label>Veterinario</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                                <select name="veterinarioEdit" id="veterinarioEdit" class="form-control input-lg" required>
                            
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

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

        $editarProductor = new ControladorProductores();
        $editarProductor -> ctrEditarProductor();

      ?>

    

    </div>

  </div>

</div>