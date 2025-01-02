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
