<?php
$filter = null;
if (isset($_GET['filter'])) {
  $filter = (int)$_GET['filter'];
  if ($filter == 0) {
    $filter = null;
  } else {
    $products = array_filter($products, function($product) use ($filter) {
      return $product->getCategory()->getId() === $filter;
    });
  }
}
if (isset($_GET['filterName'])) {
  $filterName = trim($_GET['filterName']); 
  $products = array_filter($products, function($product) use ($filterName) {
    return stripos($product->getName(), $filterName) !== false; 
  });
}
?>
<section class="fixed-top bg-white">
    <nav class="navbar navbar-expand-lg container mt-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=url?>home/">
                <img src="<?=url?>img/logo.webp" class="logoSuperior" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="<?= url ?>home/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="<?= url ?>product/">Nuestro Menú</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#">Sobre Nosotros</a>
              </li>
            </ul>
                <div class="d-flex align-items-center">
                  <div class="d-flex pe-4 align-items-center">
                    <span class="material-symbols-outlined icon-24" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">shopping_cart</span>
                    <span id="numProducts">
                      0
                    </span>
                </div>

                    <div class="dropdown">
                        <div class="d-flex align-items-center" id="customDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <span class="material-symbols-outlined icon-24">menu</span>
                            <i class="bi bi-person-circle icon-24"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="customDropdown" style="right: 0; left: auto; transform-origin: right top;">
                            <li><a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</a></li>
                            <li><a class="dropdown-item" href="#">Regístrate</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Tarjetas regalo</a></li>
                            <li><a class="dropdown-item" href="#">Pon tu casa en Airbnb</a></li>
                            <li><a class="dropdown-item" href="#">Ofrece una experiencia</a></li>
                            <li><a class="dropdown-item" href="#">Centro de ayuda</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- <div class="modal fade" id="loginModal" tabindex="1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="your-login-endpoint.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="username" name="username" required>
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
                        <button type="submit" class="btn btn-primary w-100 mt-3">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="cartOffcanvasLabel">Carrito de Compras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php if (!empty($products)) { ?>
              <?php $totalPrice=0?>
                <?php foreach ($products as $product) { ?>
                    <div class="product-item border-bottom pb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="<?= url ?>img/<?= $product->getImages()[0]->getPhoto_archive_name() ?>" alt="<?= $product->getName() ?>" class="img-thumbnail" style="width: 70px; height: 70px;">
                                <div class="ms-3">
                                    <p class="mb-0 fw-bold"><?= $product->getName(); ?></p>
                                    <p class="text-muted mb-0"><?= $product->getCategory()->getName(); ?></p>
                                    <p class="text-muted mb-0"><?= $product->getBase_Price(); ?> €</p>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </div>
                    </div>
                <?php
                $totalPrice += $product->getBase_Price();
                } ?>
            <?php } else { ?>
                <p>No hay productos en el carrito.</p>
            <?php } ?>
        </div>
        <div class="offcanvas-footer border-top p-3">
            <div class="d-flex justify-content-between">
                <p class="fw-bold mb-0">Total:</p>
                <p class="fw-bold mb-0"><?=number_format($totalPrice, 2)?> €</p>
            </div>
            <button type="button" class="btn btn-primary w-100 mt-2">Ir al carrito</button>
        </div>
    </div>
    <div class="d-flex w-100 justify-content-center mt-4 mb-4">
      <div class="search-container">
          <input type="text" class="form-control search-input" placeholder="Buscar platos por nombre...">
          <button class="search-button">
          <span class="material-symbols-outlined icon-24-dark">search</span>
          </button>
      </div>
    </div>
    <hr class="line-border">
<div class="container menu-section-extended mt-4">
  <div class="row row-left-align m-0">
    <a href="<?=url?>product/index?filter=0" class="col-auto menu-item-flex <?=($filter === null ? 'selected' : '')?>">
      <img src="<?=url ?>img/iRestaurant.svg" class="icon-24 <?=($filter === null ? 'active' : '') ?>" alt="Nuestro Menú icono">
      <p class="<?=($filter === null ? 'active' : '') ?>">Nuestro Menú</p>
    </a>
    <?php
    if (!empty($categories)) {
      foreach ($categories as $category) { ?>
        <a href="<?= url ?>product/index?filter=<?= $category->getId() ?>" 
           class="col-auto menu-item-flex <?= $filter === $category->getId() ? 'selected' : ''; ?>">
            <img src="<?= url ?>img/<?= $category->getIcon() ?>" alt="<?= $category->getTitle() ?> icon" class="icon-24 <?= $filter === $category->getId() ? 'active' : ''; ?>">
            <p class="<?= $filter === $category->getId() ? 'active' : ''; ?>"><?= $category->getTitle() ?></p>
        </a>
      <?php
      }
    } else { ?>
      <p>No hay categorías disponibles.</p>';
    <?php }?>
  </div>
</div>
</section>

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
                  <div class="carousel-item <?= $i == 0 ? "active first" : "";?><?= $i == (count($images)-1) ? "last" : "";?>">
                    <img src="<?= url ?>img/<?=$images[$i]->getPhoto_archive_name()?>" class="d-block w-100" alt="<?=$product->getName()?>">
                  </div>
                <?php } ?>
              </div>
              <?php if(isset($images) && count($images) > 1) {?>
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
              <button class="btn btn-primary btn-add-cart" data-product-name="<?= $product->getName()?>" aria-label="Añadir al carrito">Añadir al carrito</button>
            </div>
          </div>
        </a>
    <?php 
        $idCarrousel++;
      }
    } else { ?>
      <p>No hay productos disponibles.</p>
    <?php }?>
  </div>
</section>
<div id="alert-container" class="pt-3 pb-3">
  <strong>Se ha añadido el producto con exito</strong>
</div>
<script src="<?= url ?>js/searcher.js"></script>
<script src="<?= url ?>js/effects.js"></script>
