<?php 

	function updateClass($code,$title,$description,$studentIds){

		$url ='http://localhost:8080/SimpleSchedulingApp1/api/v1/classes';
		$data = array("code" => $code, "title" => $title,"description"=>$description,"studentIds"=>$studentIds);                                                                     
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

 	function getClass($code){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes/'.$code);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}

	if (isset($_GET['code'])) {
		$row = getClass($_GET['code']);
	} else {
		header("Location: index.php");
	}

	if (isset($_POST['enviar'])) {
		if(!empty($_POST['check_list'])){
			updateClass($_GET['code'],$_POST['title'], $_POST['description'],$_POST['check_list']);
		}else{
			updateClass($_GET['code'],$_POST['title'], $_POST['description'],[]);	
		}
		header('Location: index.php');
	}

 ?>
<br><br>
 <form action="" method="POST">
 	Codigo de clase: <br>
 	<input type="text" name="code" value="<?php echo $row->code ?>" disabled>
  	<br><br>
 	Titulo: <br>
 	<input type="text" name="title" value="<?php echo $row->title ?>" required>
 	<br><br>
 	Descripcion: <br>
 	<input type="text" name="description" value="<?php echo $row->description ?>" required>
 	<br><br>
 	<p>Estudiantes inscritos: </p>
	<?php
		for($i=0;$i<count($row->studentIds)-1;$i++){
 				echo $row->studentIds[$i].', ';
 		}
 		if(count($row->studentIds)>0){
 				echo $row->studentIds[count($row->studentIds)-1].'<br><br>';
 		}else{
 				echo 'Ningun estudiante inscrito<br><br>';
 		}
	?>
 	<label>Estudiantes:</label><br>
	<?php
		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students');
	 	if ($content==TRUE) {
	 		$data2 = json_decode($content);
	 		for ($i = 0; $i < count($data2); $i++) {?>
			<input type="checkbox" name="check_list[]" value="<?php echo $data2[$i]->studentId ?>"><label><?php echo $data2[$i]->studentId ?></label><br/>
	<?php }}?><br>
 	<input type="submit" name="enviar" value="Editar">
 </form>

