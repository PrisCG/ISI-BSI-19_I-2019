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

	$where = $nombreempleado = $departamento = $sql = "";

	$where="emp.nombre like '".$nombreempleado."%'";
	if (isset($_POST['buscar'])){

		$nombreempleado = $_POST["nombreempleado"];
		$departamento = $_POST["departamento"];

		if (!empty($_POST['nombreempleado']))
		{
			$where="emp.nombre LIKE '".$nombreempleado."%'";
		}
		else if (!empty($_POST['departamento']))
		{
			$where="emp.iddepartamento='".$departamento."'";
		}
		else
		{
			$where="emp.nombre LIKE '".$nombreempleado."%' AND emp.iddepartamento='".$departamento."'";
		}
	}

	$sql = "SELECT emp.nombre as Nombre, 
	               emp.apellido as Apellido, 
	               emp.cedula as Cedula,
	               dep.nombredepartamento as Departamento
			FROM empleado emp
				INNER JOIN departamento dep ON dep.iddepartamento = emp.iddepartamento 
			WHERE $where";

    $sentenciaDepartamento = "SELECT * FROM departamento";

	$resultDepartamento = $link->query($sentenciaDepartamento);

	if($result = mysqli_query($link, $sql)){
    	if(mysqli_num_rows($result) == 0){
			$mensaje = "<h1> No se han encontrado resultados</h1>";
		}
	}
?>

<html lang="es">

	<head>
		<title>Búsqueda de empleados (Departamento)</title>
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
				<select name="departamento">
					<option>Departamento</option>
					<?php while ($row = mysqli_fetch_array($resultDepartamento)):;?>
					<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
					<?php endwhile; ?>
				</select>
				<button name="buscar" type="submit">Buscar</button>
			</form>
			<table class="table">
				<tr>
					<th>Nombre</th>
					<th>Cedula</th>
					<th>Departamento</th>
				</tr>

				<?php 
					while ($row = mysqli_fetch_array($result)){
						echo"<tbody>";
			            echo"<tr>";
			            echo"<td>".$row['Nombre']. " ".$row['Apellido']."</td>";
			            echo"<td>".$row['Cedula']."</td>";
			            echo"<td>".$row['Departamento']."</td>";
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