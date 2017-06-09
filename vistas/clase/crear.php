<?php
	function createClass($code,$title,$description,$studentIds){
		$data = array("code" => $code, "title" => $title,"description"=>$description,"studentIds"=>$studentIds);                                                                    
		$data_string = json_encode($data);                                                                                                                                                                                               
		$ch = curl_init('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
                                                                                                                     
		$result = curl_exec($ch);
 	}

 	function getClass($code){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes/'.$code);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}

 	if (isset($_POST['enviar'])) {
 		if(getClass($_POST['code'])==null){
 			if(!empty($_POST['check_list'])){
 				createClass($_POST['code'], $_POST['title'], $_POST['description'],$_POST['check_list']);
 			}else{
 				createClass($_POST['code'], $_POST['title'], $_POST['description'],[]);
 			}
			echo "Se ha registrado una nueva clase<br><br>";
		}else{
			echo "Clase anteriormente registrada <br><br>";
		}

	}
?>
<h3>Registro de una nueva clase</h3>
<hr>
<form action="" method="POST">
	<label>Codigo de clase:</label><br>
	<input type="text" name="code" maxlength="7" required>
	<br><br>
	<label>Titulo:</label><br>
	<input type="text" name="title" minlength="1" maxlength="30" required>
	<br><br>
	<label>Descripcion:</label><br>
	<input type="text" name="description" minlength="1" maxlength="500" required>
	<br><br>
	<label>Estudiantes:</label><br>
	<?php
		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students');
	 	if ($content==TRUE) {
	 		$data2 = json_decode($content);
	 		for ($i = 0; $i < count($data2); $i++) {?>
			<input type="checkbox" name="check_list[]" value="<?php echo $data2[$i]->studentId ?>"><label><?php echo $data2[$i]->studentId?></label><br/>
	<?php }}?><br>
	<input type="submit" name="enviar" value="Crear">
</form>