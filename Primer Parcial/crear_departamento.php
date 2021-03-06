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

$nombredepartamento = $descripcion =  "";
$nombredepartamento_err = $descripcion_err =  "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //VALIDAR NOMBRE DEL DEPARTAMENTO
    $input_nombredepartamento = trim($_POST["nombredepartamento"]);
    if(empty($input_nombredepartamento)){
        $nombredepartamento_err = "Ingrese el nombre del departamento";
    } elseif(!filter_var($input_nombredepartamento, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombredepartamento_err = "Nombre de departamento inválido";
    } else{
        $nombredepartamento = $input_nombredepartamento;
    }
    
    //VALIDAR DESCRIPCIÓN
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Ingrese la descripción del departamento.";     
    } else{
        $descripcion = $input_descripcion;
    }
    
    
    
    if(empty($nombredepartamento_err) && empty($descripcion_err)){
        
        $sql = "INSERT INTO departamento (nombredepartamento, descripcion) VALUES ( ? , ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_nombredepartamento, $param_descripcion);
            
            
            $param_nombredepartamento = $nombredepartamento;
            $param_descripcion = $descripcion;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: departamento_gestor.php");
                exit();
            } else{
                echo "ERROR.";
            }
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
    <title>REGISTRO DEPARTAMENTO</title>
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
                        <h2>NUEVO REGISTRO DE DEPARTAMENTO</h2>
                    </div>
                    <p>Por favor llenar todos los campos del formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($nombredepartamento_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre del departamento:</label>
                            <input type="text" name="nombredepartamento" class="form-control" value="<?php echo $nombredepartamento; ?>">
                            <span class="help-block"><?php echo $nombredepartamento_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>Descripción del departamento</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
                            <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <a href="departamento_gestor.php" class="btn btn-default">Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>