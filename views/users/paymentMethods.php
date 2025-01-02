<section class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url ?>user/" class="text-decoration-none"><strong class="text-gray hover-underline">Cuenta</strong></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><strong class="text-gray">Pagos y cobros</strong></li>
                    </ol>
                </nav>
                <div class="mt-3">
                    <h2 class="fw-bold text-gray">Pagos y cobros</h2>
                </div>
            </div>
            <div class="card p-4 shadow-sm">
                <h4 class="fw-bold">Métodos de pago</h4>
                <p class="text-secondary">Añade y gestiona tus métodos de pago a través de nuestro sistema de pago seguro.</p>

                <?php if (!empty($cards)) { ?>
                    <?php foreach ($cards as $card) {
                    ?>
                        <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <img src="<?= $card->getCardImage() ?>" alt="<?= $card->getCardBrand() ?>" style="width: 40px; height: auto;" class="me-3">
                                <div>
                                    <p class="mb-0 fw-bold"><?= $card->getCardBrand() ?> <?= $card->getFormattedCardNumber() ?>
                                        <?php if ($card->getIsPrimary() == 1) { ?>
                                            <span class="badge bg-primary ms-2">Principal</span>
                                        <?php } ?></p>
                                    <p class="mb-0 text-secondary">Caducidad: <?= $card->getExpirationDate() ?></p>
                                </div>

                            </div>
                            <div class="dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php if ($card->getIsPrimary() == 0) { ?>
                                        <li><a class="dropdown-item" href="<?= url ?>user/primaryEstablish?card_id=<?= $card->getId() ?>">Establecer como principal</a></li>
                                    <?php } ?>
                                    <?php if ($card->getIsPrimary() == 0) { ?>
                                        <li><a class="dropdown-item" href="<?= url ?>user/deleteCard?card_id=<?= $card->getId() ?>">Eliminar</a></li>
                                    <?php }else{ ?>
                                        <li><p class="dropdown-item disabled mb-0">Eliminar</p></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

                <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#addCardModal">Añadir método de pago</button>
            </div>
        </div>
        <div class="col-lg-6">
        </div>
        <div class="modal fade" id="addCardModal" tabindex="-1" aria-labelledby="addCardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tarjetaModalLabel">Añade los datos de la tarjeta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="<?= url ?>/user/addCard" method="POST">
                        <div class="modal-body">
                            <div class="input-container">
                                <div class="input-field">
                                    <input type="text" id="numeroTarjeta" class="onlyNumbers" name="cardNumber" placeholder=" " maxlength="16" pattern="\d{16}" required>
                                    <label for="numeroTarjeta">Número de tarjeta</label>
                                </div>
                                <div class="input-row">
                                    <div class="input-field input-half">
                                        <input type="text" id="caducidad" name="expirationDate" placeholder=" " maxlength="5" pattern="\d{2}/\d{2}" required>
                                        <label for="caducidad">Caducidad (MM/AA)</label>
                                    </div>
                                    <div class="input-field input-half">
                                        <input type="text" id="cvv" name="cvv" class="onlyNumbers" placeholder=" " maxlength="3" pattern="\d{3}" required>
                                        <label for="cvv">CVV</label>
                                    </div>
                                </div>
                                <div class="input-field">
                                    <input type="text" id="codigoPostal" class="onlyNumbers" name="codPostal" placeholder=" " maxlength="5" pattern="\d{5}" required>
                                    <label for="codigoPostal">Código postal</label>
                                </div>

                                <div class="input-field">
                                    <select id="paisRegion" name="country" required>
                                        <option value="España">España</option>
                                        <option value="México">México</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Colombia">Colombia</option>
                                    </select>
                                    <label for="paisRegion">País/Región</label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-between">
                            <a href="#" data-bs-dismiss="modal">Cancelar</a>
                            <button type="submit" class="btn btn-dark">Listo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<script src="<?= url ?>js/caducidad.js"></script>
<script src="<?= url ?>js/onlyNumbers.js"></script>