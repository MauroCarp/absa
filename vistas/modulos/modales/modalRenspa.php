
<div id="<?php echo $idVentanaModal;?>" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:500px">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title"><b><?php echo $tituloModal;?></b></h4>

       </div>
        
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
            <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

                    <div class='box-body' style='padding-top:0px;margin-top:0px;'>
                
                        <div class='box-header'>
                        
                                <div class="row">
                                    
                                    <div class="col-md-8">
                                    
                                        <label><h4><b>R.E.N.S.P.A</b></h4></label>
                                        
                                    </div>
                                
                                </div>

                                <form id="<?php echo $form;?>">

                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                        
                                                <input type="text" name="<?php echo $idRenspa;?>" id="<?php echo $idRenspa;?>" style="font-size:2em;font-weight:bold;" value="<?php echo $preRenspa;?>">
                                            
                                        </div>

                                    </div>
                                    
                                    <?php 
                                    
                                    if($motivo == 'aftosa'){ ?>

                                    <div class="row">
    
                                        <div class="checkbox" style="font-size:1em;">
                                            <label>
                                                <label>

                                                    <input type="checkbox" name="interCampania" id="interCampania" value="true"><b> InterCampa&ntilde;a</b>

                                                </label>

                                            </label>

                                        </div>
                                    
                                    </div>
                                
                                    <?php 
                                    }
                                    ?>
                                
                                </form>

                        </div>

                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="submit" class="btn btn-primary" form="<?php echo $form;?>" id="<?php echo $idBtnGenerar;?>"><?php echo $btnText;?></button>

            </div>

   </div>

 </div>

</div>