<section class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url ?>user/" class="text-decoration-none"><strong class="text-gray hover-underline">Cuenta</strong></a></li>
                        <li class="breadcrumb-item"><a href="<?= url ?>user/myOrders" class="text-decoration-none"><strong class="text-gray hover-underline">Mis Pedidos</strong></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><strong class="text-gray">Detalles del Pedido</strong></li>
                    </ol>
                </nav>
                <div class="mt-3">
                    <h2 class="fw-bold text-gray">Detalles del Pedido #<?= $order->getId() ?></h2>
                </div>
            </div>
            <div class="card p-4 shadow-sm">
                <h4 class="fw-bold">Información del Pedido</h4>
                <p class="text-secondary">Consulta la información detallada de tu compra.</p>

                <div class="border rounded p-3 mb-3">
                    <p class="mb-0 fw-bold">Fecha: <?= $order->getDate() ?></p>
                    <p class="mb-0 text-secondary">Total: $<?= $order->getOrder_Price_Total() ?? $order->getOrder_Price() ?></p>
                </div>

                <h5 class="fw-bold mt-4">Productos Comprados</h5>
                <ul class="list-group mb-4">
                    <?php foreach ($order->getProducts() as $product) { ?>
                        <div class="col-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                                <div class="d-flex">
                                    <div>
                                        <h6 class="mb-1"><?= $product->getName() ?></h6>
                                        <p class="text-secondary mb-0">Cantidad: <?= $product->getCuantity() ?></p>
                                    </div>
                                </div>
                                <div>
                                    <p class="mb-0 text-primary fw-bold">$<?= $product->getBase_price() * $product->getCuantity() ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </ul>

                <?php if ($address) { ?>
                    <h5 class="fw-bold mt-4">Dirección de Envío</h5>
                    <p class="text-secondary mb-0"><?= $address->getAddress() ?>, <?= $address->getCity() ?>, C.P. <?= $address->getCodPostal() ?></p>
                <?php } ?>

                <?php if ($card) { ?>
                    <h5 class="fw-bold mt-4">Método de Pago</h5>
                    <div class="d-flex align-items-center">
                        <img src="<?= $card->getCardImage() ?>" alt="<?= $card->getCardBrand() ?>" width="50" class="me-2">
                        <p class="mb-0 text-secondary">Tarjeta <?= $card->getCardBrand() ?> (<?= $card->getFormattedCardNumber() ?>)</p>
                    </div>
                <?php } ?>
                <a href="<?= url?>cart/repeatOrder?id=<?= $order->getId()?>" type="button" class="btn btn-primary mt-3">Repetir la compra.</a>
            </div>
        </div>
    </div>
</section>