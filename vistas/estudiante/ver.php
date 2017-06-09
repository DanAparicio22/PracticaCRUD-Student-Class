<?php
	function getStudent($studentId){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students/'.$studentId);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}
 	if (isset($_GET['studentId'])) {
		$row= getStudent($_GET['studentId']);
	} else {
		header("Location: index.php");
	}
?>

<h3>Informacion del estudiante</h3>
<p>Id del estudiante: <?php echo $row->studentId?></p>
<p>Nombre: <?php echo $row->firstName?></p>
<p>Apellido: <?php echo $row->lastName?></p>
<p>Cursos inscritos: </p>
<?php
	for($i=0;$i<count($row->classCodes)-1;$i++){
 			echo $row->classCodes[$i].', ';
 	}
 	if(count($row->classCodes)>0){
 			echo $row->classCodes[count($row->classCodes)-1];
 	}else{
 			echo 'Ningun curso inscrito';
 	}
?>


