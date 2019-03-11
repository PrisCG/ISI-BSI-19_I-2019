<?php
//Config file
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
else if($_SESSION['rol'] == 1){
    header("location: acciones_consult.php");
    exit();
}

$est_date = $idtipo = $fechainicio = $fechafinal = $observaciones = $fi = $ff = "";

$query = "SELECT * FROM  tipos";
$result1 = mysqli_query($link, $query);

//------------------------------------------------------//

date_default_timezone_set('America/Costa_Rica');
$creacion = date('Y-m-d h:i:s a', time());

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST["submit"])) {
        $idtipo = $_POST["tipos"];
        $fi = strtotime($_POST["fechainicio"]);
        $ff = strtotime($_POST["fechafinal"]);
        $fechainicio = date('Y-m-d', $fi);
        $fechafinal = date('Y-m-d', $ff);
        $observaciones = $_POST["observaciones"];
    }


    $sqlquery = "INSERT INTO acciones (creacion, idtipo, fechainicio, fechafinal, observaciones) VALUES (?,?,?,?,?)";

    if($stmt = mysqli_prepare($link, $sqlquery)){
        
        mysqli_stmt_bind_param($stmt, "sssss", $param_creacion, $param_idtipo, $param_fechainicio, $param_fechafinal, $param_observaciones);
        
        $param_creacion = $creacion;
        $param_idtipo = $idtipo;
        $param_fechainicio = $fechainicio;
        $param_fechafinal = $fechafinal;
        $param_observaciones = $observaciones;

        if(mysqli_stmt_execute($stmt)){
            //En caso de realizarse correctamente hacer:
            header("location: acciones_gestor.php");
        } else{
            echo "ERROR";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CREAR ACCIÓN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Crear acción</h2>
                    </div>
                    <p>Formulario para crear una nueva acción</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Fecha de creacion</label>
                            <p><?php echo $creacion; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Tipo de accion</label>
                            <select name="tipos" class="form-control">
                                <?php while ($row = mysqli_fetch_array($result1)):;?>
                                <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Fecha de inicio</label>
                            <input name="fechainicio" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Fecha final</label>
                            <input name="fechafinal" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control"></textarea>
                        </div>

                        <input name="submit" type="submit" class="btn btn-primary" value="Crear">
                        <a href="acciones_gestor.php" class="btn btn-default">Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
