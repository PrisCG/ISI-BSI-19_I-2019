<?php

require_once "config.php";
 
$nombre = $apellido = $cedula = "";
$nombre_err = $apellido_err = $cedula_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // VALIDAR NOMBRE
    $input_nombre  = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Ingrese su nombre.";
    } elseif(!filter_var($input_nombre , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Nombre inválido.";
    } else{
        $nombre  = $input_nombre;
    }
    
    // VALIDAR APELLIDO
    $input_apellido  = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Ingrese su apellido.";
    } elseif(!filter_var($input_apellido , FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $apellido_err = "Apellido inválido.";
    } else{
        $apellido  = $input_apellido;
    }
    
    // VALIDAR CÉDULA
    $input_cedula = trim($_POST["cedula"]);
    if(empty($input_cedula)){
        $cedula_err = "Ingrese su número de cédula.";     
    } elseif(!ctype_digit($input_cedula)){
        $cedula_err = "Número de cédula inválido";
    } else{
        $cedula = $input_cedula;
    }
    
    
    if(empty($nombre_err) && empty($apellido_err) && empty($cedula_err)){
        
        $sql = "INSERT INTO form (nombre, apellido, cedula) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_apellido, $param_cedula);
            
            
            $param_nombre= $nombre;
            $param_apellido = $apellido;
            $param_cedula = $cedula;
            
           
            if(mysqli_stmt_execute($stmt)){
               
                header("location: index.php");
                exit();
            } else{
                echo "ERROR";
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
    <title>REGISTRO</title>
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
                        <h2>CREAR UN NUEVO REGISTRO</h2>
                    </div>
                    <p>Completar el siguiente formulario</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" minlength="3" maxlength="15" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
                            <label>Apellido</label>
                            <input type="text" name="apellido" class="form-control" minlength="3" maxlength="15" value="<?php echo $apellido; ?>">
                            <span class="help-block"><?php echo $apellido_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($cedula_err)) ? 'has-error' : ''; ?>">
                            <label>Cédula</label>
                            <input type="text" name="cedula" class="form-control" minlength="9" maxlength="9" value="<?php echo $cedula; ?>">
                            <span class="help-block"><?php echo $cedula_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                        <a href="index.php" class="btn btn-default">Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>