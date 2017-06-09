<h3>Estudiantes</h3>
<a href="?cargar=crearestudiante">Registrar estudiante</a>
<br><br>
<table border="1">
	<thead>
		<th>Id Estudiante</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Acción</th>
	</thead>
	<tbody>
		<?php
		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/students');
	 	if ($content==TRUE) {
	 		$data = json_decode($content);

	 		for ($i = 0; $i < count($data); $i++) {?>
			<tr>
				<td><?php echo $data[$i]->studentId ?></td>
				<td><?php echo $data[$i]->firstName ?></td>
				<td><?php echo $data[$i]->lastName ?></td>
				<td>
				<a href="?cargar=verestudiante&studentId=<?php echo $data[$i]->studentId ?>">Ver</a>
				<a href="?cargar=editarestudiante&studentId=<?php echo $data[$i]->studentId ?>">Editar</a>
				<a href="?cargar=eliminarestudiante&studentId=<?php echo $data[$i]->studentId ?>">Eliminar</a>
				</td>
			</tr>

		<?php }}?>
	</tbody>
</table>
<h3>Clases</h3>


<a href="?cargar=crearclase">Registrar clase</a>
<br><br>
<table border="1">
	<thead>
		<th>Codigo de clase</th>
		<th>Titulo</th>
		<th>Descripcion</th>
		<th>Acción</th>
	</thead>
	<tbody>
		<?php
		$content = @file_get_contents('http://localhost:8080/SimpleSchedulingApp1/api/v1/classes');
	 	if ($content==TRUE) {
	 		$data = json_decode($content);

	 		for ($i = 0; $i < count($data); $i++) {?>
			<tr>
				<td><?php echo $data[$i]->code ?></td>
				<td><?php echo $data[$i]->title ?></td>
				<td><?php echo $data[$i]->description ?></td>
				<td>
				<a href="?cargar=verclase&code=<?php echo $data[$i]->code ?>">Ver</a>
				<a href="?cargar=editarclase&code=<?php echo $data[$i]->code ?>">Editar</a>
				<a href="?cargar=eliminarclase&code=<?php echo $data[$i]->code ?>">Eliminar</a>
				</td>
			</tr>

		<?php }}?>
	</tbody>
</table>