<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    
    $sql = "SELECT * FROM form WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_GET["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                
                $nombre = $row["nombre"];
                $apellido = $row["apellido"];
                $cedula = $row["cedula"];
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
    <title>VER INFORMACIÓN</title>
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
                        <h1>Ver Información</h1>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <p class="form-control-static"><?php echo $row["apellido"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Cédula</label>
                        <p class="form-control-static"><?php echo $row["cedula"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>