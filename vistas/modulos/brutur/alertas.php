<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}



$today = date('Y-m-d');

function generarAlerta($registros,$tipoAlerta,$today,$tabla1){
  
  $alertaColor = ($tipoAlerta == 'vencido') ? 'danger' : 'warning';

  for ($i=0; $i < sizeof($registros) ; $i++) { 

    $fechaMesPrevio = date("Y-m-d",strtotime($registros[$i]['fechaVencido']."- 1 month"));

      echo "
        <tr class='callout callout-$alertaColor'>
            
          <td>".$registros[$i]['renspa']."</td>
            
            <td>".$registros[$i]['establecimiento']."</td>
            
            <td>".$registros[$i]['propietario']."</td>
            
            <td>".$registros[$i]['veterinario']."</td>
            
            <td>".ucfirst($tabla1)."</td>
            
            <td>".utf8_decode($registros[$i]['estado'])."</td>
            
            <td>".utf8_decode($registros[$i]['explotacion'])."</td>
            
            <td>".formatearFecha($registros[$i]['fechaVencido'])."</td>
            
            <td>

                <div class='btn-group'>
                
                    <button class='btn btn-warning btnNotificar' renspa='".$registros[$i]['renspa']."' campania='".$tabla1."' alerta='".$tipoAlerta."' estado='".$registros[$i]['estado']."'><i class='fa fa-bell-o'></i></button>
                
                </div>
            
            </td>

        </tr>";

  }

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Brucelosis / Tuberculosis
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Brucelosis / Tuberculosis - Alertas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      
      <div class="box-header with-border">
      
        <h3 class="box-title"><i class="fa fa-bullhorn"></i> Tablero de Alertas</h3>

      </div>
      
      <div class="box-body">

        <table class="table tablas">
          
          <thead>
            
            <th>Renspa</th>
            
            <th>Establecimiento</th>
            
            <th>Propietario</th>
            
            <th>Veterinario</th>
            
            <th>Campaña</th>
            
            <th>Estado</th>
            
            <th>Explotaci&oacute;n</th>
            
            <th>Fecha Vencimiento</th>
            
            <th>Notificar</th>
            
          </thead>
        
          <tbody id="tableAlertas">

          <?php

            // BRUCELOSIS VENCIDOS

              $tabla1 = 'brucelosis';

              $establecimientosVencidosBrucelosis = ControladorBruTur::ctrEsVencido($tabla1,$today);

                generarAlerta($establecimientosVencidosBrucelosis,'vencido',$today,$tabla1);

              // BRUCELOSIS POR VENCER

              $establecimientosPorVencerBrucelosis = ControladorBruTur::ctrPorVencer($tabla1,$today);

              generarAlerta($establecimientosPorVencerBrucelosis,'porVencer',$today,$tabla1);
              
              // // TUBERCULOSIS VENCIDOS
              
              $tabla1 = 'tuberculosis';
                            
              $establecimientosVencidosTuberculosis = ControladorBruTur::ctrEsVencido($tabla1,$today);
              
              generarAlerta($establecimientosVencidosTuberculosis,'vencido',$today,$tabla1);
              
              // TUBERCULOSIS POR VENCER
                            
              $establecimientosPorVencerTuberculosis = ControladorBruTur::ctrPorVencer($tabla1,$today);

              generarAlerta($establecimientosPorVencerTuberculosis,'porVencer',$today,$tabla1);
           

        ?>

          </tbody>

        </table>
      
      </div>
    
    </div>

  </section>

</div>
<?php

$notificarProductor = new ControladorBruTur();
$notificarProductor -> ctrNotificar();

?>  
