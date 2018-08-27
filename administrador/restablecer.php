<?php
	session_start();
	if (isset($_SESSION['tipo'])) {
		if ($_SESSION['tipo'] == 0 && isset($_GET["id_res"])) {
			$id_usuario = $_GET["id_res"]; 
			try {
				require_once('../includes/funciones/db_conexion.php');
				require("../sesiones/control_sesion.php");
				$sql = "SELECT * FROM datos INNER JOIN usuarios ON datos.id_usuario = usuarios.id_usuario WHERE datos.id_usuario = '$id_usuario'";
				$resultado =$conexion->query($sql);
				$datos = $resultado->fetch_assoc();
			} catch (Exception $e) {
				$error = $e->getMessage();
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Restablecer contraseña</title>
	<meta charset="utf-8">
		<title>Crear Usuario</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="../css/normalize.css">
	    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
	    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Oswald|PT+Sans" rel="stylesheet">
	    <link rel="stylesheet" href="../css/estilos.css">
	    <link rel="shortcut icon" href="../img/logo.ico">
</head>
<body>
	<div class="menutop">
		<header class="menu">
		      <input type="checkbox" id="btn-menu">
		      <label for="btn-menu"><i class="fas fa-bars"></i></label>
		      <a href="index.php" class="logo"><img src="../img/logo.png"></a>
		      <a href="index.php" class="logo1"><img src="../img/logo1.png"></a>
		      
		</header>
	</div>
	<div class="contenedor">
		<?php 
		$usuario = $datos["usuario"];
		$dia = $datos["dia"];
		$mes = $datos["mes"];
		$anio = $datos["anio"];
		$newContrasenia = $usuario . $dia . $mes . $anio;
		//echo $id_usuario. $usuario. $anio . $newContrasenia;
		$sql = "UPDATE usuarios SET contrasenia = md5('$newContrasenia') WHERE id_usuario='$id_usuario'";
		//echo $sql;
		$resultado = $conexion->query($sql);
		if($resultado){
			$mensaje = "Contraseña Restablecida.";
			setcookie('mensaje', $mensaje, time() + 3);
			header('location:index.php');
		} 
		else{
			"Error" . $conexion->error;
		}			
		 ?>
	</div>
</body>
<?php include("../includes/footer.php") ?>
</html>
	<?php
		$conexion->close();
		}//if tipo
		else{
			//header("Location:../usuario/index.php");
			header("Location:../index.php");
		}	
	}//if isset
	else{
		header("Location:../index.php");
		}	
	
	?>