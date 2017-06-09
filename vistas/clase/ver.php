<?php
	function getClass($code){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes/'.$code);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}
 	if (isset($_GET['code'])) {
		$row= getClass($_GET['code']);
	} else {
		header("Location: index.php");
	}
?>
<h3>Informacion del estudiante</h3>
<p>Codigo de la clase: <?php echo $row->code?></p>
<p>Titulo: <?php echo $row->title?></p>
<p>Descripcion: <?php echo $row->description?></p>
<p>Estudiantes inscritos: </p>
<?php
	for($i=0;$i<count($row->studentIds)-1;$i++){
 			echo $row->studentIds[$i].', ';
 	}
 	if(count($row->studentIds)>0){
 			echo $row->studentIds[count($row->studentIds)-1];
 	}else{
 			echo 'Ningun estudiante inscrito';
 	}
?>