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
      
      Recepci&oacute;n de Vacunas

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="recepcion"><i class="fa fa-dashboard"></i>Vacunas</a></li>
      
      <li class="active">Recepci&oacute;n</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <button class="btn btn-primary" id="btnAgregarRecepcion" >
            
            Nuevo Ingreso
            
          </button>
          
        </div>
 
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
            <tr>

                <th>Fecha Ingreso</th>

                <th>U.E.L</th>

                <th>Cantidad</th>

                <th>Marca</th>

                <th>Serie</th>

                <th>Fecha Vencimiento</th>

                <th></th>

            </tr> 

        </thead>

        <tbody id="tablaRecepcion">

        <?php

        $tabla = 'recepcion';

        $item = 'campania';
        
        $valor = $_COOKIE['campania'];
        
        $orden = 'fechaEntrega';

        $recepciones = ControladorAftosa::ctrMostrarDatos($tabla, $item, $valor,$orden);

          foreach ($recepciones as $key => $value) {

              echo '<tr>

                    <td>'.formatearFecha($value["fechaEntrega"]).'</td>

                    <td>'.$uel.'</td>

                    <td>'.$value["cantidad"].'</td>

                    <td>'.utf8_decode($value["marca"]).'</td>

                    <td>'.$value["serie"].'</td>

                    <td>'.formatearFecha($value["fechaVencimiento"]).'</td>

                    <td>

                        <div class="btn-group">

                            <button class="btn btn-danger btnEliminarRecepcion" id="'.$value["recepcion_id"].'"><i class="fa fa-times"></i></button>
                        
                        </div>  

                    </td>

                  </tr>';
          
          }

        ?>
   
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php

$eliminarRecepcion = new ControladorAftosa();
$eliminarRecepcion -> ctrEliminarRecepcion();

?>


