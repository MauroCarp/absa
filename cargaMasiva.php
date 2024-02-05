<?php

include 'modelos/conexion.php';
// CARGA A BRUCE

$tabla = 'brucelosis';

$stmt = Conexion::conectar2()->prepare("SELECT * FROM $tabla");

$stmt->execute();

$resultado = $stmt->fetchAll();

$fechaEstado = null;

foreach ($resultado as $key => $productor) {
    
    $renspa = $productor['renspaBruce'];
    
    switch ($productor['estado']) {
        case 'Libre':
            $fechaEstado = $productor['fechaLibre'];
            break;

        case 'RecertificaciÃ³n':
            $fechaEstado = $productor['fechaLibre'];
            break;
        
        case 'En Saneamiento':
            $fechaEstado = $productor['fechaSaneamiento'];
            break;
    
        case 'S/D':
            $fechaEstado = $productor['fechaSD'];
            break;
        

        case 'Saneado':
            $fechaEstado = $productor['fechaSaneado'];
            break;
        
        default:
            # code...
            break;
    }

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,fechaEstado,estado,protocolo,fechaCarga,numeroCert,saneamientoNumero,positivo,negativo,sospechoso,notificado,fechaNotificado) VALUES(:renspa,:fechaEstado,:estado,:protocolo,:fechaCarga,:numeroCert,:saneamientoNumero,:positivo,:negativo,:sospechoso,:notificado,:fechaNotificado)");


    $stmt->bindParam(":fechaEstado", $fechaEstado, PDO::PARAM_STR);
    $stmt->bindParam(":estado", $productor['estado'], PDO::PARAM_STR);
    $stmt->bindParam(":protocolo", $productor['protocolo'], PDO::PARAM_STR);
    $stmt->bindParam(":fechaCarga", $productor['fechaCarga'], PDO::PARAM_STR);
    $stmt->bindParam(":numeroCert", $productor['numeroCert'], PDO::PARAM_STR);
    $stmt->bindParam(":saneamientoNumero", $productor['saneamientoNumero'], PDO::PARAM_STR);
    $stmt->bindParam(":positivo", $productor['positivo'], PDO::PARAM_STR);
    $stmt->bindParam(":negativo", $productor['negativo'], PDO::PARAM_STR);
    $stmt->bindParam(":sospechoso", $productor['sospechoso'], PDO::PARAM_STR);
    $stmt->bindParam(":notificado", $productor['notificado'], PDO::PARAM_STR);
    $stmt->bindParam(":fechaNotificado", $productor['fechaNotificado'], PDO::PARAM_STR);
    $stmt->bindParam(":renspa", $renspa, PDO::PARAM_STR);

    $stmt->execute();
    
    print_r($stmt->errorInfo());

}

// CARGA A TUBER

$tabla = 'tuberculosis';

$stmt = Conexion::conectar2()->prepare("SELECT * FROM $tabla");

$stmt->execute();

$resultado =  $stmt->fetchAll();

$fechaEstado = null;

foreach ($resultado as $key => $productor) {
    $renspa = $productor['renspaTuber'];
    
    switch ($productor['estado']) {
        
        case 'Libre':
            $fechaEstado = $productor['fechaLibre'];
            break;

        case 'RecertificaciÃ³n':
            $fechaEstado = $productor['fechaLibre'];
            break;
        
        case 'En Saneamiento':
            $fechaEstado = $productor['fechaSaneamiento'];
            break;

        case 'No Libre':
            $fechaEstado = $productor['fechaNoLibre'];
            break;
        
        default:
            # code...
            break;
    }

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,fechaEstado,estado,protocolo,fechaCarga,numeroCert,saneamientoNumero,positivo,negativo,sospechoso,notificado,fechaNotificado) VALUES(:renspa,:fechaEstado,:estado,:protocolo,:fechaCarga,:numeroCert,:saneamientoNumero,:positivo,:negativo,:sospechoso,:notificado,:fechaNotificado)");

    $stmt->bindParam(":fechaEstado", $fechaEstado, PDO::PARAM_STR);
    $stmt->bindParam(":estado", $productor['estado'], PDO::PARAM_STR);
    $stmt->bindParam(":protocolo", $productor['protocolo'], PDO::PARAM_STR);
    $stmt->bindParam(":fechaCarga", $productor['fechaCarga'], PDO::PARAM_STR);
    $stmt->bindParam(":numeroCert", $productor['numeroCert'], PDO::PARAM_STR);
    $stmt->bindParam(":saneamientoNumero", $productor['saneamientoNumero'], PDO::PARAM_STR);
    $stmt->bindParam(":positivo", $productor['positivo'], PDO::PARAM_STR);
    $stmt->bindParam(":negativo", $productor['negativo'], PDO::PARAM_STR);
    $stmt->bindParam(":sospechoso", $productor['sospechoso'], PDO::PARAM_STR);
    $stmt->bindParam(":notificado", $productor['notificado'], PDO::PARAM_STR);
    $stmt->bindParam(":fechaNotificado", $productor['fechaNotificado'], PDO::PARAM_STR);
    $stmt->bindParam(":renspa", $renspa, PDO::PARAM_STR);

    $stmt->execute();

    print_r($stmt->errorInfo());

}


