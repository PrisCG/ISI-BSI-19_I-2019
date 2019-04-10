<?php

$servername = "localhost";
$dBUser = "root";
$dBPassword = "";
$dBName = "tarea";

$conn = mysqli_connect($servername, $dBUser, $dBPassword, $dBName);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
