<?php require "header.php"; ?>
<div class="container py-5">
  <h4>Registro</h4>
  <br>
  <div class="row">
    <div class="col">
      <?php

      if (isset($_GET["error"])) {
        if ($_GET["error"] = "emptyfields") {
          echo '<div class="alert alert-danger" role="alert">
                  Debe llenar todos los datos.
                  </div>';
        }
        elseif ($_GET["error"] = "invaliduidmail") {
          echo '<div class="alert alert-danger" role="alert">
                  Usuario y email invalido.
                  </div>';
        }
        elseif ($_GET["error"] = "invaliduid") {
          echo '<div class="alert alert-danger" role="alert">
                  Usuario invalido.
                  </div>';
        }
        elseif ($_GET["error"] = "invalidmail") {
          echo '<div class="alert alert-danger" role="alert">
                  Email invalido.
                  </div>';
        }
        elseif ($_GET["error"] = "invaliduidmail") {
          echo '<div class="alert alert-danger" role="alert">
                  Ya existe el usuario ingresado.
                  </div>';
        }
      }
      elseif($_GET["signup"] == "success") {
        echo '<div class="alert alert-success" role="alert">
                Se ha registrado con exito.
                </div>';
      }elseif($_GET["signup"] == "start") {
        echo '<div class="alert alert-info" role="alert">
                Ingrese los datos solicitados.
                </div>';
      }
      ?>
      <form action="includes/signup.inc.php" method="post">
        <div class="form-group">
          <label for="uid">Usuario</label>
          <input type="text" class="form-control" name="uid" placeholder="Ingrese el usuario">
        </div>
        <div class="form-group">
          <label for="mail">Correo electrónico</label>
          <input type="text" class="form-control" name="mail" placeholder="Ingrese el correo electrónico">
        </div>
        <div class="form-group">
          <label for="pwd">Contraseña</label>
          <input type="password" class="form-control" name="pwd" placeholder="Ingrese la contraseña">
        </div>
        <div class="form-group">
          <label for="pwd-repeat">Repetir la contraseña</label>
          <input type="password" class="form-control" name="pwd-repeat" placeholder="Ingrese la contraseña">
        </div>
        <button type="submit" class="btn btn-info" name="signup-submit"><i class="fas fa-user-plus"></i>    Crear cuenta</button>
      </form>
    </div>
    <div class="col"></div>
    <div class="col"></div>
  </div>
</div>
<?php require "footer.php"; ?>
