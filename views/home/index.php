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
                                <li><a class="dropdown-item" href="#">Iniciar sesión</a></li>
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

    <section class="container mt-5">
        <div class="row">
            <!-- Sección: Descubre tu próximo favorito -->
            <div class="col-12 text-center mb-5">
                <h2 class="fw-bold">Descubre tu próximo favorito</h2>
                <p class="lead">Una invitación a los usuarios a explorar las diversas opciones del menú, destacando la personalización de pedidos.</p>
                <a href="?controller=menu" class="btn btn-primary btn-lg">Ver nuestro menú</a>
            </div>
        </div>

        <div class="row align-items-center my-5">
            <!-- Sección: La historia detrás de AirRestaurant -->
            <div class="col-md-6">
                <h2 class="fw-bold">La historia detrás de AirRestaurant</h2>
                <p>"Creemos que comer bien no es solo una cuestión de sabores, sino de momentos. Por eso, en cada detalle, desde la selección de ingredientes hasta el diseño del ambiente, buscamos elevar cada comida a una experiencia única para nuestros clientes."</p>
            </div>
            <div class="col-md-6">
                <img src="<?=url?>img/historia.jpg" alt="Historia" class="img-fluid rounded">
            </div>
        </div>
        
        <!-- Sección: Nuestros productos -->
        <h2 class="fw-bold mb-4">Nuestros productos</h2>
        <div class="row text-center mt-5">
            <div class="col-md-3">
                <img src="<?=url?>img/hamburguesa.webp" alt="Hamburguesas" class="img-fluid rounded mb-2">
                <p>Hamburguesas</p>
            </div>
            <div class="col-md-3">
                <img src="<?=url?>img/pizza.webp" alt="Pizzas" class="img-fluid rounded mb-2">
                <p>Pizzas</p>
            </div>
            <div class="col-md-3">
                <img src="<?=url?>img/patatas-fritas.webp" alt="Patatas" class="img-fluid rounded mb-2">
                <p>Patatas</p>
            </div>
            <div class="col-md-3">
                <img src="<?=url?>img/bebidas.webp" alt="Bebidas" class="img-fluid rounded mb-2">
                <p>Bebidas</p>
            </div>
        </div>
    </section>

    <footer class="bg-light text-center py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h6>Asistencia</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Centro de ayuda</a></li>
                        <li><a href="#">Opciones de cancelación</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Air Restaurant</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Empleo</a></li>
                        <li><a href="#">Nuevas funciones</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Síguenos</h6>
                    <a href="#"><i class="bi bi-facebook mx-2"></i></a>
                    <a href="#"><i class="bi bi-instagram mx-2"></i></a>
                    <a href="#"><i class="bi bi-twitter mx-2"></i></a>
                </div>
            </div>
            <p class="mt-3">&copy; 2024 Air Restaurant, Inc.</p>
        </div>
    </footer>
</header>
