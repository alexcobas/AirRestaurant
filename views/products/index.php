


<section class="container my-5">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5 g-4">
    <?php
    if (!empty($products)) {
      $idCarrousel = 0;
      foreach ($products as $product) {
        $images = $product->getImages();
    ?>
        <a href="#" class="col text-decoration-none">
          <div class="card h-100 rounded border-0">
            <div id="carouselExampleIndicators-<?= $idCarrousel ?>" class="carousel slide">
              <div class="carousel-indicators">
                <?php
                $counter = 0;
                if (isset($images) && count($images) > 1) {
                  foreach ($images as $image) { ?>
                    <button type="button" disabled data-bs-target="#carouselExampleIndicators-<?= $idCarrousel ?>" data-bs-slide-to="<?= $counter ?>" <?php if ($counter == 0) { ?> class="active" aria-current="true" <?php } ?> aria-label="Slide <?= $counter + 1 ?>"></button>
                <?php
                    $counter++;
                  }
                }
                ?>
              </div>
              <div class="carousel-inner rounded-12">
                <?php for ($i = 0; $i < count($images); $i++) { ?>
                  <div class="carousel-item <?= $i == 0 ? "active first" : ""; ?><?= $i == (count($images) - 1) ? "last" : ""; ?>">
                    <img src="<?= url ?>img/<?= $images[$i]->getPhoto_archive_name() ?>" class="d-block w-100" alt="<?= $product->getName() ?>">
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($images) && count($images) > 1) { ?>
                <button class="carrousel-control carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators-<?= $idCarrousel ?>" data-bs-slide="prev">
                  <span class="material-symbols-outlined boton-carrousel" translate="no" aria-hidden="true">chevron_left</span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carrousel-control carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators-<?= $idCarrousel ?>" data-bs-slide="next">
                  <span class="material-symbols-outlined boton-carrousel" translate="no" aria-hidden="true">chevron_right</span>
                  <span class="visually-hidden">Next</span>
                </button>
              <?php } ?>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?= $product->getName(); ?></h5>
              <p class="card-text"><?= $product->getCategory()->getName(); ?></p>
              <p class="card-text fw-bold"><?= $product->getBase_Price() ?> €</p>
              <form action="<?= url ?>cart/addToCart/" method="GET">
                <input type="hidden" name="productId" value="<?= $product->getId() ?>">
                <button type="submit" class="btn btn-primary" aria-label="Añadir al carrito">Añadir al carrito</button>
              </form>

            </div>
          </div>
        </a>
      <?php
        $idCarrousel++;
      }
    } else { ?>
      <p>No hay productos disponibles.</p>
    <?php } ?>
  </div>
</section>
<section class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h5 class="modal-title" id="loginModalLabel">Inicia sesión o regístrate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-center my-4">¡Te damos la bienvenida a AirRestaurant!</h4>
        <form action="?controller=user&action=login" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              <input type="checkbox" id="remember" name="remember">
              <label for="remember" class="form-check-label">Recordarme</label>
            </div>
            <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
          </div>
          <?php if (isset($_GET["errorLogin"])) { ?>
            <p class="errorMessage"><?= $_GET["errorLogin"] ?></p>
          <?php } ?>
          <input type="hidden" value="product" name="controller">
          <button type="submit" class="btn btn-primary w-100 mt-3">Iniciar sesión</button>
        </form>
        <p class="text-center mt-3">¿No tienes cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Regístrate aquí</a></p>
      </div>
    </div>
  </div>
</section>
<section class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Crea tu cuenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="?controller=user&action=store" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="surnames" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="surnames" name="surnames" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
          </div>
          <?php if (isset($_GET["errorRegister"])) { ?>
            <p class="errorMessage"><?= $_GET["errorRegister"] ?></p>
          <?php } ?>
          <input type="hidden" value="product" name="controller">
          <button type="submit" class="btn btn-primary w-100 mt-3">Crear cuenta</button>
        </form>
        <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Inicia session aquí</a></p>
      </div>
    </div>
  </div>
</section>
<section id="alert-container" class="pt-3 pb-3">
  <strong>Se ha añadido el producto con exito</strong>
</section>
<script src="<?= url ?>js/searcher.js"></script>
<script src="<?= url ?>js/effects.js"></script>