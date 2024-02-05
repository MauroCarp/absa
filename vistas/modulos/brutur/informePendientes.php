<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$respuestaBrucelosis = ControladorBruTur::ctrMostrarPendientes('brucelosis');
$respuestaTuberculosis = ControladorBruTur::ctrMostrarPendientes('tuberculosis');

$btnValido = (!empty($respuestaBrucelosis) OR !empty($respuestaTuberculosis)) ? '' : 'disabled';

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Brucelosis / Tuberculosis - Pendientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Brucelosis / Tuberculosis - Pendientes</li>
    
    </ol>

  </section>
  
  <section class="content">
   
    <div class="box">
  
      <div class="box-body">

          
          <button class="btn btn-primary" id="btnEnviarSenasa" <?php echo $btnValido;?>>Enviar a Senasa</button>
       

        <hr>
        <table class="table table-bordered table-striped dt-responsive tablas tablaPendientes" width="100%">
          
          <thead>
          
          <tr>
            
            <th>Renspa</th>
            <th>Establecimiento</th>
            <th>Protocolo</th>
            <th>Campa&ntilde;a</th>
            <th>Estado</th>
            <th>Fecha Cargado</th>
            <th>Fecha Muestra</th>
            
          </tr> 
  
          </thead>      
  
          <tbody>
  
          <?php
  

            if(!empty($respuestaBrucelosis)){
             
              for ($i=0; $i < sizeof($respuestaBrucelosis) ; $i++) { 

                $mostrarValido = TRUE;

                $mostrarValido = ($respuestaBrucelosis[$i]['estado'] == 'DOES Total' AND $respuestaBrucelosis[$i]['positivo'] != 0) ? FALSE : TRUE;

                if($mostrarValido){
                
                  echo "            
                  <tr>
      
                    <td>".$respuestaBrucelosis[$i]['renspa']."</td>
                    
                    <td>".$respuestaBrucelosis[$i]['establecimiento']."</td>
                    
                    <td>".$respuestaBrucelosis[$i]['protocolo']."</td>
                    
                    <td>Brucelosis</td>

                    <td>".$respuestaBrucelosis[$i]['estado']."</td>
                    
                    <td>".formatearFecha($respuestaBrucelosis[$i]['fechaCarga'])."</td>
                    
                    <td>".formatearFecha($respuestaBrucelosis[$i]['fechaEstado'])."</td>
                    
                  </tr>";
                
                }


              }
    
            }
           
            if(!empty($respuestaTuberculosis)){

              for ($i=0; $i < sizeof($respuestaTuberculosis) ; $i++) { 
                              
                echo "            
                <tr>
    
                  <td>".$respuestaTuberculosis[$i]['renspa']."</td>
                  
                  <td>".$respuestaTuberculosis[$i]['establecimiento']."</td>
                  
                  <td>".$respuestaTuberculosis[$i]['protocolo']."</td>
                  
                  <td>Tuberculosis</td>

                  <td>".$respuestaTuberculosis[$i]['estado']."</td>
                  
                  <td>".formatearFecha($respuestaTuberculosis[$i]['fechaCarga'])."</td>
                  
                  <td>".formatearFecha($respuestaTuberculosis[$i]['fechaEstado'])."</td>
                  
                </tr>";
                
              }

            }
          ?>
          
          </tbody>

        </table>


      </div>
  
    </div>
  
  </section>

</div>