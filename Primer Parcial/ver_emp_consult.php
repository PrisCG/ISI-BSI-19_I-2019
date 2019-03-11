<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $id = $_GET["id"];
    require_once "config.php";

    $sentencia = "SELECT empleado.nombre as Nombre, 
                         empleado.apellido as Apellido, 
                         empleado.cedula as Cedula,
                         nacionalidad.nombrenacionalidad as Nacionalidad,
                         provincia.nombreprovincia as Provincia,
                         canton.nombrecanton as Canton,
                         distrito.nombredistrito as Distrito,
                         empleado.direccion as Direccion,
                         empleado.telefono as Telefono,
                         empleado.celular as Celular,
                         empleado.email as Email,
                         estudio.nombreestudio as Estudio,
                         empleado.nacimiento as Fech_de_Nacimiento,
                         departamento.nombredepartamento as Departamento,
                         empleado.puesto as Puesto,
                         empleado.banco as Banco,
                         empleado.bancaria as Cuenta,
                         estado.nombreestado as Estado,
                         empleado.usuario as Usuario,
                         roles.nombreroles as Rol
                  FROM empleado empleado
                    INNER JOIN provincia provincia ON provincia.idprovincia = empleado.idprovincia 
                    INNER JOIN nacionalidad nacionalidad ON nacionalidad.idnacionalidad = empleado.idnacionalidad 
                    INNER JOIN canton canton ON canton.idcanton = empleado.idcanton 
                    INNER JOIN distrito distrito ON distrito.iddistrito = empleado.iddistrito 
                    INNER JOIN estudio estudio ON estudio.idestudio = empleado.idestudio 
                    INNER JOIN departamento departamento ON departamento.iddepartamento = empleado.iddepartamento 
                    INNER JOIN estado estado ON estado.idestado = empleado.idestado 
                    INNER JOIN roles roles ON roles.idrol = empleado.idrol 
                    WHERE empleado.id = '$id'";

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
                        <h1>Información de empleado</h1>
                    </div>
    <table class="table table-hover">
     <thead>
        <tr class="table-primary">
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Cédula</th>
          <th scope="col">Nacionalidad</th>
          <th scope="col">Provincia</th>
          <th scope="col">Cantón</th>
          <th scope="col">Distrito</th>
          <th scope="col">Dirección</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Celular</th>
          <th scope="col">Email</th>
          <th scope="col">Estudio</th>
          <th scope="col">Fecha de nacimiento</th>
          <th scope="col">Departamento</th>
          <th scope="col">Puesto</th>
          <th scope="col">Banco</th>
          <th scope="col">Bancaria</th>
          <th scope="col">Estado</th>
          <th scope="col">Usuario</th>
          <th scope="col">Rol</th>
        </tr>
      </thead>
    <?php
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        while ($dato=mysqli_fetch_array($sqlquery))
        { 
            
            echo"<tbody>";
            echo"<tr>";
            echo"<td>".$dato['Nombre']."</td>";
            echo"<td>".$dato['Apellido']."</td>";
            echo"<td>".$dato['Cedula']."</td>";
            echo"<td>".$dato['Nacionalidad']."</td>";
            echo"<td>".$dato['Provincia']."</td>";
            echo"<td>".$dato['Canton']."</td>";
            echo"<td>".$dato['Distrito']."</td>";
            echo"<td>".$dato['Direccion']."</td>";
            echo"<td>".$dato['Telefono']."</td>";
            echo"<td>".$dato['Celular']."</td>";
            echo"<td>".$dato['Email']."</td>";
            echo"<td>".$dato['Estudio']."</td>";
            echo"<td>".$dato['Fech_de_Nacimiento']."</td>";
            echo"<td>".$dato['Departamento']."</td>";
            echo"<td>".$dato['Puesto']."</td>";
            echo"<td>".$dato['Banco']."</td>";
            echo"<td>".$dato['Cuenta']."</td>";
            echo"<td>".$dato['Estado']."</td>";
            echo"<td>".$dato['Usuario']."</td>";
            echo"<td>".$dato['Rol']."</td>";
            echo"</tr>";
            echo"  </tbody>";
        }
    }
    ?>
     
    </table>
    <p><a href="empleados_consult.php" class="btn btn-info">Volver</a></p>
</body>
</html>
