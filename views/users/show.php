<section class="container my-5">
    <div class="row">
        <!-- Información del usuario -->
        <div class="col-md-3">
            <div class="row shadow-lg rounded-4 p-4 mx-0">
                <div class="col-md-6 text-center d-flex flex-column align-items-center">
                    <?php if (!empty($_SESSION["user"]->getImg_profile())) { ?>
                        <img src="<?= url ?>img/<?= $_SESSION["user"]->getImg_profile() ?>" alt="Foto de <?= $_SESSION["user"]->getName() ?>" class="object-fit-cover rounded-circle mb-3" width="100" height="100">
                    <?php } else { ?>
                        <div style="width: 100px; height: 100px; background: #000000; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 48px; font-family: Arial, sans-serif;" class="rounded-circle mb-3"><?= mb_strtoupper(mb_substr($_SESSION["user"]->getName(), 0, 1), 'UTF-8') ?></div>
                    <?php } ?>

                    <h3><strong><?= $_SESSION["user"]->getName() ?></strong></h3>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div>
                        <p class="m-0 h4"><strong><?= $_SESSION["user"]->getAccountAge() ?></strong></p>
                        <p class="m-0 small"> <?= $_SESSION["user"]->getAccountAgeUnitLabel() ?> en AirRestaurant</p>
                    </div>
                </div>
            </div>
            <div class="card rounded-4 p-4 mt-4">
                <h5>Información confirmada de <?= $_SESSION["user"]->getName() ?></h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-lg"></i> Identidad</li>
                    <li><i class="bi bi-check-lg"></i> Dirección de correo electrónico</li>
                </ul>
                <a href="#" class="text-decoration-none">Más información sobre la verificación de la identidad</a>
            </div>
        </div>
        <!-- Información confirmada -->
        <!-- Opiniones -->
        <div class="col-md-9">
            <h5>Opiniones de los anfitriones sobre Alex</h5>
            <div class="border rounded p-3">
                <p>“Han sido unos clientes excelentes, al entregar el pedido me ofrecieron propina.”</p>
                <small class="text-muted">- Javier, septiembre de 2024</small>
            </div>
            <a href="#" class="text-decoration-none d-block mt-3">Mostrar la evaluación</a>
            <a href="#" class="text-decoration-none">Evaluaciones que has escrito</a>
        </div>
    </div>
</section>