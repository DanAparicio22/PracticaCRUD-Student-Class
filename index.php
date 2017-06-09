<?php 
	include_once("modulos/enrutador.php");
 ?>

 <!DOCTYPE html>
 <html>
	 <head>
	 	<meta charset="utf-8"/>
	 	<title>Curso de formacion continua</title>
	 </head>
	 <body>
			<a href="index.php">Inicio</a>
	 		<?php 
	 			$enrutador = new Enrutador();
	 			if ($enrutador->validarGET($_GET['cargar'])) {
	 				$enrutador->cargarVista($_GET['cargar']);
	 			}
	 		 ?>

	 </body>
 </html>