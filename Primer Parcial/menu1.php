<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script type="text/javascript" src="bootstrap.min.css"></script>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="menu1.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="empleados_gestor.php">Empleados <img src="Users.png"> <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="departamento_gestor.php"> Departamentos <img src="Departamento.png"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="acciones_gestor.php">Acciones <img src="acciones.png"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="consultas_consult.php">Consultas <img src="consultas.png"></a>
      </li>
      <li class="nav-item">
        <a href="index.php" name="submit" class="text-warning">Cerrar Sesión <img src="logout.png"></a>
      </li>
    </ul>
  </div>
</nav>
<?php

require_once "config.php";

session_start();

if(empty($_SESSION['isLogged'])){
    header("location: index.php");
    exit();
}
else if(empty($_SESSION['usuario'])){
    header("location: index.php");
    exit();
}
else if($_SESSION['rol'] == 1){
    header("location: menu2.php");
    exit();
}

echo "BIENVENIDO ". $_SESSION['usuario'];

echo "<br/>"; echo "<br/>";

echo "INFORMACIÓN:"; echo "<br/>"; echo "<br/>";

$query3 = "SELECT * from empleado where usuario='" . $_SESSION['usuario'] . "'";
$result = mysqli_query($link, $query3);
	
if($row = mysqli_fetch_array($result)){
	echo "NOMBRE: " . $row['nombre']. "  ". $row['apellido'];
	echo "<br/>";
  echo "CÉDULA: " . $row['cedula'];
  echo "<br/>";
	echo "DIRECCIÓN: " . $row['direccion'];
	echo "<br/>";
	echo "NÚMERO DE TELÉFONO: " . $row['telefono'];
	echo "<br/>";
  echo "NÚMERO DE CELULAR: " . $row['celular'];
  echo "<br/>";
  echo "CORREO ELECTRÓNICO: " . $row['email'];
  echo "<br/>";
  echo "FECHA DE NACIMIENTO: " . $row['nacimiento'];
  echo "<br/>";
}

if(isset($_POST['submit'])){
session_destroy();
unset($_SESSION['usuario']);
unset($_SESSION['isLogged']);
unset($_SESSION['rol']);
}

echo "<br/>";

echo "FECHA ACTUAL:"."   ";
date_default_timezone_set('America/Costa_Rica');
echo $date = date('d/m/Y', time());
echo "</br>";
echo "HORA ACTUAL:"."   ";
echo $time = date('h:i:s a', time());

echo "<br/>";
?>
</body>
</html>