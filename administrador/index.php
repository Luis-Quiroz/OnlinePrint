<?php
	session_start();
	if (isset($_SESSION['tipo'])) {
		if ($_SESSION['tipo'] == 0) {
			try {
				require_once('../includes/funciones/db_conexion.php');
				require("../sesiones/control_sesion.php");
				$sql = "SELECT * FROM datos INNER JOIN usuarios ON datos.id_usuario = usuarios.id_usuario";
				$resultado =$conexion->query($sql);
			} catch (Exception $e) {
				$error = $e->getMessage();
			}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrar Usuarios</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Oswald|PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../img/logo.ico">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
    <script type="text/javascript" src="../DataTables/datatables.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="../js/validar.js"></script>  
    <script src="../js/mensajes.js" ></script>
    <script type="text/javascript">
		$(document).ready(function() {
		    $('#datos').DataTable();
		} );
	</script>
    <script type="text/javascript">
    	function mostrarOcultar(){
    		var contenido = document.getElementById("crear");
    		var enlace = document.getElementById("enlace");
    		if (contenido.style.display == "" || contenido.style.display == "none") {
    			contenido.style.display = "block";
    			enlace.innerHTML = "Ocultar";
    		}
    		else{
    			contenido.style.display = "none";
    			enlace.innerHTML = "Crear usuario";//oculta los campos
    		}
    	}
    </script>
    
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
    <div class="mensaje" id = 'mensaje'>
	    <?php 
	    if (isset($_COOKIE['mensaje'])) {
	      echo $_COOKIE['mensaje'];
	    }
	    ?>
	 </div>  

	<div class="contenedor campo">
		<div class="existentes">
			
			<table id="datos" >
				<div class="datos">
				<thead>
				<tr>
					<th>Nombre</th>
					<th>Correo</th>
					<th>Fecha Nacimiento</th>
					<th>Usuario</th>
					<th>Editar</th>
					<th>Borrar</th>
					<th>Contraseña</th>
				</tr>
				</thead>
				<tbody>
					<?php while ($registros = $resultado->fetch_assoc() ) {?>
						<tr>
							<td><?php echo $registros['nombre'];?>
								<?php echo $registros['apellido_pat'];?>
								<?php echo $registros['apellido_mat'];?></td>
							<td><?php echo $registros['correo'];?></td>
							<td><?php echo $registros['dia'];
								echo "/";
								echo $registros['mes'];
								echo "/";
								echo $registros['anio'];?></td>
							<!--<td><a class="limpiar" href="usuarios/<?php echo($registros['usuario']) ?> "><?php echo $registros['usuario'];?></a></td>-->
							<td><a class="limpiar"><?php echo $registros['usuario'];?></a></td>
							<td><a href="editar.php?id_usuario=<?php echo $registros['id_usuario']; ?>">Editar</a></td>
							<!--<td class="borrar" id="borrado"><a href="borrar.php?id_usuario=<?php echo $registros['id_usuario']; ?>">BORRAR</a></td>-->
							<td class="borrar" id="borrado"><a href="#" onclick="preguntar(<?php echo $registros['id_usuario']; ?>)">Borrar</a></td>
							<td class="borrar" id="borrado"><a href="#" onclick="restablecer(<?php echo $registros['id_usuario']; ?>)">
								<div class="tooltip">
								 	<div class="info">?</div>
									<span class="tooltiptext">Contraseña restablecida = Nombre de usuario + Día + mes + año de nacimiento. Ejemplo: Usuario111918</span>
								</div> Restablecer</a></td>
						</tr>

					<?php }
					//fetch_assoc: inserta los datos en un array asociado
					//fetch_row: inserta los datos en un array indexado
					//fetch_array: inserta los datos como un array asociado e indexado ?>
				</tbody>
				</div>
			</table>
		</div><br>

		<div class="contenido clearfix" id="crear" style="display: none;">
			<div class="distancia center">
			<form action="crear.php"method="post" class="formRegistro" onsubmit="return validar();">
				<div class="campo">
					<label>Nombre completo</label>
				</div>
				<div class="nombre">
					<div class="campo">
						<input type="text" name="nombre" id="nombre" placeholder="Nombre(s)" onChange="borrarError('nombre');" maxlength="50" required>
					</div>
					<div class="campo">
						<input type="text" name="apellido_pat" id="apellido_pat" placeholder="Apellido Paterno" onChange="borrarError('apellido_pat');" maxlength="20" required>
					</div>
					<div class="campo">
						<input type="text" name="apellido_mat" id="apellido_mat" placeholder="Apellido Materno" onChange="borrarError('apellido_mat');" maxlength="20" required>
					</div>
				</div>
				<div class="campo">
					<label class="a">Fecha de Nacimiento</label>
					<label class="b">Correo</label>
				</div>
				<div class="fecha">
						<div class="campo">
						<input type="number" name="dia" id="dia" placeholder="DD" min="1" max="31" onChange="borrarError('dia');" required>
					</div>
					<div class="campo">
						<input type="number" name="mes" id="mes" placeholder="MM" min="1" max="12" onChange="borrarError('mes');" required>
					</div>
					<div class="campo">
						<input type="number" name="anio" id="anio" placeholder="AAAA"  min="1918" max="2018"  onChange="borrarError('anio');" required>
					</div>
					<div class="campo correo">
						<input type="email" name="correo" id="correo" placeholder="Correo" onChange="borrarError('correo');" maxlength="50" required>
					</div>
				</div><br><br>
				<div class="usuario">
					<div class="campo">
						<label for="usuario">Usuario</label>
						<div class="tooltip">
						 	<div class="info">?</div>
							<span class="tooltiptext">Mínimo una mayúscula y una minúscula. Max 16 caracteres. Sin espacios</span>
						</div>
						<input type="text" name="usuario" id="usuario" placeholder="Usuario" onChange="borrarError('usuario');" maxlength="16" required>
					</div>
					<div class="campo">
						<label for="contrasenia">Contraseña</label>
						<div class="tooltip">
						 	<div class="info">?</div>
							<span class="tooltiptext">La contraseña debe tener mínimo 8 caracteres y un máximo de 16 caracteres, 1 mayúscula, 1 minúscula, 1 número y no debe contener espacios.</span>
						</div>
						<input type="password" name="contrasenia" id="contrasenia" placeholder="Contraseña" onChange="borrarError('contrasenia');" maxlength="16" required>
					</div>
					<div class="campo">
						<label for="confContra">Confirmar Contraseña</label>
						<input type="password" name="confContra" id="confContra" placeholder="Confirmar Contraseña" onChange="borrarError('confContra');" maxlength="16" required>
					</div>
				</div>
				<center>
					<div class="captcha">
						<div class="g-recaptcha" data-sitekey="6LcmV04UAAAAAMH7EXQ4c0liHb8gzIltxgfd5zJr"></div><br>
						<p id="mensajeError"></p>
						<input type="submit" value="Crear cuenta" id="crear"  name="crear">
					</div>
				</center>
			</form>
		</div>
		</div><!--.contenido--><br>
		<a href="#" id="enlace" class="botonreg" onclick="mostrarOcultar();return false;">Crear usuario</a>
	</div><!--.contenedor-->
	<script type="text/javascript">
		function preguntar(id_usuario){
			if(confirm('¿Deseas borrar este registro de forma permanente?')){
				window.location.href = "borrar.php?id_usuario="+id_usuario;
			}
		}
		function restablecer(id_res){
			if(confirm('¿Deseas restablecer la contraseña de este usuario?')){
				window.location.href = "restablecer.php?id_res="+id_res;
			}
		}
	</script>
	</body>
<!--<footer>
  
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



