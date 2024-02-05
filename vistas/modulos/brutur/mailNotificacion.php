<?php
if(isset($_GET['notificar'])){

    include("vistas/modulos/brutur/sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico

}else{
    
    include("sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
  
}
  //Configuracion de variables para enviar el correo*//*
define('MAIL','pruebafissa@gmail.com');

define('PASS','mauro425336');

$mail_username = MAIL;//Correo electronico saliente ejemplo: tucorreo@gmail.com

$mail_userpassword = PASS;//Tu contraseña de gmail

$mail_addAddress = $emailVeterinario;//correo electronico que recibira el mensaje

$template = (isset($_GET['notificar'])) ? "vistas/modulos/brutur/email_template.html" : 'email_template.html';//Ruta de la plantilla HTML para enviar nuestro mensaje

/*Inicio captura de datos enviados por $_POST para enviar el correo */

$mail_setFromEmail= "fundacioniriondosur@gmail.com";

$mail_setFromName= "A.B.S.A";

if ($alerta == "porVencer") {
   
    $txt_message="<br><h1>Tuberculosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta por vencer su condici&oacute;n de LIBRE. Por favor comunicarse con el propietario para dar aviso.";
   
    if ($tabla == "brucelosis")
        $txt_message="<br><h1>Brucelosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta por vencer el DOES. Por favor comunicarse con el propietario para dar aviso.";
      
}

if ($alerta == "vencido") {

    $txt_message="<br><h1>Tuberculosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta VENCIDO en su condici&oacute;n de LIBRE. Por favor comunicarse con el propietario para dar aviso.";
    
    if ($tabla == "brucelosis")
        $txt_message = "<br><h1>Brucelosis</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta VENCIDO el DOES. Por favor comunicarse con el propietario para dar aviso.";
    
} 

$mail_subject="Aviso de Vencimiento";

function alertaTuberculosis($estado,$campania,$nombreVeterinario,$establecimiento,$propietario){


        if ($estado == "En Saneamiento") {
            
            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta en Saneamiento. Dentro de los 90 - 120 d&iacute;as, deber&aacute; realizar un nuevo an&aacute;lisis para estar en condici&oacute;n de libre.";
    
        }
       
        if ($estado == "Libre" OR $estado == "Recertificacion") {
    
            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Libre de ".ucfirst($campania).".";
    
        }
       
        if ($estado == "No Libre") {
    
            $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta Libre de ".ucfirst($campania);
    
        }

        return $txt_message;
    
}

function alertaBrucelosis($estado,$campania,$nombreVeterinario,$establecimiento,$propietario){
     
    if ($estado == "MuVe" || $estado == "DOES Total" || $estado == "DOES Muestreo") {
            
        $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, esta en ".$estado;
    
        }
        
        
        if ($estado == "Tecnica PAL") {
            
        $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, pidio $estado.";
    
        }
        
        if ($estado == "CSM" || $estado == "SAN") {
            
        $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, pidio $estado.";
    
        }
        
        if ($estado == "Control Interno" || $estado == "Remuestreo") {
            
        $txt_message = "<h1>".ucfirst($campania)."</h1>Le comunicamos al veterinario $nombreVeterinario que el establecimiento $establecimiento, de $propietario, se hizo un ".$estado;
    
        }
        
        return $txt_message;

}

if ($alerta == "cambioStatus") {

    $estado = explode(',',$estado); 

    $txt = "La certificaci&oacute;n tiene una validez de 365 d&iacute;as.";
    
    if($campania == 'tuberculosis'){

       $txt_message =  alertaTuberculosis($estado[1],$campania,$nombreVeterinario,$establecimiento,$propietario);
       
    }
    
    if($campania == 'brucelosis'){
        
        $txt_message =  alertaBrucelosis($estado[0],$campania,$nombreVeterinario,$establecimiento,$propietario);
    
    }

    if($campania == 'bruTur'){

        $txt_message = alertaBrucelosis($estado[0],'Brucelosis',$nombreVeterinario,$establecimiento,$propietario);
        $txt_message .= "<hr>";
        $txt_message .= alertaTuberculosis($estado[1],'Tuberculosis',$nombreVeterinario,$establecimiento,$propietario);
        
    }
    
 $mail_subject="Aviso de Actualizacion de Status Sanitario";
    
} 

$notificar = (isset($_GET['notificar']))? true : false;

sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template,$notificar);

?>