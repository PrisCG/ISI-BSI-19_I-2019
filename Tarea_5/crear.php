<?php

require_once "config.php";
 

$titulo = $autor = $editorial = $precio = "";
$titulo_err = $autor_err = $editorial_err = $precio_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validar titulo del libro
    $input_titulo = trim($_POST["titulo"]);
    if(empty($input_titulo)){
        $titulo_err = "Ingrese el título del Libro";
    } elseif(!filter_var($input_titulo, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZñÑ\s]+$/")))){
        $titulo_err = "Ingrese  un título válido";
    } else{
        $titulo = $input_titulo;
    }
    
    // Validar autor del libro
    $input_autor = trim($_POST["autor"]);
    if(empty($input_autor)){
        $autor_err = "Ingrese el autor del Libro";
    } elseif(!filter_var($input_autor, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $autor_err = "Ingrese  un nombre de autor válido";
    } else{
        $autor = $input_autor;
    }

    // Validar la editorial del libro
    $input_editorial = trim($_POST["editorial"]);
    if(empty($input_editorial)){
        $editorial_err = "Ingrese la editorial del Libro";
    } elseif(!filter_var($input_editorial, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $editorial_err = "Ingrese  un nombre de editorial válido";
    } else{
        $editorial = $input_editorial;
    }
    
    
    // Validar precio
    $input_precio = trim($_POST["precio"]);
    if(empty($input_precio)){
        $precio_err = "Ingrese el precio del libro";     
    } elseif(!ctype_digit($input_precio)){
        $precio_err = "Ingrese un precio válido";
    } else{
        $precio = $input_precio;
    }
    
    
    if(empty($titulo_err) && empty($autor_err) && empty($editorial_err) && empty($precio_err)){
        
        $sql = "INSERT INTO libreria (titulo,autor,editorial,precio) VALUES (?, ?, ?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssss", $param_titulo, $param_autor, $param_editorial, $param_precio);
            
            
            $param_titulo = $titulo;
            $param_autor = $autor;
            $param_editorial = $editorial;
            $param_precio = $precio;
            
            
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
    <title>CREAR</title>
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
                        <h2>CREAR INFORMACIÓN DE UN LIBRO</h2>
                    </div>
                    <p>Por favor llenar todos los campos del formulario</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                            <label>Título del Libro</label>
                            <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>">
                            <span class="help-block"><?php echo $titulo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($autor_err)) ? 'has-error' : ''; ?>">
                            <label>Autor del Libro</label>
                            <input type="text" name="autor" class="form-control" value="<?php echo $autor; ?>">
                            <span class="help-block"><?php echo $autor_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($editorial_err)) ? 'has-error' : ''; ?>">
                            <label>Editorial del Libro</label>
                            <input type="text" name="editorial" class="form-control" value="<?php echo $editorial; ?>">
                            <span class="help-block"><?php echo $editorial_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($precio_err)) ? 'has-error' : ''; ?>">
                            <label>Precio del libro</label>
                            <input type="text" name="precio" class="form-control" value="<?php echo $precio; ?>">
                            <span class="help-block"><?php echo $precio_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Agregar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>