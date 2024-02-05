<?php
require_once "../controladores/actas.controlador.php";
require_once "../modelos/actas.modelo.php";


class AjaxActas{
	
    public $renspa;
    
    public $campania;

    public $inter;

    public function ajaxValidarActa(){

        $renspa = $this->renspa;

        $campania = $this->campania;

        $inter = $this->inter;

        $item = 'renspa';
        $item2 = 'campania';
        $item3 = 'intercampania';
		$respuesta = ControladorActas::ctrValidarActa($item,$renspa,$item2,$campania,$item3,$inter);

        echo json_encode($respuesta);
      
    }

}




if(isset($_POST["accion"])){
    
    $accion = $_POST["accion"];

	if($accion == 'validarActa'){

		$validarActa = new AjaxActas();
        $validarActa-> campania = $_POST['campania'];
        $validarActa-> renspa = $_POST['renspa'];
        $validarActa-> inter = $_POST['intercampania'];
		$validarActa -> ajaxValidarActa();

    }

}