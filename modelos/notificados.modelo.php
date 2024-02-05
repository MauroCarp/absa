<?php

require_once "conexion.php";

class ModeloNotificados{

    /*=============================================
	MOSTRAR PRDUCTORES
	=============================================*/

    static public function mdlMostrarNotificados($tabla,$campania){

        $stmt = Conexion::conectar()->prepare("SELECT $tabla.renspa, $tabla.establecimiento, $tabla.propietario, $campania.fechaNotificado FROM $tabla INNER JOIN $campania ON $tabla.renspa = $campania.renspa WHERE $campania.notificado = 1 ORDER BY $tabla.renspa");
        // var_dump($stmt);
        $stmt -> execute();

        return $stmt -> fetchAll();
        
    }

}