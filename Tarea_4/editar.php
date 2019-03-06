<?php

require_once "config.php";
 

$nombre = $apellido = $cedula = "";
$nombre_err = $apellido_err = $cedula_err = "";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    
    //VALIDAR NOMBRE
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
        
        $sql = "UPDATE form SET nombre=?, apellido=?, cedula=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "sssi", $param_nombre, $param_apellido, $param_cedula, $param_id);
            
            
            $param_nombre= $nombre;
            $param_apellido = $apellido;
            $param_cedula = $cedula;
            $param_id = $id;
            
            
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
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM form WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            
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
    <title>ACTUALIZAR</title>
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
                    <p>Puede editar la información que desee, todos los campos deben estar llenos.</p>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

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
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-default">Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>