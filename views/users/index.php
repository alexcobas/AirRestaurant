<header>
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
                    <div class="navbar-nav mx-auto mb-2 mb-lg-0">
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="d-flex p-1 align-items-center">
                            <span class="material-symbols-outlined icon-24">shopping_cart</span>
                        </div>
                        <div class="dropdown">
                            <div class="d-flex align-items-center" id="customDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="material-symbols-outlined icon-24">menu</span>
                                <i class="bi bi-person-circle icon-24"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="customDropdown" style="right: 0; left: auto; transform-origin: right top;">
                            <?php if(empty($_SESSION["user"])){?>
                                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</a></li>
                                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
                            <?php } else{?>
                                <li><a class="dropdown-item" href="<?=url?>user/">Cuenta</a></li>
                                <li><a class="dropdown-item" href="<?=url?>user/order">Ver mis pedidos</a></li>
                            <?php }?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Tarjetas regalo</a></li>
                                <li><a class="dropdown-item" href="#">Pon tu casa en Airbnb</a></li>
                                <li><a class="dropdown-item" href="#">Ofrece una experiencia</a></li>
                                <li><a class="dropdown-item" href="#">Centro de ayuda</a></li>
                            <?php if(!empty($_SESSION["user"])){?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?=url?>user/logout">Cerrar sesion</a></li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <hr class="line-border">
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
                    <form action="your-login-endpoint.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember" class="form-check-label">Recordarme</label>
                            </div>
                            <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div>
                        <input type="hidden" value="product" name="controller">
                        <?php if(isset($_GET["errorLogin"])){?>
                            <p class="errorMessage"><?=$_GET["errorLogin"]?></p>
                        <?php }?>
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
                            <label for="registerPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <input type="hidden" value="product" name="controller">
                        <?php if(isset($_GET["errorRegister"])){?>
                            <p class="errorMessage"><?=$_GET["errorRegister"]?></p>
                        <?php }?>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Crear cuenta</button>
                    </form>
                    <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Inicia session aquí</a></p>
                </div>
            </div>
        </div>
    </section>
</header>
<section class="container mt-5">
  <h2 class="mb-2">Cuenta</h2>
  <p class="mb-4">
    <strong><?=$_SESSION["user"]->getName() . " " . $_SESSION["user"]->getSurnames()?></strong>
    <span>, <?=$_SESSION["user"]->getEmail()?> ·</span> 
    <a href="<?=url?>user/show?id=<?=$_SESSION["user"]->getId()?>" class="text-decoration-underline text-black">Ir al perfil</a>
  </p>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <div class="col">
      <a href="<?=url?>user/personalInfo" class="custom-card text-black">
        <div class="icon-wrapper mb-2">
          <i class="bi bi-card-text fs-3"></i>
        </div>
        <h5 class="card-title">Información personal</h5>
        <p class="text-muted">Actualiza tus datos personales e indícanos cómo podemos ponernos en contacto contigo.</p>
      </a>
    </div>
    <div class="col">
      <a href="#" class="custom-card text-black">
        <div class="icon-wrapper mb-2">
          <i class="bi bi-shield-lock fs-3"></i>
        </div>
        <h5 class="card-title">Inicio de sesión y seguridad</h5>
        <p class="text-muted">Protege tu cuenta actualizando tu contraseña y opciones de seguridad.</p>
      </a>
    </div>
    <div class="col">
      <a href="<?=url?>user/paymentMethods" class="custom-card text-black">
        <div class="icon-wrapper mb-2">
          <i class="bi bi-credit-card fs-3"></i>
        </div>
        <h5 class="card-title">Pagos y cobros</h5>
        <p class="text-muted">Gestiona tus métodos de pago, cobros y cupones disponibles.</p>
      </a>
    </div>
    <div class="col">
      <a href="#" class="custom-card text-black">
        <div class="icon-wrapper mb-2">
          <i class="bi bi-bell fs-3"></i>
        </div>
        <h5 class="card-title">Notificaciones</h5>
        <p class="text-muted">Configura tus preferencias de notificación para emails y alertas.</p>
      </a>
    </div>
    <div class="col">
      <a href="#" class="custom-card text-black">
        <div class="icon-wrapper mb-2">
          <i class="bi bi-eye fs-3"></i>
        </div>
        <h5 class="card-title">Privacidad y datos</h5>
        <p class="text-muted">Controla cómo compartes tu información personal con terceros.</p>
      </a>
    </div>
    <div class="col">
      <a href="#" class="custom-card text-black">
        <div class="icon-wrapper mb-2">
          <i class="bi bi-globe fs-3"></i>
        </div>
        <h5 class="card-title">Preferencias globales</h5>
        <p class="text-muted">Selecciona tu idioma, zona horaria y moneda predeterminados.</p>
      </a>
    </div>
  </div>
</section>


<hr class="w-100 mt-5 mb-0">
<footer class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h6>Asistencia</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-dark">Centro de ayuda</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Opciones de cancelación</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Air Restaurant</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-dark">Empleo</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Nuevas funciones</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="w-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-5 col-sm-4 col-12 d-flex">
                <p class="m-0">&copy; 2024 Air Restaurant, Inc.</p>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-12 d-flex justify-content-lg-end">
                <i class="bi bi-globe pe-1"></i>
                <strong>Español (ES)</strong>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-12 d-flex justify-content-lg-end">
                <strong>€ EUR</strong>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-12 d-flex justify-content-lg-end">
                <a href="#"><i class="bi bi-facebook mx-2 color-white"></i></a>
                <a href="#"><i class="bi bi-instagram mx-2"></i></a>
                <a href="#"><i class="bi bi-twitter-x mx-2"></i></a>
                <a href="#"><i class="bi bi-youtube mx-2"></i></a>
            </div>
        </div>
    </div>
</footer>