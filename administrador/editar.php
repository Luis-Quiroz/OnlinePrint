<?php
session_start();
if (isset($_SESSION['tipo']) && $_SESSION['tipo']== '0') {
	if(isset($_GET['id_usuario'])){
		$id_usuario = $_GET['id_usuario'];
	}
	try {
		require_once('../includes/funciones/db_conexion.php');

		$sql = "SELECT * FROM datos INNER JOIN usuarios ON datos.id_usuario = usuarios.id_usuario WHERE datos.id_usuario = $id_usuario";

		$resultado =$conexion->query($sql);
	} catch (Exception $e) {
		$error = $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Usuario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Oswald|PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../img/logo.ico">
</head>
<body>
	<div class="menutop">
		<header>
	      <input type="checkbox" id="btn-menu">
	      <label for="btn-menu"><i class="fas fa-bars"></i></label>
	      <a href="index.php" class="logo"><img src="../img/logo.png"></a>
	      <a href="index.php" class="logo1"><img src="../img/logo1.png"></a>
	      <nav class="menu">
	        <ul>
	        	<li><a href="#"><?php echo $_SESSION["username"]; ?></a></li>
	          	<li><a href="../sesiones/cerrar_sesion.php">Cerrar Sesión</a></li>
	        </ul>
	      </nav>
	    </header>
	</div>
	<div class="contenedor clearfix">
		<div class="distancia center">
			<form action="actualizar.php" method="POST" class="formRegistro" onsubmit="return validar();">
				<?php while ($registro=$resultado->fetch_assoc()) {?>
				<div class="campo">
					<label>Nombre completo</label>
				</div>
				<div class="nombre">
					<div class="campo">
						<input type="text" value="<?php echo $registro['nombre']; ?>" name="nombre" id="nombre" placeholder="Nombre(s)" onChange="borrarError('nombre');" required>
					</div>
					<div class="campo">
						<input type="text" value="<?php echo $registro['apellido_pat']; ?>" name="apellido_pat" id="apellido_pat" placeholder="Apellido Paterno" onChange="borrarError('apellido_pat');" required>
					</div>
					<div class="campo">
						<input type="text" value="<?php echo $registro['apellido_mat']; ?>" name="apellido_mat" id="apellido_mat" placeholder="Apellido Materno" onChange="borrarError('apellido_mat');" required>
					</div>
				</div>
				<div class="campo">
					<label class="a">Fecha de Nacimiento</label>
				</div>
				<div class="fecha">
						<div class="campo">
						<input type="number" value="<?php echo $registro['dia']; ?>" name="dia" id="dia" placeholder="DD" min="1" max="31" onChange="borrarError('dia');" required>
					</div>
					<div class="campo">
						<input type="number" value="<?php echo $registro['mes']; ?>" name="mes" id="mes" placeholder="MM" min="1" max="12" onChange="borrarError('mes');" required>
					</div>
					<div class="campo">
						<input type="number" value="<?php echo $registro['anio']; ?>" name="anio" id="anio" placeholder="AAAA"  min="1918" max="2018"  onChange="borrarError('anio');" required>
					</div>
				</div><br><br>
				<center>
					<div class="captcha">
						<div class="g-recaptcha" data-sitekey="6LcmV04UAAAAAMH7EXQ4c0liHb8gzIltxgfd5zJr"></div><br>
						<p id="mensajeError"></p>
						<input type="submit" value="Modificar" id="crear" class="boton" name="crear">
						<a href="index.php" class="boton2" >Cancelar</a>
					</div>
				</center>
				<input type="hidden" name="id_usuario" value="<?php echo $registro['id_usuario']; ?>">
				<?php }//fin while?>
			</form>
		</div>
	</div>
<?php
$conexion->close();
}//fin if (isset($_SESSION['tipo']) && $_SESSION['tipo']== '0') {
else{
	header("Location:../iniciar_sesion.php");
}
	?>
</body>
<?php include("../includes/footer.php") ?>
<!--
<footer>
  <script type="text/javascript">
    function startTime(){
    today=new Date();
    h=today.getHours();
    m=today.getMinutes();
    s=today.getSeconds();
    m=checkTime(m);
    s=checkTime(s);
    document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
    t=setTimeout('startTime()',500);}
    function checkTime(i)
    {if (i<10) {i="0" + i;}return i;}
    window.onload=function(){startTime();}
  </script>
  <div id="reloj"></div>
  <script type="text/javascript">
    //<![CDATA[
    var date = new Date();
    var d  = date.getDate();
    var day = (d < 10) ? '0' + d : d;
    var m = date.getMonth() + 1;
    var month = (m < 10) ? '0' + m : m;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    document.write(day + "/" + month + "/" + year);
    //]]> 
  </script>
</footer>-->
</html>

