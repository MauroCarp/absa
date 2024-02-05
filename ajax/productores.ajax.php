<?php

require_once "../controladores/productores.controlador.php";
require_once "../modelos/productores.modelo.php";

class AjaxProductores{


	public $idProductor;
	public $renspa;
	public $veterinario;

	public function ajaxEditarProductor(){

		$item = "productor_id";
		$valor = $this->idProductor;

		$respuesta = ControladorProductores::ctrMostrarProductores($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxProductorExistente(){

		$item = "renspa";
		$valor = $this->renspa;

		$respuesta = ControladorProductores::ctrMostrarProductores($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxAsignarVeterinario(){

		$item = "veterinario";
		$valor = $this->veterinario;
		$item2 = "renspa";
		$valor2 = $this->renspa;
		
		$respuesta = ControladorProductores::ctrEditarParametro($item,$valor,$item2,$valor2);
		
		echo $respuesta;


	}

}

/*=============================================
PRODUCTOR EXISTENTE
=============================================*/	

if(isset($_POST["renspa"]) && !isset($_POST['accion'])){

	$productorExistente = new AjaxProductores();
	$productorExistente -> renspa = $_POST["renspa"];
	$productorExistente -> ajaxProductorExistente();

}

/*=============================================
EDITAR PRODUCTOR
=============================================*/	

if(isset($_POST["idProductor"])){

	$productor = new AjaxProductores();
	$productor -> idProductor = $_POST["idProductor"];
	$productor -> ajaxEditarProductor();

}

/*=============================================
EDITAR PRODUCTOR
=============================================*/	
if(isset($_POST["accion"])){

	if($_POST['accion'] == 'asignarVet'){
	
		$productor = new AjaxProductores();
		$productor -> renspa = $_POST["renspa"];
		$productor -> veterinario = $_POST["matricula"];
		$productor -> ajaxAsignarVeterinario();
	}
}