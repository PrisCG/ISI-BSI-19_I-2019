<!DOCTYPE html>
<meta charset="UTF-8">

<?php

$con = mysqli_connect("localhost", "root", "","Tarea4") or die ("ERROR EN LA CONEXIÓN DE LA BASE DE DATOS");

?>

<html>
<head> <title>TAREA #4</title>
	<meta charset="UTF-8">
 </head>
 <body>
 	<form method="POST" action="formulario.php">
 		<label>Id:</label>
 		<input type="text" name="id" placeholder="Identificación" minlength="9" maxlength="9"> <br/>

 		<br/><label>Nombre:</label>
 		<input type="text" name="nombre" placeholder="Nombre" minlength="3" maxlength="20"> <br/>

 		<br/><label>Apellido:</label>
 		<input type="text" name="apellido" placeholder="Apellido" minlength="3" maxlength="20"> <br/>

 		<br/><label>Email:</label>
 		<input type="email" name="email" placeholder="Email" minlength="5" maxlength="30"> <br/>

 		<br/><label>Contraseña:</label>
 		<input type="password" name="password" placeholder="Contraseña" minlength="3" maxlength="10"> <br/>

 		<br/><input type="submit" name="insertar" value="Insertar">

 </body>
</html>

<?php

if(isset($_POST['insertar'])){
	$id = $_POST['id'];
	$nom = $_POST['nombre'];
	$ape = $_POST['apellido'];
	$email = $_POST['email'];
	$pass = $_POST['password'];

	$insertar = "INSERT INTO usuarios (id,nombre,apellido,email,password) VALUES ('$id','$nom','$ape','$email','$pass')";

	$ejecutar = mysqli_query($con, $insertar);

	if($ejecutar){
		echo "<h3> INSERTADO CORRECTAMENTE </h3>";
	}
}
?>

<br/>

<table width="500" border="2" style="background-color: #F9F9F9;">
	<tr>
		<th> Id </th>
		<th> Nombre </th>
		<th> Apellido </th>
		<th> Email </th>
		<th> Password </th>
		<th> Editar </th>
		<th> Eliminar </th>
	</tr>

	<?php

	$consulta = "SELECT * FROM usuarios";

	$ejecutar = mysqli_query($con, $consulta);

	$i = 0;

	while($fila = mysqli_fetch_array($ejecutar)){
		$id = $fila['id'];
		$nombre = $fila['nombre'];
		$apellido = $fila['apellido'];
		$email = $fila['email'];
		$password = $fila['password'];

		$i++;
	?>

	<tr align="center">
		<td><?php echo $id; ?></td>
		<td><?php echo $nombre; ?></td>
		<td><?php echo $apellido; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $password; ?></td>
		<td><a href="formulario.php?editar=<?php echo $id; ?>">Editar</a></td>
		<td><a href="formulario.php?eliminar=<?php echo $id;?>">Eliminar</a></td>
		</tr>

	<?php } ?>

</table>

<?php

if(isset($_GET['editar'])){
	include("editar.php");
}

?>

<?php
if(isset($_GET['eliminar'])){
	$eliminar_id = $_GET['eliminar'];

	$eliminar = "DELETE FROM usuarios WHERE id='$eliminar_id'";
	$ejecutar = mysqli_query($con, $eliminar);

	if($ejecutar){
		echo "<script>alert('Datos eliminados')</script>";
	echo "<script>window.open('formulario.php')</script>";
	}
}
?>