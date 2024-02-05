<div id="modalCarga" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" id="formCarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="tituloCarga">Cargar Datos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group" id="inputCampania">
              
              <div class="panel">Campaña</div>

              <input type="number" id="campania" name="campania">

            </div>

             <div class="form-group">
              
              <div class="panel">Seleccionar Archivo</div>

              <input type="file" id="nuevosDatosCarga" name="nuevosDatosCarga">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="btnCargarData" name="btnCargarData" data-carga="">Cargar Data</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php

$cargarArchivo = new ControladorAftosa();


$cargarArchivo->ctrCargarArchivo();


?>

