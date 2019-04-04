<?php 

require_once 'config.php';

if($_POST) {
	$editorial = $_POST['editorial'];

	$sql = "CALL sp_incre10('$editorial')";
		echo "<p>Precios incrementados en un 10%!!</p>";
		echo "<a href='incre_10.php'><button type='button'>Volver</button></a>";

}

?>