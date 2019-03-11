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
        header("location: empleado_consult.php");
        exit();
    }

if(isset($_POST["id"]) && !empty($_POST["id"])){
  
    
    
   
    $sql = "DELETE FROM empleado WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        
        $param_id = trim($_POST["id"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            
            header("location: empleados_gestor.php");
            exit();
        } else{
            echo "ERROR";
        }
    }
     
   
    mysqli_stmt_close($stmt);
    
   
    mysqli_close($link);
} else{
   
    if(empty(trim($_GET["id"]))){
        
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ELIMINAR EMPLEADOS</title>
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
                        <h1>ELIMINAR INFORMACIÓN</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>¿Está seguro de eliminar la información?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="empleados_gestor.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>