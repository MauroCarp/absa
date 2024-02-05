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
       
        Cronograma por Veterinario
        
    </h1>

    <ol class="breadcrumb">
      
    <li><a href="informes"><i class="fa fa-dashboard"></i>Informes</a></li>
      
      <li class="active">Cronograma por Veterinario</li>
      
    </ol>
    <?php 

        $item = 'matricula';

        $matricula = $_GET['matricula'];
        
        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios($item,$matricula);

    ?>

    <div class="row">

      <div class="col-lg-6">
        
        <h3>
            
            Vacunador:<b> <?php echo $veterinario['nombre'];?></b>
        
        </h3>

      </div>

      <div class="col-lg-6">

        <div class="box-header with-border">
    
          <div class="box-tools pull-right">
            
            <a href="extensiones/fpdf/informesPdf.php?informe=informe15&matricula=<?php echo $matricula;?>" target="_blank">
            
              <button class="btn btn-success" style="margin-top:5px"><b>Imprimir Cronograma</b></button>
    
            </a>
    
            
            <button class="btn btn-success enviarMail" style="margin-top:5px" informe="15" matricula="<?php echo $matricula;?>"><b>Enviar por E-mail</b></button>
    
    
          </div>
            
        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas tablaCronogramaActual" width="100%">
            
            <thead>
            
                <tr>

                <th>Fecha de Vacunaci&oacute;n</th>
                
                <th>Renspa</th>
                
                <th>Nombre/Apellido</th>
                
                <th>Parcial</th>
                
                <th>Total</th>
                
                <th>Fecha Vencimiento</th>


                </tr> 

            </thead>

            <tbody>

              <?php
              
              // BUSCAR PRODUCTORES ASOCIADOS A MATRICULA

              $item = 'veterinario';

              $productoresSegunVet = ControladorProductores::ctrMostrarProductores($item,$matricula);

              foreach ($productoresSegunVet as $key => $productor) {
                
                $item = 'renspa';

                $actasAnimales = ControladorActas::ctrMostrarActasAnimales($item,$productor['renspa']);

                if(!empty($actasAnimales)){
                  
                  $parcial = $actasAnimales['terneros'] + $actasAnimales['terneras'] + $actasAnimales['novillos'] + $actasAnimales['novillitos'] + $actasAnimales['toritos'] + $actasAnimales['vaquillonas'];

                  $totalAnimales = $parcial + $actasAnimales['vacas'] + $actasAnimales['toros'];

                  echo "<tr>
                              <td>".formatearFecha($actasAnimales['fechaVacunacion'])."</td>
                              <td>".$productor['renspa']."</td>
                              <td>".$productor['propietario']."</td>
                              <td>".$parcial."</td>
                              <td>".$totalAnimales."</td>
                              <td>".date("d/m/Y",strtotime($actasAnimales['fechaVacunacion']."+ 180 days"))."</td>
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

<?php

?>


