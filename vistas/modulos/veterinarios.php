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
      
      Vacunadores

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Vacunadores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVeterinario">
            
            Nuevo Vacunador
            
          </button>
          
        </div>
        
        <div class="box-tools pull-right">
          
          <a href="vistas/modulos/excelVeterinarios.php">
          
            <button class="btn btn-success" style="margin-top:5px">Descargar Nomina en Excel</button>
        
          </a>

        </div>
 
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
            <tr>

            <th style="width:10px">#</th>

            <th>Nombre</th>

            <th>Matricula</th>

            <th>Domicilio</th>

            <th>Telefono</th>

            <th>E-Mail</th>

            <th>Tipo</th>

            <th>Acciones</th>

            </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $veterinarios = ControladorVeterinarios::ctrMostrarVeterinarios($item, $valor);

          foreach ($veterinarios as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["matricula"].'</td>

                    <td>'.$value["domicilio"].'</td>

                    <td>'.$value["telefono"].'</td>

                    <td>'.$value["email"].'</td>

                    <td>'.$value["tipo"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarVeterinario" data-toggle="modal" data-target="#modalEditarVeterinario" idVeterinario="'.$value["vacunador_id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarVeterinario" idVeterinario="'.$value["vacunador_id"].'"><i class="fa fa-times"></i></button>';

                      }

                      echo '</div>  

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

include 'modales/veterinarios/agregarVeterinario.php';

include 'modales/veterinarios/editarVeterinario.php';

$eliminarVeterinario = new ControladorVeterinarios();
$eliminarVeterinario -> ctrEliminarVeterinario();

?>


