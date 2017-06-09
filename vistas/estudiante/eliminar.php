<?php 
	function getStudent($studentId){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students/'.$studentId);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}

 	function deleteStudent($studentId){
 		$url ='http://localhost:8080/SimpleSchedulingApp1/api/v1/students/'.$studentId;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL,$url);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
   		$result = curl_exec($ch);
    	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    	curl_close($ch);
 	}

 	if (isset($_GET['studentId'])) {
		$row = getStudent($_GET['studentId']);
	} else {
		header("Location: index.php");
	}

	if (isset($_POST['enviar'])) {
		deleteStudent($_GET['studentId']);
		header("Location: index.php");
	}
 ?>
<br><br>
Quiere eliminar al estudiante: <?php echo $row->firstName ?>?
<br><br>

<form action="" method="POST">
 	<input type="submit" name="enviar" value="Eliminar">
</form>