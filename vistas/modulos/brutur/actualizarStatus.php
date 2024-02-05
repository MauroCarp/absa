<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$estadosBrucelosis = array('DOES Total','DOES Muestreo','Tecnica PAL','MuVe','SAN','CSM','Control Interno','Remuestreo');

$estadosTuberculosis = array('Libre','Recertificacion','No Libre','En Saneamiento');

$renspa = $_GET['renspa'];

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Brucelosis / Tuberculosis - Actualizar Status Sanitarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Brucelosis / Tuberculosis - Actualizar Status Sanitarios</li>
    
    </ol>

  </section>
  
  <section class="content">
   
        <div class="box box-primary">
                
            <div class="box-header with-border">
            
                <h3 class="box-title" style="font-size:180%">Actualizar Status Sanitario</h3>
            
            </div>
                
            <div class="box-body" style="font-size:1.5em;">

                <div class="row">

                    <div class="col-md-2">
                        
                        <strong><i class="fa fa-home margin-r-5"></i> R.E.N.S.P.A</strong>

                        <p class="text-muted" id="renspaProductor">
                        </p>

                        <hr>
                    
                    </div>

                    <div class="col-md-3">
                        
                        <strong><i class="fa fa-home margin-r-5"></i> Establecimiento</strong>

                        <p class="text-muted" id="establecimiento">
                        </p>

                        <hr>
                    
                    </div>
                    
                    <div class="col-md-2">
                    
                        <strong><i class="icon-tractor margin-r-5"></i> Productor</strong>

                        <p class="text-muted" id="productor"></p>

                        <hr>

                    </div>
                    
                    <div class="col-md-2">

                        <strong><i class="icon-jeringa margin-r-5"></i> Veterinario</strong>

                        <p class="text-muted" id="veterinario"></p>

                        <hr>

                    </div>
                    
                    <div class="col-md-2">
                    
                        <strong><i class="icon-corral margin-r-5"></i> Tipo Explotaci&oacute;n</strong>

                            <p class="text-muted" id="tipoExplotacion"></p>

                            <hr>                    

                    </div>
                
                </div>

                <div class="row" style="font-size:120%;">
                    
                    <?php
                    
                    // BRUCELOSIS
                    
                    include 'brucelosis.php';
                    
                    // TUBERCULOSIS

                    include 'tuberculosis.php';
                    
                    ?>

                </div>
            
                <button class="btn btn-success" data-toggle="modal" data-target="#ventanaModalActualizarStatus" id="btnActualizarStatus"><b>Actualizar Status</b></button>
            </div>

        </div>
  
  </section>

</div>

<!-- MODAL HISTORIA BRUCELOSIS -->

<?php

$idVentanaModal = 'ventanaModalHistorialBrucelosis';

$tituloModal = 'Historial de Registros Brucelosis';

?>

<div id="<?php echo $idVentanaModal;?>" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:1000px;left:-250px;max-height:1000px;">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title"><?php echo $tituloModal;?></h4>

       </div>

       <!--=====================================
       CUERPO DEL MODAL
       ======================================-->
       <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

           <div class='box-body' style='padding-top:0px;margin-top:0px;'>
           
               <div class='box-header'>
                                   
                   <div class="row">
                       
                       <div class="col-md-8">
                       
                           <label><h4><b>Historial Registros</b></h4></label>
                           
                       </div>
                   
                   </div>
                   
                   <div class="row">
                       
                       <div class="col-md-12" style="overflow-y:scroll;max-height:600px;">

                            <table class="table table-stripped historial">
                               
                                <thead>
                               
                                    <th>Fecha de Muestra</th>
                               
                                    <th>Protocolo</th>
                               
                                    <th>Estado</th>
                               
                                    <th>Cant. Muestras</th>
                                    
                                    <th>Saneamiento N°</th>
                               
                                    <th><i class="fa fa-plus-square"></i></th>
                               
                                    <th><i class="fa fa-minus-square"></i></th>
                               
                                    <th>Sospechosos</th>
                               
                                </thead>

                                <tbody id="historialBrucelosis">
                                
                                </tbody>
                            
                            </table>

                       </div>

                   </div>

               </div>

           </div>

       </div>

   </div>

 </div>

