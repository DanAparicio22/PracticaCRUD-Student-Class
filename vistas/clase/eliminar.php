<?php 
	function getClass($code){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes/'.$code);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}

 	function deleteStudent($code){
 		$url ='http://localhost:8080/SimpleSchedulingApp1/api/v1/classes/'.$code;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL,$url);
    	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
   		$result = curl_exec($ch);
    	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    	curl_close($ch);
 	}

 	if (isset($_GET['code'])) {
		$row = getClass($_GET['code']);
	} else {
		header("Location: index.php");
	}

	if (isset($_POST['enviar'])) {
		deleteStudent($_GET['code']);
		header("Location: index.php");
	}
 ?>
<br><br>
Quiere eliminar la clase: <?php echo $row->title ?>?
<br><br>

<form action="" method="POST">
 	<input type="submit" name="enviar" value="Eliminar">
</form>