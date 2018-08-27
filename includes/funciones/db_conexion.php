<?php
	//$conexion = new mysqli('localhost', 'root', '', 'asistencia_automatizada');
	//$conexion = new mysqli('localhost', 'at14300691', '46536f5ab', 'asistencia_automatizada');
	$conexion = new mysqli('localhost', 'online_print', '123online_print', 'onlineprint_bd');
	//servidor, usuario, contraseña del usuario, nombre de la base de datos
	
	if($conexion->connect_error){
		//echo "Error al conectarse con MySQL debido al error " . $conn->connect_error;
		echo $error = $conexion->$connect_error;
	}
?>