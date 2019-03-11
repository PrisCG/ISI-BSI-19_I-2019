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

$nombre = $apellido = $cedula =$direccion = $telefono = $celular =$email=$puesto = $banco= $bancaria=$usuario ="";
$nombre_err = $apellido_err = $cedula_err= $direccion_err = $telefono_err = $celular_err = $email_err = $puesto_err= $banco_err= $bancaria_err=$usuario_err ="";
 

if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    $id = $_POST["id"];
    

    // VALIDAR NOMBRE
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Ingrese su nombre";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Nombre inválido";
    } else{
        $nombre = $input_nombre;
    }

    //VALIDAR APELLIDO
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Ingrese su apellido";
    } elseif(!filter_var($input_apellido, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZÑñ\s]+$/")))){
        $apellido_err = "Apellido inválido";
    } else{
        $apellido = $input_apellido;
    }

      // VALIDAR CÉDULA
    $input_cedula = trim($_POST["cedula"]);
    if(empty($input_cedula)){
        $cedula_err = "Ingrese su número de cédula";     
    } elseif(!ctype_digit($input_cedula)){
        $cedula_err = "Número de cédula inválido";
    } else{
        $cedula = $input_cedula;
    }

     // VALIDAR DIRECCIÓN
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Ingrese su dirección";     
    } else{
        $direccion = $input_direccion;
    }

    //VALIDAR NÚMERO DE TELÉFONO
    $input_telefono= trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Ingrese su número de teléfono";     
    } elseif(!ctype_digit($input_telefono)){
        $telefono_err = "Número de teléfono inválido";
    } else{
        $telefono = $input_telefono;
    }

    //VALIDAR NÚMERO DE CELULAR
    $input_celular= trim($_POST["celular"]);
    if(empty($input_celular)){
        $celular_err = "Ingrese su número de celular";     
    } elseif(!ctype_digit($input_celular)){
        $celular_err = "Número de celular inválido";
    } else{
        $celular = $input_celular;
    }

    //VALIDAR EMAIL
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Ingrese su correo electrónico";
    } elseif(!filter_var($input_email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/")))){
        $email_err = "Correo electrónico válido";
    } else{
        $email = $input_email;
    }


     // VALIDAR OCUPACIÓN
    $input_puesto = trim($_POST["puesto"]);
    if(empty($input_puesto)){
        $puesto_err = "Ingrese su puesto";
    } elseif(!filter_var($input_puesto, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $puesto_err = "Ocupación inválida";
    } else{
        $puesto = $input_puesto;
    }

    // VALIDAR BANCO
    $input_banco = trim($_POST["banco"]);
    if(empty($input_banco)){
        $banco_err = "Ingrese el nombre del banco";
    } elseif(!filter_var($input_banco, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $banco_err = "Banco inválido";
    } else{
        $banco = $input_banco;
    }

     // VALIDAR CUENTA BANCARIA
    $input_bancaria= trim($_POST["bancaria"]);
    if(empty($input_bancaria)){
        $bancaria_err = "Ingrese su número de cuenta bancaria";     
    } elseif(!ctype_digit($input_bancaria)){
        $bancaria_err = "Número de cuenta bancaria inválido";
    } else{
        $bancaria = $input_bancaria;
    }

     //VALIDAR NOMBRE DE USUARIO
    $input_usuario = trim($_POST["usuario"]);
    if(empty($input_usuario)){
        $usuario_err = "Ingrese un nombre de usuario";
    } elseif(!filter_var($input_usuario, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")))){
        $usuario_err = "Nombre de usuario inválido";
    } else{
        $usuario = $input_usuario;
    }

    
    if(empty($nombre_err) && empty($apellido_err) && empty($cedula_err) && empty($direccion_err) && empty($telefono_err) &&empty($celular_err) &&empty($email_err) && empty($puesto_err) && empty($banco_err) && empty($bancaria_err) && empty($usuario_err)){
        
        $sql = "UPDATE empleado SET nombre=?, apellido=?, cedula=?, direccion=?, telefono=?, celular=?, email=?,puesto=?, banco=?, bancaria=?, usuario=?  WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssssssssssi", $param_nombre,$param_apellido,$param_cedula,$param_direccion,$param_telefono,$param_celular,$param_email,$param_puesto,$param_banco,$param_bancaria,$param_usuario , $param_id);
            
            
            $param_nombre= $nombre;
            $param_apellido = $apellido;
            $param_cedula = $cedula;
            $param_direccion = $direccion;
            $param_telefono = $telefono;
            $param_celular = $celular;
            $param_email = $email;
            $param_puesto = $puesto;
            $param_banco = $banco;
            $param_bancaria = $bancaria;
            $param_usuario = $usuario;     
            $param_id = $id;       
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: empleados_gestor.php");
                exit();
            } else{
                echo "ERROR.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
                
        $sql = "SELECT nombre,apellido,cedula,direccion,telefono,celular,email,puesto,banco,bancaria,usuario FROM empleado WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
    
            $param_id = $id;
        
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                $nombre = $row["nombre"];
                $apellido = $row["apellido"];
                $cedula= $row["cedula"];
                $direccion = $row["direccion"];
                $telefono = $row["telefono"];
                $celular = $row["celular"];
                $email = $row["email"];
                $puesto = $row["puesto"];
                $banco = $row["banco"];
                $bancaria = $row["bancaria"];
                $usuario = $row["usuario"];
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

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Número de teléfono</label>
                            <input type="text" name="telefono" class="form-control" minlength="8" maxlength="8" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($celular_err)) ? 'has-error' : ''; ?>">
                            <label>Número de celular</label>
                            <input type="text" name="celular" class="form-control" minlength="8" maxlength="8" value="<?php echo $celular; ?>">
                            <span class="help-block"><?php echo $celular_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Dirección</label>
                            <textarea name="direccion" class="form-control"><?php echo $direccion; ?></textarea>
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                       <div class="form-group <?php echo (!empty($puesto_err)) ? 'has-error' : ''; ?>">
                            <label>Puesto de trabajo</label>
                            <input type="text" name="puesto" class="form-control" minlength="2" maxlength="25" value="<?php echo $puesto; ?>">
                            <span class="help-block"><?php echo $puesto_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($banco_err)) ? 'has-error' : ''; ?>">
                            <label>Banco</label>
                            <input type="text" name="banco" class="form-control" minlength="2" maxlength="25" value="<?php echo $banco; ?>">
                            <span class="help-block"><?php echo $banco_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($bancaria_err)) ? 'has-error' : ''; ?>">
                            <label>Cuenta bancaria</label>
                            <input type="text" name="bancaria" class="form-control" minlength="5" maxlength="25" value="<?php echo $bancaria; ?>">
                            <span class="help-block"><?php echo $bancaria_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre de usuario</label>
                            <input type="text" name="usuario" class="form-control" minlength="4" maxlength="15" value="<?php echo $usuario; ?>">
                            <span class="help-block"><?php echo $usuario_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="empleados_gestor.php" class="btn btn-default">Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>