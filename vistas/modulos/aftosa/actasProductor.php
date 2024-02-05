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
      
        Actas por Productor

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="recepcion"><i class="fa fa-dashboard"></i>Actas</a></li>
      
      <li class="active">Actas por Productor</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">
                    
          <h3>Propietario: <span id="dataPropietarioActas"></span><h3>
            
        </div>

    </div>

    <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablas" id="actasProductor"  data-ordering="false" width="100%">
        
        <thead>
        
            <tr>

                <th>Fecha Vacunaci&oacute;n</th>

                <th>Fecha Recepci&oacute;n</th>

                <th>Vacunador</th>
                
                <th>Vacunas Suministradas</th>

                <!--<th>Marca Vacuna</th>-->
                
                <th>Acta</th>
                
                <th>Pago</th>
                <th></th>
                
            </tr> 

        </thead>

        <tbody>

        <?php

          $item = 'renspa';

          $valor = $_GET['renspa'];

          $tabla = 'actas';
          
          $orden = 'fechaVacunacion';
          
          $actas = ControladorAftosa::ctrMostrarDatos($tabla,$item,$valor,$orden);
          
          $item = 'matricula';

          foreach ($actas as $key => $value) {

            $vacunador =  ControladorVeterinarios::ctrMostrarVeterinarios($item,$value['matricula']);
            
            if($value['pago'])
              $pago = array('tipo'=>'success','icon'=>'check') ;
            else $pago = array('tipo'=>'danger','icon'=>'times') ;

            $celdaPago = "<span class='btn btn-".$pago['tipo']."'><i class='fa fa-".$pago['icon']."'></i></span>";

            
            echo '<tr>

            <td>'.formatearFecha($value["fechaVacunacion"]).'</td>

            <td>'.formatearFecha($value["fechaRecepcion"]).'</td>

            <td>'.$vacunador['nombre'].'</td>

            <td>'.$value["cantidadPar"].'</td>';

            //<td>'.utf8_decode($value["marcaVacuna"]).'</td>

            echo '<td>'.$value["acta"].'</td>

            <td>

                <div class="btn-group">

                    '.$celdaPago.'

                </div>  

            </td>

            <td>
              <div class="btn-group">
                  
              <button class="btn btn-danger btnEliminarActa" idActa="'.$value["vacunas_id"].'"><i class="fa fa-times"></i></button>';
              
              if($value["intercampania"]){

                  echo '<span class="btn btn-success">Inter</span>';

              }

              echo '</div> 

            </td>
          </tr>';

          }
          ?>

        </tbody>

      </table>

    </div>  

  </section>

</div>

<?php 
$eliminarActa = new ControladorActas();
$eliminarActa -> ctrEliminarActa();
?>