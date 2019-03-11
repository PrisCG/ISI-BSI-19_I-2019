<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DEPARTAMENTOS</title>
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
                        <h2 class="pull-left">INFORMACIÓN DE LOS DEPARTAMENTOS</h2>
                        <a href="crear_departamento.php" class="btn btn-success pull-right">Agregar un nuevo departamento</a>
                    </div>
                    <?php
                    
                    require_once "config.php";
                    
                    
                    $sql = "SELECT * FROM departamento";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Descripción</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['iddepartamento'] . "</td>";
                                        echo "<td>" . $row['nombredepartamento'] . "</td>";
                                        echo "<td>" . $row['descripcion'] . "</td>";
                                        echo "<td>";

                                            echo "<a href='ver_dep_gestor.php?iddepartamento=". $row['iddepartamento'] ."' title='Ver información' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";

                                            echo "<a href='editar_departamento.php?iddepartamento=". $row['iddepartamento'] ."' title='Editar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";

                                            echo "<a href='eliminar_departamento.php?iddepartamento=". $row['iddepartamento'] ."' title='Eliminar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registros de departamentos</em></p>";
                        }
                    } else{
                        echo "ERROR " . mysqli_error($link);
                    }
 
                    
                    mysqli_close($link);
                    ?>
                    <a href="menu1.php" class="btn btn-success pull-right">Volver</a>
                </div>

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
    header("location: departamento_consult.php");
    exit();
}
?>