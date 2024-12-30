<section class="container mt-5">
    <h2 class="mb-2">Cuenta</h2>
    <p class="mb-4">
        <strong><?= $_SESSION["user"]->getName() . " " . $_SESSION["user"]->getSurnames() ?></strong>
        <span>, <?= $_SESSION["user"]->getEmail() ?> ·</span>
        <a href="<?= url ?>user/show?id=<?= $_SESSION["user"]->getId() ?>" class="text-decoration-underline text-black">Ir al perfil</a>
    </p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
            <a href="<?= url ?>user/personalInfo" class="custom-card text-black">
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
            <a href="<?= url ?>user/paymentMethods" class="custom-card text-black">
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