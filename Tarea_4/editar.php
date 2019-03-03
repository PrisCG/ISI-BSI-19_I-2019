<?php

if(isset($_GET['editar'])){
	$editar_id = $_GET['editar'];

	$consulta = "SELECT * FROM usuarios WHERE id='$editar_id'";
	$ejecutar = mysqli_query($con, $consulta);

	$fila = mysqli_fetch_array($ejecutar);

	$nombre = $fila['nombre'];
	$apellido = $fila['apellido'];
	$email = $fila['email'];
	$password = $fila['password'];
}

?>

<br  />
<form method="POST" action="">
<input type="text" name="nombre" value="<?php echo $nombre; ?>"> <br/>
<input type="text" name="apellido" value="<?php echo $apellido; ?>"/><br/>
<input type="email" name="email" value="<?php echo $email; ?>"/><br/>
<input type="password" name="password" value="<?php echo $password; ?>"/> <br/>
<input type="submit" name="actualizar" value="Actualizar">
</form>

<?php
if(isset($_POST['actualizar'])){
$actualizar_nombre = $_POST['nombre'];
$actualizar_apellido = $_POST['apellido'];
$actualizar_email = $_POST['email'];
$actualizar_password = $_POST['password'];

$actualizar = "UPDATE usuarios SET nombre ='$actualizar_nombre', apellido='$actualizar_apellido', email='$actualizar_email ', password='$actualizar_password' WHERE id='$editar_id'";

$ejecutar = mysqli_query($con, $actualizar);

if($ejecutar){
	echo "<script>alert('Datos actualizados')</script>";
	echo "<script>window.open('formulario.php')</script>";
}
}
?>