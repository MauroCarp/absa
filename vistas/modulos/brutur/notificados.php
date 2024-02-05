<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Brucelosis / Tuberculosis - Notificado
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Brucelosis / Tuberculosis - Notificados</li>
    
    </ol>

  </section>
  
  <section class="content">
   
    <div class="box">
  
      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas tablaNotificados" width="100%">
          
          <thead>
          
          <tr>
            
            <th>Renspa</th>
            <th>Establecimiento</th>
            <th>Propietario</th>
            <th>Campa&ntilde;a</th>
            <th>Fecha Notificado</th>
            
          </tr> 
  
          </thead>      
  
          <tbody>
  
          <?php
  
            $respuesta = ControladorNotificados::ctrMostrarNotificados('brucelosis');
  
            for ($i=0; $i < sizeof($respuesta) ; $i++) { 
              
              echo "            
              <tr>
  
                <td>".$respuesta[$i]['renspa']."</td>
                
                <td>".$respuesta[$i]['establecimiento']."</td>
                
                <td>".$respuesta[$i]['propietario']."</td>
                
                <td>Brucelosis</td>
                
                <td>".formatearFecha($respuesta[$i]['fechaNotificado'])."</td>
                
              </tr>";
  
            }
           
            $respuesta = ControladorNotificados::ctrMostrarNotificados('tuberculosis');
  
            for ($i=0; $i < sizeof($respuesta) ; $i++) { 
              
              echo "            
              <tr>
  
                <td>".$respuesta[$i]['renspa']."</td>
                
                <td>".$respuesta[$i]['establecimiento']."</td>
                
                <td>".$respuesta[$i]['propietario']."</td>
                
                <td>Tuberculosis</td>
                
                <td>".formatearFecha($respuesta[$i]['fechaNotificado'])."</td>
                
              </tr>";
  
            }
          ?>
          
          </tbody>

        </table>


      </div>
  
    </div>
  
  </section>

</div>