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
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=url?>product/">Nuestro Menú</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#">Sobre Nosotros</a>
                        </li>   
                    </ul>
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
                                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar sesión</a></li>
                                <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a></li>
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
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
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

    <section class="banner text-white text-center d-flex align-items-center justify-content-center position-relative">
        <div class="banner-dark-overlay"></div>
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-3">Bienvenidos a Air Restaurant</h1>
            <p class="lead mb-4">Descubre los sabores únicos y disfruta de una experiencia gastronómica inolvidable</p>
            <div>
                <a href="?controller=menu" class="btn btn-primary btn-lg me-2">Ver Menú</a>
                <a href="?controller=reservations" class="btn btn-outline-light btn-lg">Reservar Ahora</a>
            </div>
        </div>
    </section>
</header>
    <section class="container mt-5">
        <div class="row">
            <!-- Sección: Descubre tu próximo favorito -->
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Descubre tu próximo favorito</h2>
                <p class="lead">Una invitación a los usuarios a explorar las diversas opciones del menú, destacando la personalización de pedidos.</p>
                <a href="?controller=menu" class="btn btn-primary btn-lg">Ver nuestro menú</a>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-md-6 d-flex justify-content-center">
                <img src="<?=url?>img/HistoriaAirRestaurant.webp" alt="Historia" class="img-fluid rounded img-history">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold text-primary">La historia detrás de AirRestaurant</h2>
                <p class="pt-3">En AirRestaurant, creemos que comer no es solo cuestión de sabores, sino de momentos. Queremos que cada comida sea una experiencia única, desde los ingredientes frescos hasta el ambiente acogedor. Inspirados por la filosofía de Airbnb, nuestro restaurante ofrece más que un simple menú: un espacio donde los clientes puedan disfrutar de platos innovadores en un entorno cómodo y sofisticado. Aquí, cada detalle está pensado para crear recuerdos y conexiones, brindando una experiencia memorable que va más allá de la comida. AirRestaurant no solo sirve platos, sirve vivencias.</p>
            </div>
        </div>
        <h2 class="fw-bold mb-4 text-primary">Nuestros productos</h2>
        <div class="row text-center py-5">
            <?php 
            foreach($categories as $category){ 
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <a href="<?= url ?>/product/index?filter=<?=$category->getId()?>" class="card d-flex flex-row align-items-center shadow-sm border-0 text-decoration-none categories-hover-scale rounded">
                    <img src="<?=url?>img/<?=$category->getImg()?>" alt="<?=$category->getTitle()?>" class="img-categories rounded">
                    <p class="ms-3 mb-0 fw-bold"><?=$category->getTitle()?></p>
                </a>
            </div>
            <?php }?>
        </div>
    </section>

    <footer class="bg-light py-4 mt-5">
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
                    <i class="bi bi-globe-americas pe-1"></i>
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