</div>


<!-- MODAL HISTORIA TUBERCULOSIS -->

<?php

$idVentanaModal = 'ventanaModalHistorialTuberculosis';

$tituloModal = 'Historial de Registros Tuberculosis ';

?>

<div id="<?php echo $idVentanaModal;?>" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:1000px;left:-250px;max-height:1000px;">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title"><?php echo $tituloModal;?></h4>

       </div>

       <!--=====================================
       CUERPO DEL MODAL
       ======================================-->
       <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

           <div class='box-body' style='padding-top:0px;margin-top:0px;'>
           
               <div class='box-header'>
                                   
                   <div class="row">
                       
                       <div class="col-md-8">
                       
                           <label><h4><b>Historial Registros</b></h4></label>
                           
                       </div>
                   
                   </div>
                   
                   <div class="row">
                       
                       <div class="col-md-12" style="overflow-y:scroll;max-height:600px;">

                            <table class="table table-stripped historial">
                               
                                <thead>
                               
                                    <th>Fecha de Muestra</th>
                               
                                    <th>Protocolo</th>
                               
                                    <th>Motivo</th>
                               
                                    <th>Cant. Muestras</th>

                                    <th>Saneamiento N°</th>
                               
                                    <th><i class="fa fa-plus-square"></i></th>
                               
                                    <th><i class="fa fa-minus-square"></i></th>
                               
                                    <th>Sospechosos</th>
                               
                                </thead>

                                <tbody id="historialTuberculosis">
                                
                                </tbody>
                            
                            </table>

                       </div>

                   </div>

               </div>

           </div>

       </div>

   </div>

 </div>

</div>


<!-- MODAL ACTUALIZAR STATUS -->

<?php

$idVentanaModal = 'ventanaModalActualizarStatus';

$tituloModal = 'Actualizar Status Sanitario';

?>

