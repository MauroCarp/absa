<?php
require_once "../controladores/aftosa.controlador.php";
require_once "../modelos/aftosa.modelo.php";
require_once "../controladores/veterinarios.controlador.php";
require_once "../modelos/veterinarios.modelo.php";


class AjaxInformes{
	
    public $renspa;
    
    public $campania;

    public function ajaxEnviarCronograma(){

        $matricula = $this->matricula;

        $veterinario = ControladorVeterinarios::ctrMostrarVeterinarios('matricula',$matricula);

		$respuesta = ControladorAftosa::ctrEnviarMail($veterinario['nombre'],$veterinario['email']);

        $rutaCronograma = $_SERVER['DOCUMENT_ROOT'].'/sanidadAnimal/vistas/modulos/aftosa/informes/cronograma.pdf';

        unlink($rutaCronograma);	

        echo json_encode($respuesta);
      
    }

}




if(isset($_POST["mail"])){
    
    $enviarCronograma = new AjaxInformes();
    $enviarCronograma-> matricula = $_POST['matricula'];
    $enviarCronograma -> ajaxEnviarCronograma();

}