/*=============================================
EXISTE ELEMENTO
=============================================*/
const  isInPage = node=>{

	return (node === document.body) ? false : document.body.contains(node);

}

/*=============================================
GET COOKIE
=============================================*/

const getCookie = cname=>{
	
	let name = cname + "=";
	
	let decodedCookie = decodeURIComponent(document.cookie);
	
	let ca = decodedCookie.split(';');
	
	for(let i = 0; i <ca.length; i++) {
	  let c = ca[i];
	  while (c.charAt(0) == ' ') {
		c = c.substring(1);
	  }
	
	  if (c.indexOf(name) == 0) {
		return c.substring(name.length, c.length);
	  }
	
	}
	
	return null;
  
}

/*=============================================
PRIMER LETRA MAYUSCULAS
=============================================*/

const capitalizarPrimeraLetra = (str)=>{

	return str.charAt(0).toUpperCase() + str.slice(1);

}

/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"ordering":"false",
		// "oAria": {
		// 	"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		// 	"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		// }

	}

});

/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

/*=============================================
 //input Mask
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/

if(window.matchMedia("(max-width:767px)").matches){
	
	$("body").removeClass('sidebar-collapse');

}

/*=============================================
MENU ENLACE DIRECTOS A ARCHIVOS EN CARPETAS	
=============================================*/

const redireccionarMenu = (seccion)=>{

	window.location =  `index.php?ruta=${seccion}`;

}

const btnAlertas = document.getElementById('alertas');
btnAlertas.addEventListener("click",()=>{redireccionarMenu('brutur/alertas')});

const btnStatusVeterinario = document.getElementById('statusVeterinario');
btnStatusVeterinario.addEventListener("click",()=>{
	window.open(`extensiones/fpdf/generarPdf.php?accion=statusVeterinario`, '_blank');
});

const btnNotificados = document.getElementById('notificados');
btnNotificados.addEventListener("click",()=>{redireccionarMenu('brutur/notificados')});

const getQueryVariable = variable => {

	var query = window.location.search.substring(1);
  
	var vars = query.split("&");
  
	for (var i=0; i < vars.length; i++) {
  
		var pair = vars[i].split("=");
  
		if(pair[0] == variable) {
  
			return pair[1];
  
		}
  
	}
  
	return false;
  
}

const sumarFecha = (fecha,dato,cantidad) =>{

	fecha = fecha.split('-');

	let año = fecha[0];

	let mes = fecha[1];

	let dia = fecha[2];

	let nuevaFecha;

	if(dato == 'mes')	
		nuevaFecha = `${año}-${parseFloat(mes) + parseFloat(cantidad)}-${dia}`;
		
	if(dato == 'año')
		nuevaFecha = `${parseFloat(año) + parseFloat(cantidad)}-${mes}-${dia}`;

	return nuevaFecha;

}

const formatearFecha = fecha =>{

	return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');

}

/*=============================================
RUTA
=============================================*/

const seccionURL = getQueryVariable('ruta');

/*=============================================
ACCESOS DIRECTOS ACTUALIZAR STATUS BRUTUR Y CARGAR/MODIFICAR ACTA AFTOSA
=============================================*/

window.addEventListener("keydown", function (event) {
	
	let functionKey = event.key;
	
	if(functionKey == 'F8'){
		
		$('#ventanaModalModificarStatus').modal('toggle');
	
	}
	
	
	if(functionKey == 'F9'){

		if(getCookie('campania') != null)
			$('#ventanaModalRenspaActa').modal('toggle');
		else	
			$('#ventanaModalCampania').modal('show');

	}
       
},false);

/*=============================================
COMPROBAR CAMPANIA
=============================================*/	

$('#menuAftosa').on('click',()=>{

	let campania = getCookie('campania');

	setTimeout(()=>{

		if(campania == null)
			document.getElementById('desplegableAftosa').style.display = 'none'
	
		},500)
	
	
	validarCampania()
	
});


/*=============================================
ASIGNAR CAMPAÑA
=============================================*/	

$('#asignarCampania').click(()=>{

	let campania = $('#campaniaNum').val();

	document.cookie = `campania=${campania}`
	
	let date = new Date()

	date.setTime(date.getTime()+(30*24*60*60*1000))

	let expires = date.toGMTString()
	
	document.cookie = `campania = ${campania};path=/sanidadAnimal;Expires=${expires}`

	$('#ventanaModalCampania').modal('toggle');

	document.getElementById('campaniaNumeroInfo').innerText = `N° ${getCookie('campania')}`

});

/*=============================================
VALIDAR CAMPAÑA
=============================================*/	

const validarCampania = ()=>{
	
	let campania = getCookie('campania');
	
	if(campania == null)  
	$('#ventanaModalCampania').modal('show');
	
}

/*=============================================
MOSTRAR CAMPAÑA
=============================================*/	

if(getCookie('campania')){

	document.getElementById('campaniaNumeroInfo').innerText = `N° ${getCookie('campania')}`
	
}


/*=============================================
GENERAR SELECT
=============================================*/	

const cargarSelect = (params)=>{

	let url = `ajax/${params.ajax}.ajax.php`

	let formData = new FormData()

	formData.append('accion',params.accion)

	fetch(url,{
		method:'post',
		body:formData
	}).then(resp=>resp.json())
	.then(respuesta=>{
		
		options = document.createDocumentFragment()

		respuesta.map(option=>{		

			let opt = document.createElement('OPTION')
			
			opt.setAttribute('value',option[params.value])
			opt.innerText = option[params.optText]
			if(params.matricula){

				if(params.matricula == option[params.value])
					opt.setAttribute('selected','selected')

			}

			options.append(opt)
			
		})
		
		if(params.idSelect == 'marcaRecepcion'){
		
			let opt = document.createElement('OPTION')
			opt.setAttribute('value','otraMarca')
			opt.innerText = 'Otra'		
			options.append(opt)
		
		}
		
		document.getElementById(params.idSelect).appendChild(options)

	})
	.catch(er => console.log(er))
}

/*=============================================
VALIDAR CAMPO RENSPA
=============================================*/	

const validarRenspa = (renspa,ruta,redirect)=>{

	renspa.trim()

  if(renspa.length == 0 ){
  
      swal({
        type: "error",
        title: "El campo R.E.N.S.P.A no puede estar Vacio",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        })
    
  }else if(renspa.length == 17 ){
   
    productorExistente(renspa, ruta,redirect)

  }else{
    
    swal({
        type: "error",
        title: "R.E.N.S.P.A Incorrecto",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        })
        
  }

}