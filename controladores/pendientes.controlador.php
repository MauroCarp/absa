<?php

class ControladorPendientes{

	/*=============================================
	MOSTRAR DATOS PENDIENTES BRUCELOSIS Y TUBERCULOSIS
	=============================================*/

    static public function ctrMostrarPendientes($tabla){
		
		$item = 'estadoSenasa';

		$valor = 'Pendiente';

		$respuesta = ModeloBruTur::mdlMostrarPendientes($tabla,$item,$valor);

		return $respuesta;

    }
	

	/*=============================================
	ENVIAR PENDIENTES BRUCELOSIS Y TUBERCULOSIS
	=============================================*/

    static public function ctrEnviarPendientes($item, $valor, $valor2){
		
		$tabla = 'brucelosis';

		$respuesta = ModeloBruTur::mdlEnviarPendientes($tabla,$item,$valor,$valor2);
		
		$tabla = 'tuberculosis';
		
		$respuesta = ModeloBruTur::mdlEnviarPendientes($tabla,$item,$valor,$valor2);

		return $respuesta;

    }


}

