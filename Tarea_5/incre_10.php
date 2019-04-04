<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<head>
	<title>Incrementar libro 10%</title>

	<style type="text/css">
		fieldset {
			margin: auto;
			margin-top: 100px;
			width: 50%;
		}

		table tr th {
			padding-top: 20px;
		}
	</style>

</head>
<body>

<fieldset>
	<legend>Incrementar Libro</legend>

	<form action="incrementar10.php" method="post">
		<table cellspacing="0" cellpadding="0">
            <div align="center">                        
            <p>Ingrese el nombre de la editorial</p>
            <p>
            <tr>
				<td><input type="text" name="editorial" placeholder="Nombre de la editorial" />
                <a href='incrementar10.php'><button type="submit" >Aceptar</button></td>
				
			</tr>	
			
            </p>
            
            </div>
			
		</table>
		
	</form>
	<a href="index.php" class="btn btn-success pull-right">Volver</a>
</fieldset>

</body>
</html>