<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$departamento = 'BELGRANO';

$distritos = array('BELGRANO','ARMSTRONG','BOUQUET','ITURRASPE','LA CALIFORNIA','LAS PAREJAS','LAS ROSAS','MONTES DE OCA','TORTUGAS','TORTUGAS AG ACA');

$preRenspa = '20.001.0.';

$uel = "A.B.S.A";

$logo = 'absa';

// INFORMES

$informes = array();
$informes[] = 'Animales Totales vacunados por vacunador';
$informes[] = 'Total de Bovinos Vacunados por localidad y total departamental';
$informes[] = 'Detalle Animales Vacunados por Vacunador';
$informes[] = 'Entrega de vacunas por vacunador';
$informes[] = 'Relacion Dosis entregada y Vacuna suministrada';
$informes[] = 'Cant. de Establecimientos por distrito con detalle de categor&iacute;as';
$informes[] = 'Nomina de Vacunadores ordenada alfabeticamente';
$informes[] = 'Otras Especies';
$informes[] = 'Evoluci&oacute;n semanal de la campa&ntilde;a';
$informes[] = 'Informe de Montos';
$informes[] = 'Informe Carbunclo y Brucelosis Vacunados';
$informes[] = 'Informe Carbunclo y Brucelosis NO Vacunados';
$informes[] = 'Cantidad de Establecimientos segun Sistema Productivo';
$informes[] = 'Cantidad de Animales segun Sistema Productivo';
$informes[] = 'Cronograma por Veterinario';
$informes[] = 'Cronograma Actual por Veterinario';
$informes[] = 'Exportar Base de Datos';


function formatearFecha($fecha){

  $fechaExplode = explode('-',$fecha);

  $fechaFormateada = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];

  return $fechaFormateada;

}

function distrito($departamento,$distrito,$conexion){

  $item = 'departamento';

  $item2 = 'localidad';

  $distrito = ControladorProductores::ctrMostrarDatos($item,$departamento,$item2,$distrito);

	$nombre = $fila['nombre'];

	return $distrito;

}


function encrypt_decrypt($action, $string){

  $output = false;

  $encrypt_method = "AES-256-CBC";

  $secret_key = 'WS-SERVICE-KEY';

  $secret_iv = 'WS-SERVICE-VALUE';
  // hash
  $key = hash('sha256', $secret_key);
  // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning

  $iv = substr(hash('sha256', $secret_iv), 0, 16);

  if ($action == 'encrypt') {

      $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));

  } else {

      if ($action == 'decrypt') {

          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);

      }

  }

  return $output;

}

?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Gestión Sanidad Animal</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- ESTILOS PROPIOS -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Icomoon -->
  <link rel="stylesheet" href="vistas/bower_components/icomoon/css/icomoon.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">


  <!-- ESTILOS PROPIOS -->
  <link rel="stylesheet" href="vistas/dist/css/styles.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>




</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-mini login-page">
 
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    include "cuerpo.php";


  }else if( isset($_COOKIE['rememberme']  )){
    
    $userid = encrypt_decrypt('decrypt',$_COOKIE['rememberme']);
            
    $item = 'id';
    
    $count = ControladorUsuarios::ctrContarUsuarios($item,$userid);

    if( $count > 0 ){

      $user = ControladorUsuarios::ctrMostrarUsuarios($item,$userid);

        $_SESSION['id'] = $userid; 
        $_SESSION["iniciarSesion"] = "ok";
        $_SESSION["nombre"] = $user["nombre"];
        $_SESSION["usuario"] = $user["usuario"];
        $_SESSION["foto"] = $user["foto"];
        $_SESSION["perfil"] = $user["perfil"];
       
        include "cuerpo.php";

    }

 }else{

    include "modulos/login.php";

  }

  ?>


<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/productores.js"></script>
<script src="vistas/js/veterinarios.js"></script>
<script src="vistas/js/brutur.js"></script>
<script src="vistas/js/actualizarStatus.js"></script>
<script src="vistas/js/pendientes.js"></script>
<script src="vistas/js/aftosa.js"></script>
<script src="vistas/js/actas.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/informes.js"></script>

</body>
</html>
