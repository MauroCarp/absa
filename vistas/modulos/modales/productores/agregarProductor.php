<div id="modalAgregarProductor" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:90%;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Productor</h4>

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

                            <input type="text" class="form-control input-lg" name="renspa" value="<?php echo $preRenspa;?>" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Propietario</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="propietario" placeholder="Propietario" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Establecimiento</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                            <input type="text" class="form-control input-lg" name="establecimiento" placeholder="Establecimiento" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Tipo Explotaci&oacute;n</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="tipoExplotacion" id="tipoExplotacion" class="form-control input-lg" required>

                                
                                <option value="Cabaña">Cabaña</option>
                                
                                <option value="CIA">CIA</option>
                                
                                <option value="Cria">Cria</option>
                                
                                <option value="Cria/Invernada">Cria / Invernada</option>
                                
                                <option value="Feedlot">Feedlot</option>
                                
                                <option value="U.P Feedlot">U.P Feedlot</option>

                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Regimen</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="regimen" id="regimen" class="form-control input-lg" required>

                                <option value="Arrendatario">Arrendatario</option>
                                
                                <option value="Capitalizacion">Capitalizacion</option>
                                
                                <option value="Pastajero">Pastajero</option>
                                                                
                                <option value="Propietario">Propietario</option>
                            
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

                            <select name="tipoDoc" id="tipoDoc" class="form-control input-lg" required>

                                <option value="DNI">DNI</option>
                                
                                <option value="CUIL">CUIL</option>
                                
                                <option value="CUIT">CUIT</option>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>N° Documento</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input-lg" name="numDoc" placeholder="N° Documento" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>IVA</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-list-ul"></i></span> 

                            <select name="iva" id="iva" class="form-control input-lg" required>

                                <option value="RI">Responsable Inscripto</option>
                                
                                <option value="MT">Responsable Monotributo</option>
                                
                                <option value="EX">Exento</option>

                                <option value="CF">Consumidor Final</option>
                            
                            </select>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Telefono</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="text" class="form-control input-lg" name="telefono" placeholder="Telefono" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>E-mail</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-at"></i></span> 

                            <input type="text" class="form-control input-lg" name="mail" placeholder="E-mail">

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

                            <input type="text" class="form-control input-lg" name="domicilio" placeholder="Domicilio" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Localidad</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="localidad" placeholder="Localidad" required>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-3">
            
                    <div class="form-group">

                        <label>Provincia</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                            <input type="text" class="form-control input-lg" name="provincia" placeholder="Provincia" required>


                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">

                        <label>Departamento</label>
                    
                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input-lg" name="departamento" value="<?php echo $departamento;?>" readonly>

                        </div>

                    </div>
                
                </div>

                <div class="col-md-2">
            
                    <div class="form-group">
    
                        <label>Distrito</label>

                        <div class="input-group">
                        
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                            
                            <select name="distrito" id="distrito" class="form-control input-lg" required>

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
                            
                                <select name="veterinario" id="veterinario" class="form-control input-lg" required>
                            
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

          <button type="submit" class="btn btn-primary">Guardar Productor</button>

        </div>

      </form>

      <?php

        $crearProductor = new ControladorProductores();
        $crearProductor -> ctrCrearProductor();

      ?>

    </div>

  </div>

</div>