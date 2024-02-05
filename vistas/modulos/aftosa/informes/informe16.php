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
       
        Cronograma Actual por Vacunador
        
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="informes"><i class="fa fa-dashboard"></i>Informes</a></li>
      
      <li class="active">Cronograma Actual por Vacunador</li>
      
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
            
            <a href="extensiones/fpdf/informesPdf.php?informe=informe16&matricula=<?php echo $matricula;?>" target="_blank">
            
              <button class="btn btn-success" style="margin-top:5px"><b>Imprimir Cronograma</b></button>
    
            </a>
                
            <button class="btn btn-success enviarMail" style="margin-top:5px" informe="16" matricula="<?php echo $matricula;?>"><b>Enviar por E-mail</b></button>
        
          </div>
            
        </div>

      </div>

    </div>

</section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            
            <thead>
            
                <tr>

                  <th>Renspa</th>
                  
                  <th>Nombre/Apellido</th>
                  
                  <th>Parcial</th>
                  
                  <th>Total</th>
                  
                </tr> 

            </thead>

            <tbody>

            <?php

            // MOSTRAR LOS LOS ANIMALES A VACUNAR

            
            $item = 'veterinario';

            $productoresSegunVet = ControladorProductores::ctrMostrarProductores($item,$matricula);

            $item = 'renspa';

            $item2 =  'campania';
    
            $valor2 = $_COOKIE['campania'];
            
            foreach ($productoresSegunVet as $key => $productor) {
                      
              $animalesCronograma = ControladorAnimales::ctrMostrarAnimales($item,$productor['renspa'],$item2,$valor2);

              $parcial = $animalesCronograma['terneros'] + $animalesCronograma['terneras'] + $animalesCronograma['novillos'] + $animalesCronograma['novillitos'] + $animalesCronograma['toritos'] + $animalesCronograma['vaquillonas'];

              $totalAnimales = $parcial + $animalesCronograma['vacas'] + $animalesCronograma['toros'];

                echo "
                <tr>
                <td>".$productor['renspa']."</td>
                <td>".$productor['propietario']."</td>
                <td>".$parcial."</td>
                <td>".$totalAnimales."</td>
                </tr>
                ";

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


