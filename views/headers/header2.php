<?php
$filter = null;
if (isset($_GET['filter'])) {
  $filter = (int)$_GET['filter'];
  if ($filter == 0) {
    $filter = null;
  } else {
    $products = array_filter($products, function ($product) use ($filter) {
      return $product->getCategory()->getId() === $filter;
    });
  }
}
if (isset($_GET['filterName'])) {
  $filterName = trim($_GET['filterName']);
  $products = array_filter($products, function ($product) use ($filterName) {
    return stripos($product->getName(), $filterName) !== false;
  });
}
?>
<header class="fixed-top bg-white">
  <nav class="navbar navbar-expand-lg container mt-0">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= url ?>home/">
        <img src="<?= url ?>img/logo.webp" class="logoSuperior" alt="Logo">
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
              <?php
              $totalProducts = 0;
              foreach ($_SESSION['cart'] as $product) {
                $totalProducts += $product->getCuantity();
              } ?>
              <?= $totalProducts < 100 ? $totalProducts : '99+' ?>
            </span>
          </div>

          <div class="dropdown">
            <div class="d-flex align-items-center" id="customDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
              <span class="material-symbols-outlined icon-24">menu</span>
              <i class="bi bi-person-circle icon-24"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="customDropdown" style="right: 0; left: auto; transform-origin: right top;">
              <?php if (empty($_SESSION["user"])) { ?>
                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</a></li>
                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
              <?php } else { ?>
                <li><a class="dropdown-item" href="<?= url ?>user/">Cuenta</a></li>
                <li><a class="dropdown-item" href="<?= url ?>user/myOrders">Ver mis pedidos</a></li>
              <?php } ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Centro de ayuda</a></li>
              <?php if (!empty($_SESSION["user"])) { ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= url ?>user/logout">Cerrar sesion</a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header">
      <h5 id="cartOffcanvasLabel">Carrito de Compras</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <?php $totalPrice = 0 ?>
      <?php foreach ($_SESSION['cart'] as $product) { ?>
        <div class="product-item border-bottom pb-2">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <?php
              $image = $product->getImages();
              if ($image && isset($image[0]) && method_exists($image[0], 'getPhoto_archive_name')) {
                $photo = $image[0]->getPhoto_archive_name();
              } else {
                $photo = "default.jpg";
              }
              ?>
              <img src="<?= url ?>img/<?= $photo ?>" alt="<?= $product->getName() ?>" class="img-thumbnail" style="width: 70px; height: 70px;">
              <div class="ms-3">
                <p class="mb-0 fw-bold"><?= $product->getName(); ?></p>
                <p class="mb-0"> x <?= $product->getCuantity(); ?></p>
                <p class="text-muted mb-0"><?= $product->getCategory()->getName(); ?></p>
                <p class="text-muted mb-0"><?= $product->getBase_Price(); ?> €</p>
              </div>
            </div>
            <form action="<?= url ?>cart/removeFromCartHeader" method="POST">
              <input type="hidden" name="productId" value="<?= $product->getId() ?>">
              <input type="hidden" name="controller" value="<?= $controller ?>">
              <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
          </div>
        </div>
      <?php
        $totalPrice += ($product->getBase_Price() * $product->getCuantity());
      } ?>
    </div>
    <div class="offcanvas-footer border-top p-3">
      <div class="d-flex justify-content-between">
        <p class="fw-bold mb-0">Total:</p>
        <p class="fw-bold mb-0"><?= number_format($totalPrice, 2) ?> €</p>
      </div>
      <a href="<?= url ?>cart/?view=<?= $controller ?>" type="button" class="btn btn-primary w-100 mt-2">Ir al carrito</a>
    </div>
  </div>
  <div class="d-flex w-100 justify-content-center mt-4 mb-4">
    <div class="search-container">
      <input type="text" id="searchInput" class="form-control search-input" placeholder="Buscar platos por nombre...">
      <button id="searchButton" class="search-button">
        <span class="material-symbols-outlined icon-24-dark">search</span>
      </button>
    </div>

  </div>
  <hr class="line-border">
  <div class="container menu-section-extended mt-4">
    <div class="row row-left-align m-0">
      <a href="<?= url ?>product/index?filter=0" class="col-auto menu-item-flex <?= ($filter === null ? 'selected' : '') ?>">
        <img src="<?= url ?>img/iRestaurant.svg" class="icon-24 <?= ($filter === null ? 'active' : '') ?>" alt="Nuestro Menú icono">
        <p class="<?= ($filter === null ? 'active' : '') ?>">Nuestro Menú</p>
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
      <?php } ?>
    </div>
  </div>
</header>