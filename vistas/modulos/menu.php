<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home" style="font-size:1.2em;"></i>
					<span>Inicio</span>

				</a>

			</li>
			
			<li>

				<a href="productores">

					<i class="icon-tractor" style="font-size:1.2em;padding-right:5px;"></i>
					<span>Productores</span>

				</a>

			</li>

			<li>

				<a href="veterinarios">

					<i class="icon-jeringa" style="font-size:1.8em;"></i>
					<span>Vacundarores</span>

				</a>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="icon-brutur" style="font-size:2.5em;padding-right:5px;"></i>
					
					<span>BruTur</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="#" id="alertas">
							
							<i class="fa fa-exclamation-triangle"></i>
							<span>Alertas</span>

						</a>

					</li>

					<li>

					<a href="#" data-toggle="modal" data-target="#ventanaModalModificarStatus">
							
							<i class="fa fa-tasks"></i>
							<span>Actualizar Status</span>

						</a>

					</li>
					
					<li>

						<a href="#" data-toggle="modal" data-target="#ventanaModalInforme">
							
							<i class="fa fa-file-text"></i>
							<span>Informe General</span>

						</a>

					</li>

					<li>

						<a href="#" id="statusVeterinario">
							
							<i class="fa fa-medkit"></i>
							<span>Status por Veterinario</span>

						</a>

					</li>

					<li>

						<a href="index.php?ruta=brutur/informePendientes">
							
							<i class="fa fa-file-text"></i>
							<span>Pendientes</span>

						</a>

					</li>
					
					<li>

						<a href="#" id="notificados">
							
							<i class="fa fa-check-square-o"></i>
							<span>Notificados</span>

						</a>

					</li>

				</ul>

			</li>

			<li class="treeview">

				<a href="#" id="menuAftosa">

					<i class="icon-aftosa" style="font-size:2.5em;padding-right:5px;"></i>
					
					<span>Aftosa</span>
					
					<span id="campaniaNumeroInfo"></span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu" id="desplegableAftosa">
					
					<li>

						<li class="treeview">

							<a href="#">
			
								<i class="fa fa-plus-square"></i>
								
								<span>Vacunas</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>
			
								</span>
			
							</a>
		
							<ul class="treeview-menu">
								
								<li>
			
									<a href="index.php?ruta=aftosa/recepcion">
										
										<i class="fa fa-sign-in"></i>
										<span>Recepci&oacute;n</span>
			
									</a>
			
								</li>
								
								<li>
			
									<a href="index.php?ruta=aftosa/distribucion">
										
										<i class="fa fa-sign-out"></i>
										<span>Distribuci&oacute;n</span>
			
									</a>
			
								</li>
							</ul>

						</li>
						
					</li>
					
					<li>

						<li class="treeview">

							<a href="#">
			
								<i class="fa fa-list-ul"></i>
								
								<span>Actas</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>
			
								</span>
			
							</a>
		
							<ul class="treeview-menu">
								
								<li>
			
									<a href="#" data-toggle="modal" data-target="#ventanaModalRenspaActa" id="cargarActa">
										
										<i class="fa fa-pencil-square-o"></i>
										<span>Cargar Acta</span>
			
									</a>
			
								</li>
								
								<li>
			
									<a href="#" data-toggle="modal" data-target="#ventanaModalRenspaActaProductor" id="actaProductor">
										
										<i class="fa fa-circle-o"></i>
										<span>Actas por Poductor</span>
			
									</a>
			
								</li>

							</ul>

						</li>
					
					</li>

					<li>

						<a href="index.php?ruta=aftosa/informes">
							
							<i class="fa fa-file-text"></i>
							<span>Informes</span>

						</a>

					</li>
					
					<li>
						
						<li class="treeview">

							<a href="#">
			
								<i class="fa fa-list-ul"></i>
								
								<span>Consultas</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>
			
								</span>
			
							</a>

							<ul class="treeview-menu">
								
								<li>
			
									<a href="index.php?ruta=aftosa/noVacunados">
										
										<i class="fa fa-circle-o"></i>
										<span>Est. NO vacunados</span>
			
									</a>
			
								</li>
								
								<li>
			
									<a href="index.php?ruta=aftosa/diferencia">
										
										<i class="fa fa-circle-o"></i>
										<span>Busqueda Diferencia</span>
			
									</a>
			
								</li>
								
								<li>
			
									<a href="index.php?ruta=aftosa/diferenciaParcial">
										
										<i class="fa fa-circle-o"></i>
										<span>Busqueda Diferencia Parcial</span>
			
									</a>
			
								</li>

							</ul>

						</li>

					</li>

					
					<li>

						<a href="#" data-toggle="modal" data-target="#ventanaModalRenspaSituacionProductor">
							
							<i class="fa fa-circle-o"></i>
							<span>Situaci&oacute;n Productor</span>

						</a>

					</li>
					
					<li>

					<a href="#" data-toggle="modal" data-target="#ventanaModalEditarCampania" id="btnMenuCampania">
							
						<i class="fa fa-circle-o"></i>
						<span>Campa&ntilde;a</span>

					</a>

					</li>

				</ul>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		if($_SESSION['usuario'] == 'admin'){

			echo '<li>

				<a href="#" data-toggle="modal" data-target="#modalCarga" id="cargarData">
									
					<i class="fa fa-pencil-square-o"></i>
					<span>Carga Animales</span>
		
				</a>


			</li>';

		}
		?>

		</ul>

	 </section>

