<?php

class ControladorNotificados{

	/*=============================================
	MOSTRAR NOTIFICADOS
	=============================================*/

	static public function ctrMostrarNotificados($campania){

		$tabla = "productores";

		$respuesta = ModeloNotificados::mdlMostrarNotificados($tabla,$campania);

		return $respuesta;

	}



}

