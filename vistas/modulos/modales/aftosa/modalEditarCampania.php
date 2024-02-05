
<div id="ventanaModalEditarCampania" class="modal fade" role="dialog"> 

 <div class="modal-dialog">

   <div class="modal-content" style="width:140%">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title">Campa&ntilde;a</h4>

       </div>
        
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
            <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

                    <div class='box-body' style='padding-top:0px;margin-top:0px;'>
                
                      <div class='box-header'>
                          
                          <form  method="post" enctype="multipart/form-data">
                          
                            <div class="row">

                              <div class="col-md-4">

                                  <div class="form-group">

                                      <label>N° Campa&ntilde;a</label>
                                  
                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><b>N°</b></span> 

                                          <input type="number" class="form-control input-lg" name="campaniaNumero" id="campaniaNumero" readOnly>

                                      </div>

                                  </div>

                              </div>

                              <div class="col-md-4">

                                  <div class="form-group">

                                      <label>Fecha Inicio</label>
                                  
                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="fa fa-date"></i></span> 

                                          <input type="date" class="form-control input-lg" name="fechaInicio" id="fechaInicio" required>

                                      </div>

                                  </div>

                              </div>

                              <div class="col-md-4">

                                  <div class="form-group">

                                      <label>Fecha Cierre</label>

                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="fa fa-date"></i></span> 

                                          <input type="date" class="form-control input-lg" name="fechaCierre" id="fechaCierre" required>

                                      </div>

                                  </div>

                              </div>

                            </div>
                           
                            <div class="row">

                              <div class="col-md-4">

                                  <div class="form-group">

                                      <label>Precio Adm. Aftosa</label>
                                  
                                      <div class="input-group">
                                      
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                                          <input type="number" step="0.01" class="form-control input-lg" name="precioAdmAftosa" id="precioAdmAftosa" required>

                                      </div>

                                  </div>

                              </div>

                              <div class="col-md-4">

                                  <div class="form-group">

                                  <label>Precio Vacuna Aftosa</label>
                                  
                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                                          <input type="number" step="0.01" class="form-control input-lg" name="precioVacunaAftosa" id="precioVacunaAftosa" required>

                                      </div>

                                  </div>

                              </div>

                              <div class="col-md-4">

                                  <div class="form-group">

                                  <label>Precio Vet. Aftosa</label>

                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                                          <input type="number" step="0.01" class="form-control input-lg" name="precioVeterinarioAftosa" id="precioVeterinarioAftosa" required>

                                      </div>

                                  </div>

                              </div>

                            </div>
                           
                            <div class="row">

                              <div class="col-md-4">

                                  <div class="form-group">

                                      <label>Precio Adm. Carbunclo</label>
                                  
                                      <div class="input-group">
                                      
                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                                          <input type="number" step="0.01" class="form-control input-lg" name="precioAdmCarb" id="precioAdmCarb" required>

                                      </div>

                                  </div>

                              </div>

                              <div class="col-md-4">

                                  <div class="form-group">

                                  <label>Precio Vacuna Carbunclo</label>
                                  
                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                                          <input type="number" step="0.01" class="form-control input-lg" name="precioVacunaCarb" id="precioVacunaCarb" required>

                                      </div>

                                  </div>

                              </div>

                              <div class="col-md-4">

                                  <div class="form-group">

                                  <label>Precio Vet. Carbunclo</label>

                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                                          <input type="number" step="0.01" class="form-control input-lg" name="precioVeterinarioCarb" id="precioVeterinarioCarb" required>

                                      </div>

                                  </div>

                              </div>

                            </div>

                            <div class="row">

                              <div class="col-md-8">

                                  <div class="form-group">

                                  <label>Existencia Animal</label>

                                      <div class="input-group">
                                      
                                          <span class="input-group-addon"><i class="icon-COW"></i></span> 

                                          <input type="file" class="form-control" name="existenciaAnimal" id="existenciaAnimal">

                                      </div>

                                  </div>

                              </div>

                            </div>
                            
                            <div class="row">

                              <div class="col-lg-12">
                                
                                <button class="btn btn-block btn-primary" type="submit" name="editarCampania"><b>Editar Campa&ntilde;a</b></button>
                              
                              </div>

                            </div>
                          </form>
                                
                      </div>

                    </div>

            </div>

   </div>

 </div>

</div>

<?php

$editarCampania = new ControladorAftosa();
$editarCampania -> ctrEditarDatosCampania();

?>