</aside>
<?php
// BRUTUR
$idVentanaModal = 'ventanaModalModificarStatus';

$tituloModal = 'Modificar Satus Sanitario Bru-Tur';

$idRenspa = 'renspa';

$idBtnGenerar = 'actualizarStatus';

$motivo = 'bruTur';

$btnText = 'Actualizar Status';

$form = 'formRenspaActStatus';

include 'modales/modalRenspa.php';

$idVentanaModal = 'ventanaModalEstablecimientosSD';

$tituloModal = 'Establecimientos S/D';

$tipo = 'SD';

$idBtnGenerar = 'generarReporteSD';

include 'modales/brutur/modalRangoFecha.php';

$idVentanaModal = 'ventanaModalInforme';

$tituloModal = 'Informe Mensual Entes Brucelosis-Tuberculosis';

$tipo = 'Informe';

$idBtnGenerar = 'generarInformeGeneral';

include 'modales/brutur/modalRangoFecha.php';

// AFTOSA

// cargar Acta
$idVentanaModal = 'ventanaModalRenspaActa';

$tituloModal = 'Acta Aftosa';

$idRenspa = 'renspaAftosa';

$idBtnGenerar = 'btnCargarActa';

$motivo = 'aftosa';

$btnText = 'Ingresar Acta';

$form = 'formRenspaActa';

include 'modales/modalRenspa.php';

// acta Por Productor

$idVentanaModal = 'ventanaModalRenspaActaProductor';

$tituloModal = 'Actas Por Productor';

$idRenspa = 'renspaActasProductor';

$idBtnGenerar = 'btnBuscarActasProductor';

$motivo = null;

$btnText = 'Acta por Productor';

$form = 'formRenspaActaProductor';

include 'modales/modalRenspa.php';

// Situacion Productor

$idVentanaModal = 'ventanaModalRenspaSituacionProductor';

$tituloModal = 'Situacion Productor';

$idRenspa = 'renspaSituacionProductor';

$idBtnGenerar = 'btnBuscarSituacionProductor';

$motivo = null;

$btnText = 'Situacion Productor';

$form = 'formRenspaSitProductor';

include 'modales/modalRenspa.php';

// asignar Campaña

$idVentanaModal = 'ventanaModalCampania';

$tituloModal = 'Seleccionar Campaña';

$idBtnGenerar = 'asignarCampania';

$motivo = null;

include 'modales/aftosa/modalCampania.php';

include 'modales/aftosa/modalEditarCampania.php';

if($_SESSION["usuario"] == "admin"){
	
	include 'modales/cargarDatos.modal.php';
	
}

?>
