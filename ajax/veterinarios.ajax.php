<?php

require_once "../controladores/veterinarios.controlador.php";
require_once "../modelos/veterinarios.modelo.php";

class AjaxVeterinarios{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idVeterinario;

	public $matriculaVeterinario;

	public function ajaxEditarVeterinario(){

		$item = "vacunador_id";
		$valor = $this->idVeterinario;

		$respuesta = ControladorVeterinarios::ctrMostrarVeterinarios($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxMostrarVeterinario(){

		$item = 'matricula';
		$valor = $this->matriculaVeterinario;

		$respuesta = ControladorVeterinarios::ctrMostrarVeterinarios($item, $valor);

		echo json_encode($respuesta);


	}

	public function ajaxMostrarVeterinarios(){

		$item = null;
		$valor = null;

		$respuesta = ControladorVeterinarios::ctrMostrarVeterinarios($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR VETERINARIO
=============================================*/	

if(isset($_POST["idVeterinario"])){

	$veterinario = new AjaxVeterinarios();
	$veterinario -> idVeterinario = $_POST["idVeterinario"];
	$veterinario -> ajaxEditarVeterinario();

}


/*=============================================
MOSTRAR VETERINARIO
=============================================*/	

if(isset($_POST['accion'])){
	
	$accion = $_POST['accion'];

	if ($accion == 'mostrarVeterinario') {

		$mostrarVeterinario = new AjaxVeterinarios();
		$mostrarVeterinario -> matriculaVeterinario = $_POST["matricula"];
		$mostrarVeterinario -> ajaxMostrarVeterinario();

	}
	
	if ($accion == 'listarVeterinarios') {

		$mostrarVeterinario = new AjaxVeterinarios();
		$mostrarVeterinario -> ajaxMostrarVeterinarios();

	}
	

}