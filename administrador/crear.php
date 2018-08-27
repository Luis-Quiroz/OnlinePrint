<?php 
session_start();
if (isset($_SESSION['tipo']) && $_SESSION['tipo']== '0') {
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Crear Usuario</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="stylesheet" href="../css/normalize.css">
	    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
	    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Oswald|PT+Sans" rel="stylesheet">
	    <link rel="stylesheet" href="../css/estilos.css">
	    <link rel="shortcut icon" href="../img/logo.ico">
	</head>
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
	if(isset($_POST["nombre"]) && $_POST['nombre'] != "" && isset($_POST["apellido_pat"]) && $_POST['apellido_pat'] != "" && isset($_POST["apellido_mat"]) && $_POST['apellido_mat'] != "" && isset($_POST["correo"]) && $_POST['correo'] != "" && isset($_POST["dia"]) && $_POST['dia'] != "" && isset($_POST["mes"]) && $_POST['mes'] != "" && isset($_POST["anio"]) && $_POST['anio'] != "" && isset($_POST["usuario"]) && $_POST['usuario'] != "" && isset($_POST["contrasenia"]) && $_POST['contrasenia'] != "" && isset($_POST["confContra"]) && $_POST['confContra'] != "" && $_POST["g-recaptcha-response"]!=""){
		require_once('../includes/funciones/db_conexion.php');
		//especificamos el tipo de caracteres que va a escapar
		//$conexion->set_charset('utf8');

		if ($_POST["dia"]>0 && $_POST["dia"]<32) {
			$dia = $conexion->real_escape_string($_POST["dia"]);
		}
		else{
			echo "Día invalido <br>";
		}
		if ($_POST["mes"]>0 && $_POST["mes"]<13) {
			$mes = $conexion->real_escape_string($_POST["mes"]);
		}
		else{
			echo "Mes invalido <br>";
		}
		if ($_POST["anio"]>1917 && $_POST["anio"]<2019) {
			$anio = $conexion->real_escape_string($_POST["anio"]);
		}
		else{
			echo "Año invalido <br>";
		}
		if (isset($dia) && isset($mes) && isset($anio)) {
			//año bisiesto
			if ($anio%4 == 0) {
				//echo "año bisiesto <br>";
				$bisiesto = 1;
			}
			else{
				//echo "año NO bisiesto <br>";
				$bisiesto = 0;
			}

			//meses de 30 dias 	4	6 	9	11 | abril junio septiembre noviembre
			//meses de 31 dias 	1	3	5	7	8	10	12 enero marzo mayo julio agosto octubre dicembre
			//febrero		
			if ($mes =="4" || $mes =="6" || $mes =="9" || $mes =="11") {	
				if ($dia>0 && $dia<31) {//1-30 dias
					$diapro = $dia;
				}
				else{
					echo " Ese mes no tiene $dia días <br>";
				}
			}
			else if ($mes =="1" || $mes =="3" || $mes =="5" || $mes =="7" || $mes =="8" || $mes =="10" || $mes =="12") {	
				if ($dia>0 && $dia<32) {//1-31 dias
					$diapro = $dia;
				}
				else{
					echo " Ese mes no tiene $dia días <br>";
				}
			}
			else if ($mes =="2" && $bisiesto == 0){
				if ($dia>0 && $dia<29) {
					$diapro = $dia;
				}
				else{
					echo " Ese mes no tiene $dia días <br>";
				}
			}
			else if ($mes =="2" && $bisiesto == 1){
				if ($dia>0 && $dia<30) {
					$diapro = $dia;
				}
				else{
					echo " Ese mes no tiene $dia días <br>";
				}
			}
			else {
				echo "Mes invalido";
			}
			if (isset($diapro)) {
				$nombre = $conexion->real_escape_string($_POST['nombre']);
				$apellido_pat = $conexion->real_escape_string($_POST['apellido_pat']);
				$apellido_mat = $conexion->real_escape_string($_POST['apellido_mat']);
				$correo = $conexion->real_escape_string($_POST['correo']);
				$usuario = $conexion->real_escape_string($_POST['usuario']);
				$contrasenia = $conexion->real_escape_string($_POST['contrasenia']);
				$conf_contrasenia = $conexion->real_escape_string($_POST['confContra']);
				//captcha
				$recaptcha = $_POST["g-recaptcha-response"];

				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$data = array(
					'secret' => '6LcmV04UAAAAAOVjjk5MJmAd3HPNMkC7UlGWgOli',
					'response' => $recaptcha
				);
				$options = array(
					'http' => array (
						'method' => 'POST',
						'content' => http_build_query($data)
					)
				);
				$context  = stream_context_create($options);
				$verify = file_get_contents($url, false, $context);
				$captcha_success = json_decode($verify);


				if ($captcha_success->success) {
					// No eres un robot, continuamos 
					try {

						//consulta correo
						$selcorreo = "SELECT * FROM datos WHERE correo = '$correo'";
						$rescorreo =$conexion->query($selcorreo);
						//consulta usuario
						$selusuario = "SELECT * FROM  usuarios WHERE usuario = '$usuario'";
						$resusu =$conexion->query($selusuario);
						if ($rescorreo->num_rows >0) {
							echo "El correo ya existe";
						}
						else if ($resusu->num_rows >0) {
							echo "El usuario ya existe";
						}
						else{
							///inserta
							$sql = "INSERT INTO datos (id_usuario, nombre, apellido_pat, apellido_mat, correo, dia, mes, anio) VALUES (NULL, '$nombre', '$apellido_pat', '$apellido_mat', '$correo', '$dia', '$mes', '$anio')";
							$sql2 = "INSERT INTO usuarios (id_usuario, usuario, contrasenia, tipo_usuario) VALUES (NULL, '$usuario', md5('$contrasenia'), 1)";

							$resultado = $conexion->query($sql);
							$resultado2 = $conexion->query($sql2);
							if ($resultado && $resultado2) {
								$mensaje = "Usuario creado.";
								setcookie('mensaje', $mensaje, time() + 3);
								header('location:index.php');
								
							}
							else {
								"Error" . $conexion->error;
							}
						}//fin else
						$conexion->close();
					} catch (Exception $e) {
						echo $e->getMessage();
					}
				} // fin if valida recaptcha
				else {
					// Eres un robot!
					echo "Al parecer ha habido un problema con el Recaptcha :(";
				}
			}
			else{
				//echo "no existe la variable 'diapro' <br>";
			}
		}//fin if isset de varibales dia, mes año
		else{
			//echo "<br>Algunos campos no existen";
		}
	}//fin if campos vacios
	else{
		echo "Hay campos vacios";
	}
	//"No te esfuerzes por saber mas, esfuerzate por ser el mejor en lo que sabes... Y asi sabras mas"

}//fin if (isset($_SESSION['tipo']) && $_SESSION['tipo']== '0') {
	else{
		header("Location:../iniciar_sesion.php");
	}
?>
	</div>
</body>
<?php include("../includes/footer.php") ?>
</html>




