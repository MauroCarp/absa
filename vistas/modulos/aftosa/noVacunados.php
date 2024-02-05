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
      
      Establecimientos NO vacunados

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="estNoVacunados"><li class="active">Establecimientos no vacunados</li></a></li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas tablaNoVacunados" width="100%">
            
            <thead>
            
                <tr>

                    <th>Propietario</th>

                    <th>R.E.N.S.P.A</th>

                    <th>Establecimiento</th>

                    <th>Departamento</th>

                    <th>Distrito</th>

                    <th>Explotacion</th>

                </tr> 

            </thead>

            <tbody>

            <?php
            
            $item =  'campania';
		
            $valor = $_COOKIE['campania'];
            
            $orden = 'propietario';
        
            $noVacunados = ControladorProductores::ctrMostrarEstNoVac($item, $valor,$orden);

            for ($i=0; $i < sizeof($noVacunados) ; $i++) { 
              
              $departamento = ControladorProductores::ctrMostrarLocation('departamento',$noVacunados[$i]["departamento"],null,null);
              
              $distrito =  ($noVacunados[$i]["distrito"]) ? ControladorProductores::ctrMostrarLocation('departamento',$noVacunados[$i]["departamento"],'localidad',$noVacunados[$i]["distrito"]) : array('nombreDpto'=>'-','nombre'=>'-');
              
              echo "<tr>
                <td>".$noVacunados[$i]["propietario"]."</td>
                <td>".$noVacunados[$i]["renspa"]."</td>
                <td>".$noVacunados[$i]["establecimiento"]."</td>
                <td>".$departamento['nombreDpto']."</td>
                <td>".$distrito['nombre']."</td>
                <td>".$noVacunados[$i]["explotacion"]."</td>
              </tr>";


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


