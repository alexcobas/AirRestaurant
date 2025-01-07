<section class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url ?>user/" class="text-decoration-none"><strong class="text-gray hover-underline">Cuenta</strong></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><strong class="text-gray">Mis Pedidos</strong></li>
                    </ol>
                </nav>
                <div class="mt-3">
                    <h2 class="fw-bold text-gray">Mis Pedidos</h2>
                </div>
            </div>
            <div class="card p-4 shadow-sm">
                <h4 class="fw-bold">Historial de pedidos</h4>
                <p class="text-secondary">Consulta el estado y los detalles de tus pedidos recientes.</p>

                <?php if (!empty($orders)) { ?>
                    <?php foreach ($orders as $order) { ?>
                        <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-3">
                            <div>
                                <p class="mb-0 fw-bold">Pedido #<?= $order->getId() ?></p>
                                <p class="mb-0 text-secondary">Fecha: <?= $order->getDate() ?></p>
                                <p class="mb-0 text-secondary">Total: $<?= $order->getOrder_Price_Total() ?? $order->getOrder_Price() ?></p>
                            </div>
                            <a href="<?= url ?>user/orderDetails?id=<?= $order->getId() ?>" class="btn btn-sm btn-primary">Ver detalles</a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="text-secondary">No tienes pedidos recientes.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
