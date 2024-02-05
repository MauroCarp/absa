<?php

$interValido = $_GET['inter'];

$inter = ($interValido) ? 'Inter-Campaña' : '';

?>
<div class="content-wrapper">

    <section class="content-header">

        <h1>Acta <?=$inter?></h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            
            <li>Aftosa</li>

            <li class="active">Acta</li>

        </ol>

    </section>

    <section class="content" style="font-size:1.4em;">

    <form method="POST" role="form" id="form-acta">
      
      <!-- DATOS PRODUCTOR -->

      <?php

        $item = 'renspa';

        $valor = $_GET['renspa'];

        $resultado = ControladorProductores::ctrMostrarProductores($item,$valor);

        $item = 'matricula';

        $valor = $resultado['veterinario'];

        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item,$valor);

      ?>

      <div class="row">
    
        <div class="col-md-3">

          <div class="form-group">
              
              <label for="renspa"><b>R.E.N.S.P.A: </b></label>
              
              <input type="text" class="form-control"  style="font-size:1.2em;" name="renspaProductor" id="renspaProductor" value="<?php echo $resultado['renspa'];?>" readOnly>
            
              <input type="hidden" id="matriculaVeterinario" value="<?php echo $resultado['veterinario'];?>">
              <input type="hidden" id="interCampania" name="interCampania" value="<?=$_GET['inter']?>">

          </div>
        
        </div>
        
        <div class="col-md-3">

          <div class="form-group">
              
              <label for="propietario"><b>Propietario: </b></label>
              
              <input type="text" class="form-control" style="font-size:1.2em;"  id="propietario" name="propietario" value="<?php echo $resultado['propietario'];?>" readOnly>
            
          </div>
        
        </div>
  
        <div class="col-md-3">
        
          <div class="form-group">
                
                <label for="establecimiento"><b>Establecimiento: </b></label>
                
                <input type="text" class="form-control" style="font-size:1.2em;"  id="establecimiento" name="establecimiento"  value="<?php echo $resultado['establecimiento'];?>" readOnly>
              
          </div>
           
        </div>

        <div class="col-md-3">
        
          <div class="form-group">
                
                <label for="veterinario"><b>Veterinario: </b></label>
                
                <input type="text" class="form-control" style="font-size:1.2em;"  id="veterinario"  name="veterinario"  value="<?php echo $veterinario['nombre'];?>" readOnly>
              
          </div>
           
        </div>

      </div>
      
      <div class="lineaSeparadora"></div>

      <!---------------------------------------
        CARGAR DATOS ACTA 
        ------------------------------------------>

        <?php

            $item = 'renspa';

            $valor = $resultado['renspa'];

            $item2 = 'intercampania';

            $valor2 = $_GET['inter'];

            $dataActa = ControladorActas::ctrMostrarActa($item,$valor,$item2,$valor2);
    
      ?>
      <div class="row">

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="fechaVacunacion">Fecha de Vacunaci&oacute;n</label>
            
            <input type="date" class="form-control" id="fechaVacunacion" name="fechaVacunacion" value="<?php echo $dataActa['fechaVacunacion'];?>" required>
          
          </div>

        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="fechaRecepcion">Fecha de Recepci&oacute;n</label>
            
            <input type="date" class="form-control" id="fechaRecepcion" name="fechaRecepcion" value="<?php echo $dataActa['fechaRecepcion'];?>" required>
          
          </div>

        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="vacunador">Vacunador</label>
            <input type="hidden" id="matriculaVacunador" value="<?=$dataActa['matricula']?>">
            <select name="matricula" id="vacunador" name="vacunador" class="form-control">
            </select>

          </div>
          
        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="cantidadVacunas">Vacunas Suministradas</label>
            
            <input type="number" class="form-control" id="cantidadVacunas" name="cantidadVacunas" value="<?php echo $dataActa['cantidadPar'];?>">
          
          </div>

        </div>

        <div class="col-md-2">

          <div class="form-group">
            
            <label for="actaNumero">Acta</label>
            
            <input type="text" class="form-control" id="actaNumero" name="actaNumero" value="<?php echo $dataActa['acta'];?>" required>
          
          </div>

        </div>

        <div class="col-md-1">
          
          <div class="form-group">
            
            <label for="pago">Pag&oacute;</label>
            <br>
            <input type="checkbox" class="checkbox" id="pago" name="pago" <?php if($dataActa['pago']){ echo 'checked';} ?>>
          
          </div>

        </div>

        <div class="col-md-1"> 
          
          <div class="form-group">
            
            <label for="monto">Monto</label>
            
            <br>
            
            <span id="monto" style="color:#00A00F;font-size: 30px;font-weight: bold;cursor: pointer;" class="fa fa-file-text-o" data-toggle="modal" data-target="#ventanaModalMonto">
          
          </div>

        </div>

      </div>

      <div class="lineaSeparadora"></div>

      <!-- CANTIDAD ANIMALES -->
      <div class="row">

        <div class="col-md-1"></div>

        <div class="col-md-1"> 
          
          <h4 style="line-height:35px;"><b>Vacas</b>:</h6>
          <input type="number" min="0" class="form-control sumTotal" name="vacas" value="0">
        
        </div>

        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Toros</b>:</h6>
          <input type="number" min="0" class="form-control sumTotal" name="toros" value="0">
          
        </div>

        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Toritos</b>:</h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="toritos" value="0">
          
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Novillos</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="novillos" value="0">
          
        </div>

        <div class="col-md-1">
  
          <h4 style="line-height:35px;"><b>Novillitos</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="novillitos" value="0">
  
        </div>
  
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Vaquillonas</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="vaquillonas" value="0">
          
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Terneras</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="terneras" value="0">
          
        </div>
        
        <div class="col-md-1">

          <h4 style="line-height:35px;"><b>Terneros</b></h6>
          <input type="number" min="0" class="form-control sumTotal sumParcial" name="terneros" value="0">
        
        </div>
        
        <div class="col-md-1">

          <h4 style="line-height:35px;"><b>Parcial</b></h6>        
          <input type="text" class="form-control" id="campoParcial" value="0" disabled>
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Total</b></h6>
          <input type="text" class="form-control" id="campoTotal" value="0" disabled>
        
        </div>
      
        <div class="col-md-1"></div>

      </div>

      <div class="row">
        
        <div class="col-md-3"></div>
        
        <div class="col-md-1">

          <h4 style="line-height:35px;"><b>B&uacute;f. May.:</b></h4>
          <input type="number" min="0" class="form-control" name="bufaloMay" value="0">
        
        </div>
        
        <div class="col-md-1">
          
          <h4 style="line-height:35px;"><b>B&uacute;f. Men.:</b></h4>
          <input type="number" min="0" class="form-control" name="bufaloMen" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Caprinos</b>:</h4>
          <input type="number" min="0" class="form-control" name="caprinos" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Ovinos</b></h4>
          <input type="number" min="0" class="form-control" name="ovinos" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Porcinos</b></h4>
          <input type="number" min="0" class="form-control" name="porcinos" value="0">
        
        </div>
        
        <div class="col-md-1">
        
          <h4 style="line-height:35px;"><b>Equinos</b></h4>
          <input type="number" min="0" class="form-control" name="equinos" value="0">
        
        </div>
      
      </div>

      <div class="lineaSeparadora"></div>

      <!-- CARBUNCLO / BRUCELOSIS -->
      <div class="row">

        <div class="col-md-4"></div>

        <div class="col-md-2">
        
          <div class="form-group">
              
              <label><b>Carbunclo</b></label>
              
              <div class="row">
              
                <div class="col-md-2">
                
                  <input type="checkbox" class="checkbox" id="vacunoCarbunclo" name="vacunoCarbunclo" <?php if($dataActa['vacunoCar']){echo 'checked';}?>> 
                
                </div>

                <div class="col-md-7">
                
                  <input type="number" class="form-control" id="cantidadCarbunclo" name="cantidadCarbunclo" value="<?php echo $dataActa['cantidadCar']?>">
                
                </div>
            
              </div>
            
          </div>

        </div>

        <div class="col-md-2">
          
          <div class="form-group">
              
              <label><b>Brucelosis</b></label>
              
              <div class="row">
              
                <div class="col-md-2">
                
                  <input type="checkbox" class="checkbox" id="vacunoBrucelosis"  name="vacunoBrucelosis" <?php if($dataActa['vacunoBruce']){echo 'checked';}?>>
                
                </div>

                <div class="col-md-7">
                
                  <input type="number" class="form-control" id="cantidadBrucelosis"  name="cantidadBrucelosis" value="<?php echo $dataActa['cantidadBruce']?>">
                
                </div>
              
              </div>
            
          </div>
        
        </div>
      
        <div class="col-md-4"></div>

      </div>
      
      <div class="lineaSeparadora"></div>

      <!-- BOTON CARGAR ACTA -->
      <div class="row">

        <div class="col-md-4"></div>
        <div class="col-md-4"><button type="submit" class="btn btn-primary btn-lg btn-block" id="btnIngresarActa" name="btnIngresarActa">Modificar Acta</button></div>
        <div class="col-md-4"></div>
      
      </div>

  </section>
    
