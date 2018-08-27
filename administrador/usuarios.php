<?php
// Obtenemos el nombre del usuario desde la URL
$id = $_GET['id'];
?><!DOCTYPE>
<head>
	<meta charset="utf-8">
    <title>Ejemplo de URL amigable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One|Oswald|PT+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="shortcut icon" href="../../img/logo.ico">
</head>
<body>
	<header>
      <input type="checkbox" id="btn-menu">
      <label for="btn-menu"><i class="fas fa-bars"></i></label>
      <a href="../../../index.php" class="logo"><img src="../../img/logo.png"></a>
      <a href="../../../index.php" class="logo1"><img src="../../logo1.png"></a>
      <nav class="menu">
        <ul>
        	
          	<li><a href="../index.php">Regresar</a></li>
          	<li><a href="../cerrar_sesion.php">Cerrar Sesión</a></li>
        </ul>
      </nav>
    </header>


  <p>Nombre de Usuario: <?php echo $id; ?></p>
</body>
</html>