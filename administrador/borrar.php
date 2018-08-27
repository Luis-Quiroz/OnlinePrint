<?php 
session_start();
if (isset($_SESSION['tipo']) && $_SESSION['tipo']== '0') {
	if (isset($_GET['id_usuario']) && $_GET['id_usuario'] !="") {
		$id_usuario = $_GET['id_usuario'];
	try {
		require_once('../includes/funciones/db_conexion.php');
		$sql="DELETE FROM datos WHERE id_usuario = '$id_usuario'";
		$sql2="DELETE FROM usuarios WHERE id_usuario = '$id_usuario'";
		$resultado = $conexion->query($sql);
		$resultado2 = $conexion->query($sql2);
	} catch (Exception $e) {
		$error = $e->getMessage();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Borrar Usuario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Oswald|PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../img/logo.ico">
</head>
<body>
	<div class="contenedor">
		<h1>Administración de Usuarios</h1>
		<div class="contenido">
				<?php 
				if($resultado && $resultado2){
					//echo "Usuario Eliminado";
					$mensaje = "Usuario Eliminado.";
					setcookie('mensaje', $mensaje, time() + 3);
					header('location:index.php');
				} 
				else{
					"Error" . $conexion->error;
				}
				?>
		</div>
	</div>
	<?php
	$conexion->close();
	}//fin get id_usuario
}//fin sesion tipo
else{
	header("Location:../iniciar_sesion.php");
}
	?>
</body>
<?php include("../includes/footer.php") ?>
</html>

