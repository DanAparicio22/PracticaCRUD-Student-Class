<?php 

	function updateStudent($studentId,$firstName,$lastName,$classCodes){

		$url ='http://localhost:8080/SimpleSchedulingApp1/api/v1/students';
		$data = array("studentId" => $studentId, "lastName" => $lastName,"firstName"=>$firstName,"classCodes"=>$classCodes);
		$data_json = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response  = curl_exec($ch);
		curl_close($ch);
 	}

 	function getStudent($studentId){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students/'.$studentId);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}

	if (isset($_GET['studentId'])) {
		$row = getStudent($_GET['studentId']);
	} else {
		header("Location: index.php");
	}

	if (isset($_POST['enviar'])) {
		if(!empty($_POST['check_list'])){
			updateStudent($_GET['studentId'],$_POST['firstName'], $_POST['lastName'],$_POST['check_list']);
		}else{
			updateStudent($_GET['studentId'],$_POST['firstName'], $_POST['lastName'],[]);	
		}
		header('Location: index.php');
	}

 ?>
 <br><br>
 <form action="" method="POST">
 	Id Estudiante: <br>
 	<input type="text" name="studentId" value="<?php echo $row->studentId ?>" disabled>
  	<br><br>
 	Nombre: <br>
 	<input type="text" name="firstName" value="<?php echo $row->firstName ?>" required>
 	<br><br>
 	Apellido: <br>
 	<input type="text" name="lastName" value="<?php echo $row->lastName ?>" required>
 	<br><br>
 	<p>Cursos inscritos: </p>
	<?php
		for($i=0;$i<count($row->classCodes)-1;$i++){
 				echo $row->classCodes[$i].', ';
 		}
 		if(count($row->classCodes)>0){
 				echo $row->classCodes[count($row->classCodes)-1].'<br><br>';
 		}else{
 				echo 'Ningun curso inscrito<br><br>';
 		}
	?>
 	<label>Cursos:</label><br>
	<?php
		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes');
	 	if ($content==TRUE) {
	 		$data2 = json_decode($content);
	 		for ($i = 0; $i < count($data2); $i++) {?>
			<input type="checkbox" name="check_list[]" value="<?php echo $data2[$i]->code ?>"><label><?php echo $data2[$i]->code?></label><br/>
	<?php }}?><br>
 	<input type="submit" name="enviar" value="Editar">
 </form>