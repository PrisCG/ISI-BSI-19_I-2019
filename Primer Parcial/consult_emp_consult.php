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

	$where = $nombreempleado = $estado = $sql = "";

	$where="emp.nombre like '".$nombreempleado."%' and emp.idestado='0' or emp.idestado='1'";

	if (isset($_POST['buscar'])){

		$nombreempleado = $_POST["nombreempleado"];
		$estado = $_POST["estado"];

		if (!empty($_POST['nombreempleado']))
		{
			$where="emp.nombre like '".$nombreempleado."%'";
		}
		else if (!empty($_POST['estado']))
		{
			$where="emp.idestado='".$estado."'";
		}
		else
		{
			$where="emp.nombre like '".$nombreempleado."%' and emp.idestado='".$estado."'";
		}
	}

	$sql = "SELECT emp.nombre as Nombre, 
	               emp.apellido as Apellido, 
	               emp.cedula as Cedula,
	               est.nombreestado as Estado
			FROM empleado emp
				INNER JOIN estado est ON est.idestado = emp.idestado 
			WHERE $where";

    $sentenciaEstado = "SELECT * FROM estado";

	$resultEstado = $link->query($sentenciaEstado);

	if($result = mysqli_query($link, $sql)){
    	if(mysqli_num_rows($result) == 0){
			$mensaje = "<h1> No se han encontrado resultados </h1>";
		}
	}
?>

<html lang="es">

	<head>
		<title>Búsqueda de empleados (Actividad de la cuenta)</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    	<script type="text/javascript" src="bootstrap.min.css"></script>
  		<link rel="stylesheet" type="text/css" href="bootstrap.css">
	</head>
	<body>
		<header>
			<div class="alert alert-info">
				<h2>Filtro de Búsqueda PHP</h2>
			</div>
		</header>
		<section>
			<form method="post">
				<input type="text" placeholder="Nombre del empleado" name="nombreempleado"/>
				<select name="estado">
					<option>Estado</option>
					<?php while ($row = mysqli_fetch_array($resultEstado)):;?>
					<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
					<?php endwhile; ?>
				</select>
				<button name="buscar" type="submit">Buscar</button>
			</form>
			<table class="table">
				<tr>
					<th>Nombre</th>
					<th>Cedula</th>
					<th>Estado</th>
				</tr>

				<?php 
					while ($row = mysqli_fetch_array($result)){
						echo"<tbody>";
			            echo"<tr>";
			            echo"<td>".$row['Nombre']. " ".$row['Apellido']."</td>";
			            echo"<td>".$row['Cedula']."</td>";
			            echo"<td>".$row['Estado']."</td>";
			            echo"</tr>";
			            echo"</tbody>";
					}
				?>
			</table>
			<?
				echo $mensaje;
			?>
		</section>
		<a href="consultas_consult.php" class="btn btn-success pull-right">Volver</a>
	</body>
</html>