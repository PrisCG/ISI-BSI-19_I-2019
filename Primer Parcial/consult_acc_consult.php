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

	$where = $inicio = $hoy = $tipo = $sql = "";
	if (isset($_POST['buscar'])){

		$inicio = $_POST["fechainicio"];
		$tipo = $_POST["tipo"];

		if (!empty($_POST['fechainicio']))
		{
			$where="WHERE acc.fechainicio = '".$inicio."%'";
		}
		else if (!empty($_POST['tipo']))
		{	
			$where="WHERE acc.idtipo = '".$tipo."%'";
		}
		else
		{
			$where="WHERE acc.fechainicio = '".$inicio."%' AND acc.idtipo='".$tipo."'";
		}
	}

	$sql = "SELECT acc.creacion as Creacion,
				   acc.fechainicio as Fecha_Inicio,
				   acc.fechafinal as Fecha_Final,
	               tip.nombretipo as Tipo,
	               acc.observaciones as Observacion
			FROM acciones acc
				INNER JOIN tipos tip ON tip.idtipo = acc.idtipo 
			$where";

    $senteciaTipo = "SELECT * FROM tipos";

	$resultTipo = $link->query($senteciaTipo);

	if($result = mysqli_query($link, $sql)){
    	if(mysqli_num_rows($result) < 1){
			$mensaje = "<h1> No se han encontrado resultados</h1>";
		}
	}
?>

<html lang="es">

	<head>
		<title>Búsqueda de empleados (Tipo de acción)</title>
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
				<input type="date" placeholder="Fecha de inicio" name="fechainicio"/>
				<select name="tipo">
					<option value="">Tipo de acción</option>
					<?php while ($row = mysqli_fetch_array($resultTipo)):;?>
					<option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
					<?php endwhile; ?>
				</select>
				<button name="buscar" type="submit">Buscar</button>
			</form>
			<table class="table">
				<tr>
					<th>Fecha de creación</th>
					<th>Fecha de inicio</th>
					<th>Fecha final</th>
					<th>Tipo de acción</th>
					<th>Observación</th>
				</tr>

				<?php 
					while ($row = mysqli_fetch_array($result)){
						echo"<tbody>";
			            echo"<tr>";
			            echo"<td>".$row['Creacion']."</td>";
			            echo"<td>".$row['Fecha_Inicio']."</td>";
			            echo"<td>".$row['Fecha_Final']."</td>";
			            echo"<td>".$row['Tipo']."</td>";
			            echo"<td>".$row['Observacion']."</td>";
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