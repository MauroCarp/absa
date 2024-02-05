
<div id="<?php echo $idModal; ?>" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:500px">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title"><b>Buscar por Matricula</b></h4>

       </div>
        
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
            <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

                    <div class='box-body' style='padding-top:0px;margin-top:0px;'>
                
                        <div class='box-header'>
                        
                                <div class="row">
                                    
                                    <div class="col-md-8">
                                    
                                        <label><h4><b>Matricula Veterinario</b></h4></label>
                                        
                                    </div>
                                
                                </div>

                                <form id="form-matricula<?php echo $informeNum;?>" class="formBuscarMatricula">

                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                        
                                                <input type="text" id="matriculaInforme<?php echo $informeNum;?>" maxlength="6" style="font-size:2em;font-weight:bold;">
                                            
                                        </div>

                                    </div>
                                
                                </form>

                        </div>

                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary buscarMatricula" form="form-matricula<?php echo $informeNum;?>" informe="<?php echo $informeNum;?>">Informe</button>

            </div>

   </div>

 </div>

</div>