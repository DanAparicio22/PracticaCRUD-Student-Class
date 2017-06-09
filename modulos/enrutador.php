<?php 

	class Enrutador {

		public function cargarVista($vista) {

			switch($vista):

				case "crearestudiante":
					include_once('vistas/estudiante/crear.php' );
					break;

				case "verestudiante":
					include_once('vistas/estudiante/ver.php' );
					break;

				case "editarestudiante":
					include_once('vistas/estudiante/editar.php' );
					break;

				case "eliminarestudiante":
					include_once('vistas/estudiante/eliminar.php' );
					break;

				case "crearclase":
					include_once('vistas/clase/crear.php' );
					break;

				case "verclase":
					include_once('vistas/clase/ver.php' );
					break;

				case "editarclase":
					include_once('vistas/clase/editar.php' );
					break;

				case "eliminarclase":
					include_once('vistas/clase/eliminar.php' );
					break;

				default:
					include_once('vistas/error.php');

			endswitch;
		}

		public function validarGET($variable) {
			if (empty($variable)) {
				include_once('vistas/inicio.php');
			} else {
				return true;
			}
		}

	}

 ?>