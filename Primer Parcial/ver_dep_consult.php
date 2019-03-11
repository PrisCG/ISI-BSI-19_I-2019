<?php
require_once "config.php";

if(isset($_GET["iddepartamento"]) && !empty(trim($_GET["iddepartamento"]))){
       
    $sql = "SELECT * FROM departamento WHERE iddepartamento = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_iddepartamento);
               
        $param_iddepartamento = trim($_GET["iddepartamento"]);
                
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                
                $nombredepartamento = $row["nombredepartamento"];
                $descripcion = $row["descripcion"];
            } else{
                header("location: error.php");
                exit();
            }
        } else{
            echo "ERROR";
        }
    }
     
   
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VER INFORMACIÓN DEPARTAMENTO</title>
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
                        <h1>Ver información del departamento</h1>
                    </div>
                    <div class="form-group">
                        <label>Nombre del departamento</label>
                        <p class="form-control-static"><?php echo $row["nombredepartamento"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <p class="form-control-static"><?php echo $row["descripcion"]; ?></p>
                    </div>
                    <p><a href="departamento_consult.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>