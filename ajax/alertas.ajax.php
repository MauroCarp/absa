<?php

require_once "../controladores/brutur.controlador.php";
require_once "../modelos/brutur.modelo.php";

function formatearFecha($fecha){

    $fechaExplode = explode('-',$fecha);

    $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];

    return $fechaFormateada;
}


$today = $_POST['date'];

$tabla1 = 'brucelosis';


$establecimientosVencidos = ControladorBruTur::ctrEsVencido($tabla1,$today,$explotacion);

for ($i=0; $i < sizeof($establecimientosVencidos) ; $i++) { 
    
    $fechaVencimiento = ($explotacion == 'Cria') ? date("Y-m-d",strtotime($establecimientosVencidos[$i]['fechaLibre']."+ 2 year")) : date("Y-m-d",strtotime($establecimientosVencidos[$i]['fechaLibre']."+ 1 year"));
    
    echo "
    <tr class='callout callout-danger'>
        
    <td>".$establecimientosVencidos[$i]['renspa']."</td>
        
        <td>".$establecimientosVencidos[$i]['establecimiento']."</td>
        
        <td>".$establecimientosVencidos[$i]['propietario']."</td>
        
        <td>".$establecimientosVencidos[$i]['veterinario']."</td>
        
        <td>".ucfirst($tabla1)."</td>
        
        <td>".utf8_decode($establecimientosVencidos[$i]['estado'])."</td>
        
        <td>".utf8_decode($establecimientosVencidos[$i]['explotacion'])."</td>
        
        <td>".formatearFecha($fechaVencimiento)."</td>
        
        <td>

            <div class='btn-group'>
            
                <button class='btn btn-warning btnNotificar' renspa='".$establecimientosVencidos[$i]['renspa']."'><i class='fa fa-pencil'></i></button>
            
            </div>
        
        </td>

    </tr>
    
    ";
    
}  



