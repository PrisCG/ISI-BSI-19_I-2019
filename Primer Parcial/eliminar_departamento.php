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
        header("location: departamento_consult.php");
        exit();
    }

if(isset($_POST["iddepartamento"]) && !empty($_POST["iddepartamento"])){
    
    
    
    
    $sql = "DELETE FROM departamento WHERE iddepartamento = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_iddepartamento);
        
        
        $param_iddepartamento = trim($_POST["iddepartamento"]);
        
        
        if(mysqli_stmt_execute($stmt)){
            
            header("location: departamento_gestor.php");
            exit();
        } else{
            echo "ERROR.";
        }
    }
     
    
    mysqli_stmt_close($stmt);
    
    
    mysqli_close($link);
} else{
    
    if(empty(trim($_GET["iddepartamento"]))){
        
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ELIMINAR INFORMACIÓN DEPARTAMENTO</title>
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
                        <h1>Eliminar información de departamento</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="iddepartamento" value="<?php echo trim($_GET["iddepartamento"]); ?>"/>
                            <p>¿Está seguro de eliminar la información?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="departamento_gestor.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>