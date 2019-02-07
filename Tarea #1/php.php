 <?php

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$nacimiento = $_POST['nacimiento'];
$hm = $_POST['hm'];
$direccion = $_POST['direccion'];
$estudiante = $_POST['estudiante'];
$rango = $_POST['rango'];

echo "<b> El nombre es :   </b>". $_POST['nombre']. "<br />";
echo "<b>Los apellidos son :  </b> ". $_POST['apellidos']. "<br />";
echo "<b>El año de nacimiento es :  </b> ". $_POST['nacimiento']. "<br />";
echo "<b>El sexo es  :</b> ". $_POST['hm']. "<br />";
echo "<b>La direccion es:</b> ". $_POST['direccion']. "<br />";
echo "<b>Es estudiante: </b>". $_POST['estudiante']. "<br />";
echo "<b>Nivel de Carrera:</b> ". $_POST['rango']. "<br />";

?>
