<?php
echo '<div class="wrapper">';

/*=============================================
CABEZOTE
=============================================*/

include "modulos/cabezote.php";

/*=============================================
MENU
=============================================*/

include "modulos/menu.php";

/*=============================================
CONTENIDO
=============================================*/

if(isset($_GET["ruta"])){

  if($_GET["ruta"] == "inicio" ||
     $_GET["ruta"] == "productores" ||
     $_GET["ruta"] == "verProductor" ||
     $_GET["ruta"] == "veterinarios" ||
     $_GET["ruta"] == "brutur/alertas" ||
     $_GET["ruta"] == "brutur/actualizarStatus" ||
     $_GET["ruta"] == "brutur/establecimientosSD" ||
     $_GET["ruta"] == "brutur/informeGeneral" ||
     $_GET["ruta"] == "brutur/statusVeterinario" ||
     $_GET["ruta"] == "brutur/notificados" ||
     $_GET["ruta"] == "brutur/informePendientes" ||
     $_GET["ruta"] == "brutur/enviarPendientes" ||
     $_GET["ruta"] == "aftosa/acta" ||
     $_GET["ruta"] == "aftosa/modificarActa" ||
     $_GET["ruta"] == "aftosa/recepcion" ||
     $_GET["ruta"] == "aftosa/distribucion" ||
     $_GET["ruta"] == "aftosa/noVacunados" ||
     $_GET["ruta"] == "aftosa/actasProductor" ||
     $_GET["ruta"] == "aftosa/diferencia" ||
     $_GET["ruta"] == "aftosa/diferenciaParcial" ||
     $_GET["ruta"] == "aftosa/informes" ||
     $_GET["ruta"] == "aftosa/informes/informe15" ||
     $_GET["ruta"] == "aftosa/informes/informe16" ||
     $_GET["ruta"] == "usuarios" ||
     $_GET["ruta"] == "productos" ||
     $_GET["ruta"] == "clientes" ||
     $_GET["ruta"] == "ventas" ||
     $_GET["ruta"] == "crear-venta" ||
     $_GET["ruta"] == "editar-venta" ||
     $_GET["ruta"] == "reportes" ||
     $_GET["ruta"] == "cargarAnimales" ||
     $_GET["ruta"] == "salir"){

    include "modulos/".$_GET["ruta"].".php";

  }else{

    include "modulos/404.php";

  }

}else{

  include "modulos/inicio.php";

}

/*=============================================
FOOTER
=============================================*/

include "modulos/footer.php";

echo '</div>';

?>