<?php

class ControladorAnimales{
    

    /*=============================================
    MOSTRAR ANIMALES
	=============================================*/

	static public function ctrMostrarAnimales($item,$valor,$item2,$valor2){
    
        $tabla = "animales";

        $respuesta = ModeloAnimales::mdlMostrarAnimales($tabla, $item, $valor,$item2,$valor2);

		return $respuesta;
    
    }

    /*=============================================
    MOSTRAR ANIMALES SEGUN CAMPO PRODUCTOR
	=============================================*/

	static public function ctrMostrarAnimalesCampo($campo,$item,$valor,$item2,$valor2){
    
        $tabla = "animales";

        $tabla2 = 'productores';

        $respuesta = ModeloAnimales::mdlMostrarAnimalesCampo($tabla,$tabla2,$campo,$item,$valor,$item2,$valor2);

		return $respuesta;
    
    }

    /*=============================================
    ACTUALIZAR EXISTENCIA
	=============================================*/

	static public function ctrCargarExistencia($datos){
    
        $tabla = "animales";

        $datos['campania'] = $_COOKIE['campania'];

        $respuesta = ModeloAnimales::mdlCargarExistencia($tabla, $datos);

		return $respuesta;
    
    }
    
    /*=============================================
    ACTUALIZAR EXISTENCIA
	=============================================*/

	static public function ctrActualizarExistencia($datos){
    
        $tabla = "animales";

        $respuesta = ModeloAnimales::mdlActualizarExistencia($tabla, $datos);

		return $respuesta;
    
    }
    
    /*=============================================
    SUMAR ANIMALES INNER JOIN PRODUCTOR
	=============================================*/

	static public function ctrSumarAnimalesInnerProductor($item,$valor,$item2,$valor2,$campo){
    
        $tabla = "animales";

        $tabla2 = 'productores';

        return $respuesta = ModeloAnimales::mdlSumarAnimalesInnerProductor($tabla,$tabla2,$item,$valor,$item2,$valor2,$campo);
    
    }

    /*=============================================
    CONTAR PRODUCTORES SEGUN ANIMALES
	=============================================*/

	static public function ctrContarProductorSegunAnimales($item,$valor,$item2,$valor2){
    
        $tabla = "animales";

        return $respuesta = ModeloAnimales::mdlContarProductorSegunAnimales($tabla,$item,$valor,$item2,$valor2);
    
    }




}

