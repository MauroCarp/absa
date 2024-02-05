// const distritos = ['BELGRANO','ARMSTRONG','BOUQUET','ITURRASPE','LA CALIFORNIA','LAS PAREJAS','LAS ROSAS','MONTES DE OCA','TORTUGAS','TORTUGAS AG ACA'];

const distritos = ['BELGRANO','ARMSTRONG','BOUQUET','ITURRASPE','LA CALIFORNIA','LAS PAREJAS','LAS ROSAS','MONTES DE OCA','TORTUGAS','TORTUGAS AG ACA'];

const iva = ['RI','MT','EX','CF'];

const tipoDoc = ['DNI','CUIL','CUIT'];

const tipoExplotacion = ['Cabaña','CIA','Cria','Cria/Invernada','Feedlot','U.P Feedlot'];

const regimen = ['Arrendatario','Capitalizacion','Pastajero','Propietario'];

const utf8 = (texto)=>{
  
  let respuesta;
  
  switch (texto) {
    
    case 'CabaÃ±a':

        respuesta = 'Cabaña';

      break;
      
    case 'CrÃ­a':

      respuesta = 'Cría';
      
    break;
  
    case 'CrÃ­a/Invernada':

      respuesta = 'Crí­a/Invernada';
      
    break;
  
    case 'RecertificaciÃ³n':

      respuesta = 'Recertificación';
      
    break;

    case 'CapitalizaciÃ³n':

      respuesta = 'Capitalización';
      
    break;
  
    default:
      respuesta = texto;
      break;
  }

  return respuesta;
}


/*=============================================
EXISTE PRODUCTOR
=============================================*/

const productorExistente = (renspa,ruta,redirect)=>{

  let url = 'ajax/productores.ajax.php'

  let data = new FormData()
  data.append('renspa',renspa)

  fetch(url,{
    method:'post',
    body:data
  }).then(resp => resp.json())
  .then(respuesta => {

            if(respuesta){
              
              if(redirect)
                window.open(ruta ,'_blank')
                else window.location = ruta
            
              }else{  

                 swal({
                type: "error",
                title: "R.E.N.S.P.A Inexistente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                })

              }
  })

}

/*=============================================
EDITAR PRODCUTOR
=============================================*/
$(".tablas").on("click", ".btnEditarProductor", function(){

	var idProductor = $(this).attr("idProductor");

	var datos = new FormData();
    
  datos.append("idProductor", idProductor);

    $.ajax({

      url:"ajax/productores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	$("#idEdit").val(respuesta["productor_id"]);
      	
        $("#renspaEdit").val(respuesta["renspa"]);
	      
        $("#propietarioEdit").val(respuesta["propietario"]);
	      
        $("#establecimientoEdit").val(respuesta["establecimiento"]);
	      
        $("#tipoExplotacionEdit").html(generarSelect(tipoExplotacion, respuesta["explotacion"],null));
	      
        $("#regimenEdit").html(generarSelect(regimen,respuesta["regimen"],null));
	      
        $("#tipoDocEdit").html(generarSelect(tipoDoc,respuesta["tipoDoc"],null));

        $("#numDocEdit").val(respuesta["numDoc"]);
        
        $("#ivaEdit").html(generarSelect(iva,respuesta["iva"],'iva'));

        $("#telefonoEdit").val(respuesta["telefono"]);

        $("#mailEdit").val(respuesta["email"]);

        $("#domicilioEdit").val(respuesta["domicilio"]);

        respuesta["localidad"] == 'CAÃ‘ADA DE GOMEZ' ? $("#localidadEdit").val('Cañada de Gómez') : $("#localidadEdit").val(respuesta["localidad"]); 

        $("#provinciaEdit").val(respuesta["provincia"]);
       
        switch (respuesta["departamento"]) {
          case 8:
            
            $("#departamentoEdit").val('IRIONDO');
            
            break;
        
          case 1:
            
            $("#departamentoEdit").val('BELGRANO');

            break;
        
          default:
            break;
        }
       
        $("#distritoEdit").html(generarSelect(distritos,respuesta["distrito"],'distritos'));
        
        
        $.ajax({
          url:'ajax/veterinarios.ajax.php',
          data:'accion=listarVeterinarios',
          method: 'post',
          success:(response)=>{

            let veterinarios = JSON.parse(response);
            
            $("#veterinarioEdit").html(generarSelect(veterinarios,respuesta.veterinario,'veterinarios'));

          }

        })
        
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarProductor", function(){

	var idProductor = $(this).attr("idProductor");
  
	swal({
        title: '¿Está seguro de borrar el productor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar productor!'
      }).then(function(result){
        
        if (result.value) {
          
            window.location = "index.php?ruta=productores&idProductor=" + idProductor;

        }

      })

})

/*=============================================
GENERAR SELECTS
=============================================*/

const generarSelect = (array,valueBD,tipo)=>{
  
  let select = '';
  
  array.forEach((value,key)=>{
    if(tipo != null){
    
      if (tipo == 'distritos') {
        
        select += `<option value="${key}"`
        
        if(valueBD == key)
          select += ' selected'
        
        select += `>${utf8(value)}</option>`

      }
      
      if(tipo == 'iva'){
        
        select += `<option value="${value}" `

        if(valueBD == value)
        select += ' selected';

        switch (value) {
          case 'RI':
              select += '>Responsable Inscripto</option>';
            break;
        
          case 'MT':
              select += '>Responsable Monotributo</option>';
            break;
        
          case 'EX':
              select += '>Exento</option>';
            break;
        
          case 'CF':
              select += '>Consumidor Final</option>';
            break;
        
          default:
            break;
        }
        
      }

      if(tipo == 'veterinarios'){

        select += `<option value="${value.matricula}" `

        if(valueBD == value.matricula)
          select += ' selected';
        
        select += `>${utf8(value.nombre)}</option>`;
              
      }
    
    }else{
        
      select += `<option value="${utf8(value)}"`
      
      if(valueBD == value)
        select += ' selected'
      
        select += `>${utf8(value)}</option>`

    }
    
  });
  
  return select;

}

// CARGAR VETERINARIOS NUEVO PRODUCTOR

$('#btnNuevoProductor').on('click',()=>{

  $.ajax({
    url:'ajax/veterinarios.ajax.php',
    data:'accion=listarVeterinarios',
    method: 'post',
    success:(response)=>{

      let veterinarios = JSON.parse(response);
      
      let selectVeterinarios = generarSelect(veterinarios,null,'veterinarios')
      
      $("#veterinario").html(selectVeterinarios);

    }

  })
  
});

/*=============================================
SITUACION PRODUCTOR
=============================================*/

const btnSituacionProductor = document.getElementById('btnBuscarSituacionProductor')

btnSituacionProductor.addEventListener('click',(e)=>{

  e.preventDefault()

  let renspa = document.getElementById('renspaSituacionProductor').value

  let ruta = `extensiones/fpdf/generarPdf.php?renspa=${renspa}&accion=situacionProductor`

  validarRenspa(renspa,ruta,true)  
  
})