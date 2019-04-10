<?php require "header.php"; ?>

<body>
  <section id="cover">
    <div id="cover-caption">
      <div id="container" class="container">
        <div class="row text-info">
          <div class="col-sm-6 offset-sm-3 text-center">
            <div class="info-form">
              <?php
                if (isset($_SESSION['userId'])) {
                  echo "<p>Ha ingresado en el sistema</p>";
                }
                else {
                  echo "<p>Debe iniciar sesion para acceder al sistema</p>";
                }
              ?>
            </div>
          </div>
        </div>
  </div>
  </section>
</body>

<?php require "footer.php"; ?>
