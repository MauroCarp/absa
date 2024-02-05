<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

function nombreDistrito($distritoNumero,$distritos){

  $nombreDistrito = '';

  foreach ($distritos as $key => $value) {
     
    if($distritoNumero == $key)
      $nombreDistrito = $value;

  }

  return $nombreDistrito;
};

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Productores / Establecimientos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Productores / Establecimientos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btnNuevoProductor" data-toggle="modal" data-target="#modalAgregarProductor">
          
          Nuevo Productor/Establecimiento

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
            <tr>

            <th style="width:10px">#</th>

            <th>R.E.N.S.P.A</th>

            <th>Propietario</th>

            <th>Establecimiento</th>

            <th>Tipo Expl.</th>

            <th>Regimen</th>

            <th>Distrito</th>

            <th>Acciones</th>

            </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $productores = ControladorProductores::ctrMostrarProductores($item, $valor);

          foreach ($productores as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["renspa"].'</td>

                    <td>'.utf8_decode($value["propietario"]).'</td>

                    <td>'.$value["establecimiento"].'</td>

                    <td>'.utf8_decode($value["explotacion"]).'</td>

                    <td>'.utf8_decode($value["regimen"]).'</td>

                    <td>'.nombreDistrito($value["distrito"],$distritos).'</td>             

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProductor" data-toggle="modal" data-target="#modalEditarProductor" idProductor="'.$value["productor_id"].'"><i class="fa fa-pencil"></i></button>
                        
                        <button class="btn btn-danger btnEliminarProductor" idProductor="'.$value["productor_id"].'"><i class="fa fa-times"></i></button>
                      
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

include 'modales/productores/agregarProductor.php';

include 'modales/productores/editarProductor.php';

$eliminarProductor = new ControladorProductores();
$eliminarProductor -> ctrEliminarProductor();

?>


