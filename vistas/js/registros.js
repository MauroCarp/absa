
/*=============================================
NOTIFICAR VACUNADOR
=============================================*/

$(".tablas").on("click", ".btnEliminarRegistro", function(){
    
	let idRegistro = $(this).attr("idRegistro");

	swal({
        title: '¿Eliminar Registro?',
        text: "¡Si no puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar registro!'
      }).then(function(result){
        if (result.value) {
          
            window.location = `index.php?ruta=brutur/actualizarStatus&idRegistro=${idRegistro}`;
            
        }

  })

})