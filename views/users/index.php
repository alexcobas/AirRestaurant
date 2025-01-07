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
            <a href="<?= url ?>user/loginAndSecurity" class="custom-card text-black">
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
            <a href="<?= url ?>user/myOrders" class="custom-card text-black">
                <div class="icon-wrapper mb-2">
                    <i class="bi bi-box2 fs-3"></i>
                </div>
                <h5 class="card-title">Pedidos</h5>
                <p class="text-muted">Consulta todos tus pedidos y vuelve a repetir uno si te gusta.</p>
            </a>
        </div>
    </div>
</section>