<?php 

	function createStudent($id,$firstname,$lastname,$classCodes){
		$data = array("studentId" => $id, "lastName" => $lastname,"firstName"=>$firstname,"classCodes"=>$classCodes);                                                                    
		$data_string = json_encode($data);                                                                                                                                      
		$ch = curl_init('http://localhost:8080/SimpleSchedulingApp1/api/v1/students');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
                                                                                                                     
		$result = curl_exec($ch);
 	}

 	function getStudent($studentId){
 		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students/'.$studentId);
 		if ($content ==TRUE){
 			$data = json_decode($content);
 			return $data;
 		}
 	}

 	if (isset($_POST['enviar'])) {
 		if(getStudent($_POST['studentId'])==null){
 			if(!empty($_POST['check_list'])){
 				createStudent($_POST['studentId'], $_POST['firstName'], $_POST['lastName'],$_POST['check_list']);
 			}else{
 				createStudent($_POST['studentId'], $_POST['firstName'], $_POST['lastName'],[]);
 			}
			echo "Se ha registrado un nuevo estudiante<br></br>";
		}else{
			echo "Estudiante registrado anteriormente <br></br>";
		}
	}
 ?>
<h3>Registro de un nuevo estudiante</h3>
<hr>
<form action="" method="POST">
	<label>Id estudiante:</label><br>
	<input type="text" name="studentId" required>
	<br><br>
	<label>Nombre:</label><br>
	<input type="text" name="firstName" minlength="1" maxlength="30" required>
	<br><br>
	<label>Apellido:</label><br>
	<input type="text" name="lastName" minlength="1" maxlength="30" required>
	<br><br>
	<label>Cursos a tomar:</label><br>
	<?php
		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes');
	 	if ($content==TRUE) {
	 		$data2 = json_decode($content);
	 		for ($i = 0; $i < count($data2); $i++) {?>
			<input type="checkbox" name="check_list[]" value="<?php echo $data2[$i]->code ?>"><label><?php echo $data2[$i]->code?></label><br/>
	<?php }}?><br>
	<input type="submit" name="enviar" value="Crear">
</form>