// CARGA ANIMALES
$tabla = 'animales';

$stmt = Conexion::conectar2()->prepare("SELECT * FROM $tabla");

$stmt->execute();

$resultado =  $stmt->fetchAll();


foreach ($resultado as $key => $animales) {
    
    $renspa = $animales['renspa_animales'];
    
    $vacasBruce = $animales['vacasBruce'];
    $vacasTuber = $animales['vacasTuber'];
  
    $ternerosBruce = $animales['ternerosBruce'];
    $ternerosTuber = $animales['ternerosTuber'];
  
    $ternerasBruce = $animales['ternerasBruce'];
    $ternerasTuber = $animales['ternerasTuber'];
  
    $vaquillonasBruce = $animales['vaquillonasBruce'];
    $vaquillonasTuber = $animales['vaquillonasTuber'];
  
    $novillosBruce = $animales['novillosBruce'];
    $novillosTuber = $animales['novillosTuber'];
  
    $novillitosBruce = $animales['novillitosBruce'];
    $novillitosTuber = $animales['novillitosTuber'];
  
    $torosBruce = $animales['torosBruce'];
    $torosTuber = $animales['torosTuber'];
  
    $toritosBruce = $animales['toritosBruce'];
    $toritosTuber = $animales['toritosTuber'];
  
    $tabla = 'brucelosis';

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
    vacas = :vacas,
    vaquillonas = :vaquillonas,
    toros = :toros
    WHERE renspa = :renspa");

    $stmt->bindParam(":vacas", $vacasBruce, PDO::PARAM_STR);
    $stmt->bindParam(":vaquillonas", $vaquillonasBruce, PDO::PARAM_STR);
    $stmt->bindParam(":toros", $torosBruce, PDO::PARAM_STR);
    $stmt->bindParam(":renspa", $renspa, PDO::PARAM_STR);

    $stmt->execute();

    print_r($stmt->errorInfo());

    $tabla = 'tuberculosis';

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
    vacas = :vacas,
    vaquillonas = :vaquillonas,
    terneras = :terneras,
    terneros = :terneros,
    novillos = :novillos,
    novillitos = :novillitos,
    toros = :toros
    WHERE renspa = :renspa");

    $stmt->bindParam(":vacas", $vacasTuber, PDO::PARAM_STR);
    $stmt->bindParam(":vaquillonas", $vaquillonasTuber, PDO::PARAM_STR);
    $stmt->bindParam(":terneras", $ternerasTuber, PDO::PARAM_STR);
    $stmt->bindParam(":terneros", $ternerosTuber, PDO::PARAM_STR);
    $stmt->bindParam(":novillos", $novillosTuber, PDO::PARAM_STR);
    $stmt->bindParam(":novillitos", $novillitosTuber, PDO::PARAM_STR);
    $stmt->bindParam(":toros", $torosTuber, PDO::PARAM_STR);
    $stmt->bindParam(":renspa", $renspa, PDO::PARAM_STR);

    $stmt->execute();

    print_r($stmt->errorInfo());

}

// CARGA REGISTROS
$tabla = 'registros';

$stmt = Conexion::conectar2()->prepare("SELECT * FROM $tabla");

$stmt->execute();

$resultado =  $stmt->fetchAll();


foreach ($resultado as $key => $registro) {
    
    $renspa = $registro['renspa'];
   
    $campania = $registro['campania'];
    $protocolo = $registro['protocolo'];
    $estado = $registro['estado'];
    $fechaEstado = $registro['fechaEstado'];
    $fechaCarga = $registro['fechaCarga'];
    $saneamientoNumero = 0;
    $positivo = ($campania == 'Brucelosis') ? $registro['positivoBruce'] : $registro['positivoTuber'];
    $negativo = ($campania == 'Brucelosis') ? $registro['negativoBruce'] : $registro['negativoTuber'];
    $sospechoso = ($campania == 'Brucelosis') ? $registro['sospechosoBruce'] : $registro['sospechosoTuber'];

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(renspa,campania,protocolo,estado,fechaEstado,fechaCarga,saneamientoNumero,positivo,negativo,sospechoso) VALUES(:renspa,:campania,:protocolo,:estado,:fechaEstado,:fechaCarga,:saneamientoNumero,:positivo,:negativo,:sospechoso)");

    $stmt->bindParam(":renspa", $renspa, PDO::PARAM_STR);
    $stmt->bindParam(":campania", $campania, PDO::PARAM_STR);
    $stmt->bindParam(":protocolo", $protocolo, PDO::PARAM_STR);
    $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
    $stmt->bindParam(":fechaEstado", $fechaEstado, PDO::PARAM_STR);
    $stmt->bindParam(":fechaCarga", $fechaCarga, PDO::PARAM_STR);
    $stmt->bindParam(":saneamientoNumero", $saneamientoNumero, PDO::PARAM_STR);
    $stmt->bindParam(":positivo", $positivo, PDO::PARAM_STR);
    $stmt->bindParam(":negativo", $negativo, PDO::PARAM_STR);
    $stmt->bindParam(":sospechoso", $sospechoso, PDO::PARAM_STR);

    $stmt->execute();

    print_r($stmt->errorInfo());

}



?>