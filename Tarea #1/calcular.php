<?php
if(isset($_POST['sumar'])){
	$num1 = $_POST['numero1'];
	$num2 = $_POST['numero2'];

	echo $num1+$num2;
}

if(isset($_POST['restar'])){
	$num1 = $_POST['numero1'];
	$num2 = $_POST['numero2'];

	echo $num1-$num2;
}

if(isset($_POST['multiplicar'])){
	$num1 = $_POST['numero1'];
	$num2 = $_POST['numero2'];

	echo $num1*$num2;
}

if(isset($_POST['dividir'])){
	$num1 = $_POST['numero1'];
	$num2 = $_POST['numero2'];

	echo $num1/$num2;
}

?>