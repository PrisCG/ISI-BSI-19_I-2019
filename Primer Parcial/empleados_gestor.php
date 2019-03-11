<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMPLEADOS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Información Empleados</h2>
                        <a href="crear_empleado.php" class="btn btn-success pull-right">Agregar un nuevo empleado</a>
                    </div>
                    <?php
                    
                    require_once "config.php";
                    
                    
                    $sql = "SELECT * FROM empleado";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Apellido</th>";
                                        echo "<th>Cédula</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['apellido'] . "</td>";
                                        echo "<td>" . $row['cedula'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='ver_emp_gestor.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='editar_empleado.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='eliminar_empleado.php?id=". $row['id'] ."' title='Eliminar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registro de empleados.</em></p>";
                        }
                    } else{
                        echo "ERROR " . mysqli_error($link);
                    }
 
                    
                    mysqli_close($link);
                    ?>
                </div>
                <a href="menu1.php" class="btn btn-success pull-right">Volver</a>
            </div>        
        </div>
    </div>
</body>
</html>
<?php 
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
    header("location: empleados_consult.php");
    exit();
}
?>