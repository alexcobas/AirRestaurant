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
