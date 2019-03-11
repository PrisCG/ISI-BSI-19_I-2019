<?php

if(isset($_GET["idacciones"]) && !empty(trim($_GET["idacciones"]))){
    $idacciones = $_GET["idacciones"];
    require_once "config.php";

    $sentencia = "SELECT acciones.creacion as Creacion,
                         tipos.nombretipo as Tipo,
                         acciones.fechainicio as Fecha_Inicio,
                         acciones.fechafinal as Fecha_Final,
                         acciones.observaciones as Observaciones 
                  FROM acciones acciones
                    INNER JOIN tipos tipos ON tipos.idtipo = acciones.idtipo
                    WHERE acciones.idacciones = '$idacciones'";

    $sqlquery = mysqli_query($link, $sentencia);
    if (!$sqlquery) {
         echo("Error: %s\n" . mysqli_error($link));
    }
} else{
    
    header("location: error.php");
    exit();
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VER INFORMACIÓN DEL EMPLEADO</title>
     <script type="text/javascript" src="bootstrap.min.css"></script>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
    <div class="page-header">
        <h1>Información de acciones</h1>
    </div>
    <table class="table table-hover">
     <thead>
        <tr class="table-primary">
          <th scope="col">Fecha y hora de creación</th>
          <th scope="col">Tipo de acción</th>
          <th scope="col">Fecha de Inicio</th>
          <th scope="col">Fecha Final</th>
          <th scope="col">Observaciones</th>
        </tr>
      </thead>
    <?php
    if(isset($_GET["idacciones"]) && !empty(trim($_GET["idacciones"]))){
        while ($dato=mysqli_fetch_array($sqlquery))
        { 
            
            echo"<tbody>";
            echo"<tr>";
            echo"<td>".$dato['Creacion']."</td>";
            echo"<td>".$dato['Tipo']."</td>";
            echo"<td>".$dato['Fecha_Inicio']."</td>";
            echo"<td>".$dato['Fecha_Final']."</td>";
            echo"<td>".$dato['Observaciones']."</td>";
            echo"</tr>";
            echo"  </tbody>";
        }
    }
    ?>
     
    </table>
    <p><a href="acciones_gestor.php" class="btn btn-info">Volver</a></p>
</body>
</html>
