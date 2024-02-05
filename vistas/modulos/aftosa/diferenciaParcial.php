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
      
    Busqueda de Diferencias

    </h1>

    <ol class="breadcrumb">
      
        <li><i class="fa fa-dashboard"></i>Consultas</a></li>
        
        <li class="active">Busqueda de Diferencias</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas tablaDiferencias" width="100%">
            
            <thead>
            
                <tr>
                    
                    <th>Propietario</th>

                    <th>Renspa</th>
                    
                    <th>Total Rodeo</th>
                    
                    <th>Total Vacunado</th>
                    
                    <th>Diferencia</th>

                    <th></th>

                </tr> 

            </thead>

            <tbody>

            <?php
                        
            $actasAnimales = ControladorActas::ctrMostrarActasAnimales(null,null);

            // var_dump($actasAnimales);
            foreach ($actasAnimales as $key => $acta) {
                
                $total = $acta['vaquillonas'] + $acta['toritos'] + $acta['terneros'] + $acta['terneras'] + $acta['novillos'] +  $acta['novillitos'];
                
                $diferencia = $total - $acta['cantidadPar'];

                if($total != $acta['cantidadPar']){
                    
                    $item = 'renspa';
    
                    $productor = ControladorProductores::ctrMostrarProductores($item,$acta['renspa']);

                    
                    echo "<tr>
                        <td>".$productor["propietario"]."</td>
                        <td>".$acta["renspa"]."</td>
                        <td>".$total."</td>
                        <td>".$acta["cantidadPar"]."</td>
                        <td>".$diferencia."</td>
                        <td>

                            <div class='btn-group'>

                                <button class='btn btn-warning btnModificarActa''  renspa=".$acta['renspa']."><i class='fa fa-pencil'></i></button>
                            
                            </div>
                        
                        </td>
                        
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