</div>


<!-- MODAL MONTO  -->
<div id="ventanaModalMonto" class="modal fade" role="dialog">
 
 <div class="modal-dialog">

   <div class="modal-content" id="modalPrincipal" style="width:250px;left:200px">


       <!--=====================================
       CABEZA DEL MODAL
       ======================================-->

       <div class="modal-header" style="background:#3c8dbc; color:white">

         <button type="button" class="close" data-dismiss="modal">&times;</button>

         <h4 class="modal-title">Montos</h4>

       </div>
         
             <!--=====================================
             CUERPO DEL MODAL
             ======================================-->
             <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

               <div class='box-body' style='padding-top:0px;margin-top:0px;'>
                
               <br>
                       
                <div class="form-group">

                  <label><b>Redondeo Aftosa:</b></label>
                  <div class="row">
                    
                    <div class="col-xs-12">
                    
                      <input type="number" step="0.01" name="montoRedondeoAf" class="form-control input-xs" value="0">
                    
                    </div>
                  
                  </div>
                
                </div>

                <div class="form-group">

                  <label><b>Redondeo Carbunclo:</b></label>
                  
                  <div class="row">
                    
                    <div class="col-xs-12">
                    
                      <input type="number" step="0.01" name="montoRedondeoCar" class="form-control input-xs" value="0">
                    
                    </div>
                  
                  </div>

                </div>
              
              </form>

               </div>

             </div>

             <!--=====================================
             PIE DEL MODAL
             ======================================-->

             <div class="modal-footer">

                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

             </div>

   </div>

 </div>

</div>
</form>

<?php

$actualizarActa = new ControladorActas();
$actualizarActa -> ctrActualizarActa();

?>