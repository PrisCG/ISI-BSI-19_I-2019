<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php  require "htmlconfig.php"; ?>
    <title>Tarea</title>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
          <div class="container">
            <a class="navbar-brand" href="#">Tarea</a>
            <ul class="navbar-nav mr-auto">

            </ul>
            <?php
              if (isset($_SESSION['userId'])) {
                echo '<form class="form-inline" action="includes/logout.inc.php" method="post">
                           <button type="submit" class="btn btn-info my-2 my-sm-0" name="logout-submit">Cerrar sesión</button>
                          </form>';
              }
              else {
                echo  '<form class="form-inline" action="includes/login.inc.php" method="post">
                          <input type="text" class="form-control mr-sm-2" name="mailuid" placeholder="Usuario/Email">
                          <input type="password" class="form-control mr-sm-2" name="pwd" placeholder="Contraseña">
                          <button type="submit" class="btn btn-info my-2 my-sm-0 mr-2" name="login-submit">Ingresar</button>
                          </form>
                          <a class="btn btn-info my-2 my-sm-0 mr-2" href="signup.php?signup=start">Registrarse</a>';
              }
            ?>
          </div>
        </nav>
    </header>
