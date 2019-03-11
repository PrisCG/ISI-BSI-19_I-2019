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
else if($_SESSION['rol'] == 1){
    header("location: acciones_consult.php");
    exit();
}

$nombretipo = $idtipo = $fechainicio = $fechafinal = $observaciones = $idacciones = "";

$query = "SELECT * FROM  tipos";
$result1 = mysqli_query($link, $query);

if(isset($_POST["idacciones"]) && !empty($_POST["idacciones"])){
    
    $idacciones = $_POST["idacciones"];
   
    $sql = "UPDATE acciones SET idtipo = ?, fechainicio = ?, fechafinal = ?, observaciones = ?  WHERE idacciones=?";
         
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "isssi", $param_idtipo, $param_fechainicio, $param_fechafinal, $param_observaciones, $param_idacciones);
                
        $param_idtipo = $idtipo;
        $param_fechainicio = $fechainicio;
        $param_fechafinal = $fechafinal;
        $param_observaciones = $observaciones;
        $param_idacciones = $idacciones;       
        
        if(mysqli_stmt_execute($stmt)){
            header("location: acciones_gestor.php");
            exit();
        } else{
            echo "ERROR.";
        }
         mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    
    if(isset($_GET["idacciones"]) && !empty(trim($_GET["idacciones"]))){
        
        $id =  trim($_GET["idacciones"]);
                
        $sql = "SELECT acciones.idtipo as IdTipo,
        			   tipo.nombretipo as NombreTipo, 
        			   acciones.fechainicio as FechaInicio, 
        			   acciones.fechafinal as FechaFinal, 
        			   acciones.observaciones as Observaciones 
			    FROM acciones acciones 
			    	INNER JOIN tipo tipo ON tipo.idtipo = acciones.idtipo 
		    	WHERE acciones.idacciones = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_idacciones);
            
    
            $param_idacciones = $idacciones;
        
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
	                $idtipo = $row["IdTipo"];
	                $nombretipo = $row["NombreTipo"];
	                $fechainicio = $row["FechaInicio"];
	                $fechafinal = $row["FechaFinal"];
	                $observaciones = $row["Observaciones"];
                } else{
                    header("location: error.php");
                    exit();
                }
            } else{
                echo "ERROR";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar información de trabajadores</title>
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
                        <h2>Actualizar información</h2>
                    </div>
                    <p>Debe llenar todos los campos.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="idacciones" value="<?php echo $idacciones; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="acciones_gestor.php" class="btn btn-default">Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>