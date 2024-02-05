<?php

include '../../../controladores/brutur.controlador.php';
include '../../../modelos/brutur.modelo.php';

include '../../../controladores/productores.controlador.php';
include '../../../modelos/productores.modelo.php';

include '../../../controladores/veterinarios.controlador.php';
include '../../../modelos/veterinarios.modelo.php';

$enviarMail = new ControladorBruTur();

$enviarMail -> ctrNotificar()

?>