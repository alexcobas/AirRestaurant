<header>
    <section class="fixed-top bg-white">
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
                    </ul>
                    <div class="d-flex align-items-center">
                        <div class="d-flex pe-4 align-items-center">
                            <span class="material-symbols-outlined icon-24" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">shopping_cart</span>
                            <span id="numProducts">
                            <?= count($_SESSION["cart"]) < 100 ? count($_SESSION["cart"]) : '99+' ?>
                            </span>
                        </div>

                        <div class="dropdown">
                            <div class="d-flex align-items-center" id="customDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <span class="material-symbols-outlined icon-24">menu</span>
                                <?php if (empty($_SESSION["user"]) || empty($_SESSION["user"]->getImg_profile())) { ?>
                                    <i class="bi bi-person-circle icon-24"></i>
                                <?php } else { ?>
                                    <img src="<?= url ?>/img/<?= $_SESSION["user"]->getImg_profile() ?>" alt="profile image" class="img-fluid rounded-circle profile-img-24">
                                <?php } ?>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="customDropdown" style="right: 0; left: auto; transform-origin: right top;">
                                <?php if (empty($_SESSION["user"])) { ?>
                                    <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</a></li>
                                    <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item" href="<?= url ?>user/">Cuenta</a></li>
                                    <li><a class="dropdown-item" href="<?= url ?>user/order">Ver mis pedidos</a></li>
                                <?php } ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Tarjetas regalo</a></li>
                                <li><a class="dropdown-item" href="#">Pon tu casa en Airbnb</a></li>
                                <li><a class="dropdown-item" href="#">Ofrece una experiencia</a></li>
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
        <hr class="line-border">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 id="cartOffcanvasLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php $totalPrice = 0 ?>
                <?php foreach ($_SESSION["cart"] as $cartProduct) { ?>
                    <div class="product-item border-bottom pb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="<?= url ?>img/<?= $cartProduct->getImages()[0]->getPhoto_archive_name() ?>" alt="<?= $cartProduct->getName() ?>" class="img-thumbnail" style="width: 70px; height: 70px;">
                                <div class="ms-3">
                                    <p class="mb-0 fw-bold"><?= $cartProduct->getName(); ?></p>
                                    <p class="text-muted mb-0"><?= $cartProduct->getCategory()->getName(); ?></p>
                                    <p class="text-muted mb-0"><?= $cartProduct->getBase_Price(); ?> €</p>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </div>
                    </div>
                <?php
                    $totalPrice += $cartProduct->getBase_Price();
                } ?>
            </div>
            <div class="offcanvas-footer border-top p-3">
                <div class="d-flex justify-content-between">
                    <p class="fw-bold mb-0">Total:</p>
                    <p class="fw-bold mb-0"><?= number_format($totalPrice, 2) ?> €</p>
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
                    <form action="?controller=user&action=login" method="post">
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
                        <input type="hidden" value="home" name="controller">
                        <?php if (isset($_GET["errorLogin"])) { ?>
                            <p class="errorMessage"><?= $_GET["errorLogin"] ?></p>
                        <?php } ?>
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
                        <?php if (isset($_GET["errorRegister"])) { ?>
                            <p class="errorMessage"><?= $_GET["errorRegister"] ?></p>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Crear cuenta</button>
                    </form>
                    <p class="text-center mt-3">¿Ya tienes una cuenta? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Inicia session aquí</a></p>
                </div>
            </div>
        </div>
    </section>
</header>