<div id="<?php echo $idVentanaModal;?>" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:850px;left:-200px;max-height:1000px;">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title"><?php echo $tituloModal;?></h4>

       </div>

       <!--=====================================
       CUERPO DEL MODAL
       ======================================-->
       <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

           <div class='box-body' style='padding-top:0px;margin-top:0px;'>
           
               <div class='box-header'>
                                   
                   <div class="row">
                       
                       <div class="col-md-8">
                       
                           <label><h4><b>Status Sanitario</b></h4></label>
                           
                       </div>
                   
                   </div>
                
                    <form role="form" method="POST">

                        <?php

                            $valor = $_GET['renspa'];
                                
                            $datosBruTur = ControladorBruTur::ctrMostrarBruTur($valor);

                            $fechaEstadoBruce = null;
                            
                            $fechaEstadoTuber = null;

                            ?>

                        <input type="hidden" name="renspaHidden" value="<?php echo $datosBruTur['renspa'];?>">
                        <input type="hidden" id="cambiosBrucelosis" name="cambiosBrucelosis">
                        <input type="hidden" id="cambiosTuberculosis" name="cambiosTuberculosis">

                        <div class="row">
                                
                                <!-- BRUCELOSIS -->
                                
                                <div class="col-md-6"  style="border-right:solid;">

                                    <h3>Brucelosis</h3>

                                    <div class="row">

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Vacas</label>
                                            
                                                <input type="number" class="form-control animalesBruceEditar" id="vacasBruceAct" name="vacasBruceAct" value="<?php echo $datosBruTur['vacasBruce'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Vaquillonas</label>
                                            
                                                <input type="number" class="form-control animalesBruceEditar" id="vaquillonasBruceAct" name="vaquillonasBruceAct" value="<?php echo $datosBruTur['vaquillonasBruce'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Toros</label>
                                            
                                                <input type="number" class="form-control animalesBruceEditar" id="torosBruceAct" name="torosBruceAct" value="<?php echo $datosBruTur['torosBruce'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Total</label>
                                            
                                                <input type="number" class="form-control" id="totalBruceEditar" name="totalBruceEditar" readOnly>
                                            
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                    
                                        <div class="col-md-12">
                                        
                                            <div class="form-group">
                                            
                                                <label>Protocolo</label>
                                            
                                                <input type="text" class="form-control" id="protocoloBruceAct" name="protocoloBruceAct" value="<?php echo $datosBruTur['protocoloBruce'];?>">
                                            
                                            </div>
                                        
                                        </div>

                                    </div>
                                
                                    <div class="row">
                                    
                                        <div class="col-md-12">
                                        
                                            <div class="form-group">
                                            
                                                <label>Estado</label>

                                                <select class="form-control" name="estadoBruceAct" id="estadoBruceAct">
                                                
                                                <?php

                                                    foreach ($estadosBrucelosis as $key => $value) {

                                                        $selected = ($value == $datosBruTur['estadoBruce']) ? 'selected' : '';

                                                        echo "<option value='$value' $selected>$value</option>";

                                                    }

                                                ?>

                                                </select>

                                            </div>
                                        
                                        </div>

                                    </div>
                                    
                                    <!-- DATOS POSITIVOS, NEGATIVOS , SOSPECHOSOS -->
                                    <div class="row">

                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                                <label>N°</label>
                                            
                                                <input type="number" class="form-control" id="saneamientoNumBruceAct" name="saneamientoNumBruceAct" value="<?php echo $datosBruTur['saneamientoNumeroBruce'];?>">
                                            
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                                <label><i class="fa fa-plus-square"></i></label>
                                            
                                                <input type="number" class="form-control" id="positivoBruceAct" name="positivoBruceAct" value="<?php echo $datosBruTur['positivoBruce'];?>">
                                            
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                            <label><i class="fa fa-minus-square"></i></label>
                                            
                                            <input type="number" class="form-control" id="negativoBruceAct" name="negativoBruceAct" value="<?php echo $datosBruTur['negativoBruce'];?>">
                                            
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                            <label>Sospechoso</label>
                                            
                                            <input type="number" class="form-control" id="sospechosoBruceAct" name="sospechosoBruceAct" value="<?php echo $datosBruTur['sospechosoBruce'];?>">
                                            
                                            </div>
                                        
                                        </div>

                                    </div>

                                    <div class="row" id="inputFechaMuestraBruce">
                                    
                                        <div class="col-md-12">
                                        
                                            <div class="form-group">
                                            
                                                <label>Fecha de Muestra</label>
                                            
                                                <input type="date" class="form-control" id="fechaMuestraBruceAct" name="fechaMuestraBruceAct" value="<?php echo $datosBruTur['fechaEstadoBruce'];?>">
                                            
                                            </div>
                                        
                                        </div>

                                    </div>
                                    
                                </div>

                                <!-- TUBERCULOSIS -->
                                
                                <div class="col-md-6">

                                    <h3>Tuberculosis</h3>

                                    <!-- AMIMALES -->
                                    <div class="row">

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Vacas</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="vacasTuberAct" name="vacasTuberAct" value="<?php echo $datosBruTur['vacasTuber'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Vaquillonas</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="vaquillonasTuberAct" name="vaquillonasTuberAct" value="<?php echo $datosBruTur['vaquillonasTuber'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Terneros</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="ternerosTuberAct" name="ternerosTuberAct" value="<?php echo $datosBruTur['ternerosTuber'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Terneras</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="ternerasTuberAct" name="ternerasTuberAct" value="<?php echo $datosBruTur['ternerasTuber'];?>">
                                            
                                            </div>

                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row">

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Toros</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="torosTuberAct" name="torosTuberAct" value="<?php echo $datosBruTur['torosTuber'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Novillos</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="novillosTuberAct" name="novillosTuberAct" value="<?php echo $datosBruTur['novillosTuber'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Novillitos</label>
                                            
                                                <input type="number" class="form-control animalesTuberEditar" id="novillitosTuberAct" name="novillitosTuberAct" value="<?php echo $datosBruTur['novillitosTuber'];?>">
                                            
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            
                                            <div class="form-group">
                                            
                                                <label>Total</label>
                                            
                                                <input type="number" class="form-control" id="totalTuberEditar" name="totalTuberEditar" readOnly>
                                            
                                            </div>

                                        </div>
                                    
                                    </div>
                                    
                                    <!-- PROTOCOLO -->
                                    <div class="row">
                                    
                                        <div class="col-md-12">
                                        
                                            <div class="form-group">
                                            
                                                <label>Protocolo</label>
                                            
                                                <input type="text" class="form-control" id="protocoloTuberAct" name="protocoloTuberAct" value="<?php echo $datosBruTur['protocoloTuber'];?>">
                                            
                                            </div>
                                        
                                        </div>

                                    </div>
                                
                                    <!-- ESTADO -->
                                    <div class="row">
                                    
                                        <div class="col-md-12">
                                        
                                            <div class="form-group">
                                            
                                                <label>Estado</label>
                                            
                                                <select class="form-control" name="estadoTuberAct" id="estadoTuberAct">
                                                
                                                <?php

                                                    foreach ($estadosTuberculosis as $key => $value) {
                                                        $selected = ($value == $datosBruTur['estadoTuber']) ? 'selected' : '';

                                                        echo "<option value='$value' $selected>$value</option>";

                                                    }

                                                ?>

                                                </select>
                                            
                                            </div>
                                        
                                        </div>

                                    </div>
                                    
                                    <!-- DATOS SANEAMIENTO -->
                                    <div class="row" id="inputSaneamientoTuber" style="display:none;">
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                                <label>N°</label>
                                            
                                                <input type="number" class="form-control" id="saneamientoNumTuberAct" name="saneamientoNumTuberAct" value="<?php echo $datosBruTur['saneamientoNumeroTuber'];?>">
                                            
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                                <label><i class="fa fa-plus-square"></i></label>
                                            
                                                <input type="number" class="form-control" id="positivoTuberAct" name="positivoTuberAct" value="<?php echo $datosBruTur['positivoTuber'];?>">
                                            
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                            <label><i class="fa fa-minus-square"></i></label>
                                            
                                            <input type="number" class="form-control" id="negativoTuberAct" name="negativoTuberAct" value="<?php echo $datosBruTur['negativoTuber'];?>">
                                            
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                            
                                            <label>Sospechoso</label>
                                            
                                            <input type="number" class="form-control" id="sospechosoTuberAct" name="sospechosoTuberAct" value="<?php echo $datosBruTur['sospechosoTuber'];?>">
                                            
                                            </div>
                                        
                                        </div>

                                    </div>

                                    <!-- FECHA MUESTRA -->
                                    <div class="row" id="inputFechaMuestraTuber">
                                    
                                        <div class="col-md-12">
                                        
                                            <div class="form-group">
                                            
                                                <label>Fecha de Muestra</label>
                                            
                                                <input type="date" class="form-control" id="fechaMuestraTuberAct" name="fechaMuestraTuberAct" value="<?php echo $datosBruTur['fechaEstadoTuber'];?>">
                                            
                                            </div>
                                        
                                        </div>

                                    </div>

                                </div>

                        </div>
                        
                        <hr>
                        
                        <div class="row">

                            <div class="col-md-12">
                            
                                <button type="submit" class="btn btn-block btn-success" name="actualizarStatus"><b>Actualizar Status</b></button>

                            </div>
                        
                        </div>

                        <?php

                        $actualizarStatus = new ControladorBruTur();
                        $actualizarStatus -> ctrActualizarStatus();
                                                    
                        $notificarStatus = new ControladorBruTur();
                        $notificarStatus -> ctrNotificar();
                        
                        ?>

                    </form>

               </div>

           </div>

       </div>

   </div>

 </div>

</div>
<script>

$(()=>{

    $('.text-muted').css('font-size','1em');

    let renspa = getQueryVariable('renspa');

    mostrarDatosStatus(renspa);

    setTimeout(() => {
        
        sumarAnimales('animalesBrucelosis','totalBruce','text')

        sumarAnimales('animalesTuberculosis','totalTuber','text')
        
    }, 500);

    mostrarHistorial(renspa);

})

</script>

<?php

$eliminarRegistro = new ControladorBruTur();
$eliminarRegistro -> ctrEliminarRegistro();

?>
