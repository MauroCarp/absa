var tipo = ['Veterinario','Idóneo'];

/*=============================================
EDITAR VETERINARIO
=============================================*/
$(".tablas").on("click", ".btnEditarVeterinario", function(){

    let idVeterinario = $(this).attr("idVeterinario");
    
    let datos = new FormData();
    
    datos.append("idVeterinario", idVeterinario);
    
    $.ajax({

      url:"ajax/veterinarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
      	$("#idEdit").val(respuesta.vacunador_id);
      	
        $("#nombreEdit").val(respuesta.nombre);
        
        $("#matriculaEdit").val(respuesta.matricula);  
        
        $("#domicilioEdit").val(respuesta.domicilio);
        
        $("#telefonoEdit").val(respuesta.telefono);
        
        $("#emailEdit").val(respuesta.email);
        
        $("#cuitEdit").val(respuesta.cuit);
	    
        $("#tipoEdit").html(generarSelect(tipo,respuesta.tipo,null));
                
	  }

  	});

});

/*=============================================
ELIMINAR VETERINARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarVeterinario", function(){

	var idVeterinario = $(this).attr("idVeterinario");
  
	swal({
        title: '¿Está seguro de borrar el veterinario?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar veterinario!'
      }).then(function(result){
        
        if (result.value) {
          
            window.location = "index.php?ruta=veterinarios&idVeterinario=" + idVeterinario;

        }

      })

})


/*=============================================
MOSTRAR VETERINARIOS
=============================================*/

const mostrarVeterinario = (matricula)=>{

  let data = `accion=mostrarVeterinario&matricula=${matricula}`;

  let url = 'ajax/veterinarios.ajax.php';

  let nombre;
  $.ajax({

    method: 'POST',

    url: url,

    data: data,
    
    success: function(response){
      
      response = JSON.parse(response);

      $('#veterinario').html(response.nombre);      
      
    }

  })

}
