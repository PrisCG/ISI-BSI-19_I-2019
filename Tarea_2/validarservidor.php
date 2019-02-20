 <?php

     $Errores = array();
     $Mensajes = array();
     $nombre = ['nombre'];
     $contra = ['contra'];
     $email= ['email'];

     $patron_nombre= "/^[a-zA-Z.]+$/";
     $patron_contra ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[-+_!@#$%^&*.,?])).+$/";
     $patron_email= "/\S+@\S+\.\S+/";

    // Comprobar si se ha enviado el formulario:
    if( !empty($_POST) )
    {
        echo "FORMULARIO RECIBIDO:<br/>";

        // Mostrar la información recibida del formulario:
        print_r( $_POST );
        echo "<hr/>";

        if( isset($_POST['nombre']))
        {
            // Nombre:
             if( empty($_POST['nombre']) )
                $Errores[] = "Debe especificar el nombre";
            else
            {
                // Comprobar mediante una expresión regular
                 if( preg_match($patron_nombre, $_POST['nombre']) )
                    $Mensajes[] = "Nombre: [".$_POST['nombre']."]";
                else
                    $Errores[] = "El nombre sólo puede contener letras mayusculas y minusculas, y un punto";
            }
        }
        if(isset($_POST['contra'])){
        	//Contraseña
        	if(empty($_POST['contra']) )
        		$Errores[] = "Debe especificar la Contraseña";
        else{
        	if(preg_match($patron_contra, $_POST['contra']))
        		$Mensajes[] = "Contraseña : [".$_POST['contra']."]";
        	else{
        		$Errores[] = "Contraseña Incorrecta";
        	}

        }
        }
        if(isset($_POST['email'])){
        	//Email
        	if(empty($_POST['email']) )
        		$Errores[] = "Debe especificar el email";
        else{
        	if(preg_match($patron_contra, $_POST['contra']))
        		$Mensajes[] = "Email : [".$_POST['email']."]";
        	else{
        		$Errores[] = "Email Incorrecta";
        	}

        }
       }
                else
        {
            echo "<p>No se han especificado todos los datos requeridos.</p>";
        }
        // Si han habido errores se muestran, sino se mostrán los mensajes
         if( count($Errores) > 0 )
        {
            echo "<p>ERRORES ENCONTRADOS:</p>";
            // Mostrar los errores:
            for( $contador=0; $contador < count($Errores); $contador++ )
                echo $Errores[$contador]."<br/>";
        }
        else
        {
            // Mostrar los mensajes:
            for( $contador=0; $contador < count($Mensajes); $contador++ )
                echo $Mensajes[$contador]."<br/>";
        }
    }
    else
    {
        echo "<p>No se ha enviado el formulario.</p>";
    }
    echo "<p><a href='Ejercicio1.html'>Haz clic aquí para volver al formulario</a></p>";
?>