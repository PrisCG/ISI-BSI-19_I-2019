<?php

require_once "config.php";

$usuario = $password = "";

if (isset($_POST['usuario'])) {
	$usuario = $_POST['usuario'];
}

if (isset($_POST['password'])) {
	$password = $_POST['password'];
}

$result = mysqli_query($link, "SELECT * from empleado where usuario='" . $usuario . "'");
	
if($row = mysqli_fetch_array($result)){
	if($row['password'] == $password){
		session_start();
		$_SESSION['usuario'] = $usuario;
		if ($row['idrol'] == 0) {
			$_SESSION['isLogged'] = 1;
			$_SESSION['rol'] = 0;
			header("Location: menu1.php");
		}
		elseif($row['idrol'] == 1){
			$_SESSION['isLogged'] = 1;
			$_SESSION['rol'] = 1;
			header("Location: menu2.php");
		}
	}else{
		header("Location: index.php");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Login</title></head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
<body>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>LOGIN</h2>
                    </div>
<div>
<center>
<form method="POST" action="login.php">
<input type="text" name="usuario" placeholder="Usuario" class="form-control" />
<br />
<input type="password" name="password" placeholder="Contraseña" class="form-control" />
<br />
<button name="submit" type="submit" class="btn btn-primary">Iniciar Sesion</button>
<a href="index.php" class="btn btn-default">Inicio</a>
</form>
</center>
</div>
</div>
</div>
</div>
</div>
</body>
</html>