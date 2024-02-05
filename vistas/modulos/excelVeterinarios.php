<?php

include '../../controladores/veterinarios.controlador.php';
include '../../modelos/veterinarios.modelo.php';


$descargarExcel = new ControladorVeterinarios();
$descargarExcel -> ctrGenerarExcelVeterinarios();


?>