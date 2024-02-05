<?php

include 'modelos/conexion.php';
// CARGA A BRUCE

$tabla = 'brucelosis';

$stmt = Conexion::conectar()->prepare("SELECT renspa FROM $tabla");

$stmt->execute();

$brucelosis = $stmt->fetchAll();

$tabla = 'tuberculosis';

$stmt = Conexion::conectar()->prepare("SELECT renspa FROM $tabla");

$stmt->execute();

$tuberculosis = $stmt->fetchAll();


$tabla = 'productores';

$stmt = Conexion::conectar()->prepare("SELECT renspa FROM $tabla");

$stmt->execute();

$productores = $stmt->fetchAll();

$mapear = function($array){

    foreach ($array as $key => $value) {
    
        $renspas[] = $value[0];
    
    }

    return $renspas;

};

$brucelosisRenspas = $mapear($brucelosis);
$tuberculosisRenspas = $mapear($tuberculosis);
$productoresRenspas = $mapear($productores);

$renspasDiferentesBrucelosis = array();
$renspasDiferentesTuberculosis = array();
$renspasDiferentes = array();

foreach ($productoresRenspas as $key => $value) {
    
        
        if(!in_array($value,$brucelosisRenspas)){
            
            $renspasDiferentesBrucelosis[] = $value;

        }
        
        if(!in_array($value,$tuberculosisRenspas)){
            
            $renspasDiferentesTuberculosis[] = $value;

        }

}

var_dump(sizeof($renspasDiferentesBrucelosis));
var_dump(sizeof($renspasDiferentesTuberculosis));

foreach ($renspasDiferentesBrucelosis as $key => $value) {

    $tabla = 'brucelosis';

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa) VALUES(:renspa)");

    $stmt->bindParam(":renspa", $value, PDO::PARAM_STR);

    $stmt->execute();

}




?>