<div class="container mt-5">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-chevron-left me-3" style="font-size: 1.5rem; cursor: pointer;"></i>
                <h2 class="fw-bold mb-0">Confirmar y pagar</h2>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Left Section -->
        <div class="col-lg-7">
            <!-- Products -->
            <h5 class="mb-3">Tus productos</h5>
            <ul class="list-group mb-4">
                <?php if (!empty($cart)): ?>
                    <?php foreach ($cart as $product): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><?= htmlspecialchars($product->getName()) ?></h6>
                                <small class="text-muted"><?= htmlspecialchars($product->getDescription()) ?></small>
                            </div>
                            <div>
                                <span class="text-muted me-3"><?= number_format($product->getBase_price(), 2) ?>€</span>
                                <a href="#" class="text-decoration-none">Editar</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="list-group-item text-center">El carrito está vacío.</li>
                <?php endif; ?>
            </ul>

            <!-- Payment Form -->
            <h5 class="mb-3">Pagar con</h5>
            <form method="POST" action="<?= url ?>/cart/createOrder">
                <?php if (!empty($cards)): ?>
                    <!-- Tarjetas guardadas -->
                    <div class="mb-3">
                        <label for="savedCards" class="form-label">Selecciona una tarjeta guardada</label>
                        <select class="form-select custom-input" id="savedCards" name="idCardSelect">
                            <?php foreach ($cards as $card){ 
                                if($card->getIsPrimary() == 1){ ?>
                                <option value="<?= htmlspecialchars($card->getId()) ?>">
                                    <?= htmlspecialchars($card->getCardBrand()) ?> - <?= htmlspecialchars($card->getFormattedCardNumber()) ?>
                                </option>
                            <?php } 
                            } ?>
                            <?php foreach ($cards as $card){ 
                                if($card->getIsPrimary() != 1){ ?>
                                <option value="<?= htmlspecialchars($card->getId()) ?>">
                                    <?= htmlspecialchars($card->getCardBrand()) ?> - <?= htmlspecialchars($card->getFormattedCardNumber()) ?>
                                </option>
                            <?php } 
                            } ?>
                        </select>
                    </div>
                <?php endif; ?>
                <!-- Usar nueva tarjeta -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="enableNewCard" name="newTarget">
                    <label class="form-check-label" for="enableNewCard">
                        Usar una nueva tarjeta
                    </label>
                </div>
                <!-- Nueva tarjeta -->
                <div id="newCardForm" style="display: none;">
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Número de tarjeta</label>
                        <input type="text" class="form-control custom-input onlyNumbers" id="cardNumber" name="cardNumber" placeholder="•••• •••• •••• ••••" maxlength="16" pattern="\d{16}">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="caducidad" class="form-label">Caducidad</label>
                            <input type="text" class="form-control custom-input onlyNumbers" id="caducidad" name="expiry" placeholder="MM/AA" maxlength="5" pattern="\d{2}/\d{2}">
                        </div>
                        <div class="col-md-6">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control custom-input onlyNumbers" id="cvv" name="cvv" placeholder="•••" maxlength="3" pattern="\d{3}">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="postalCode" class="form-label">Código postal</label>
                        <input type="text" class="form-control custom-input onlyNumbers" id="postalCode" name="postalCode" placeholder="12345" maxlength="5" pattern="\d{5}">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">País/Región</label>
                        <select class="form-select custom-input" id="country" name="country">
                            <option selected>España</option>
                            <option value="Francia">Francia</option>
                            <option value="Alemania">Alemania</option>
                            <option value="Italia">Italia</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="totalPrice" value="<?= number_format($total + 7, 2)?>">
                <button type="submit" class="btn pay-button w-100" <?= count($_SESSION["cart"]) > 0 ? "" : "disabled"?>>Pagar ahora</button>
            </form>
        </div>

        <!-- Right Section -->
        <div class="col-lg-5">
            <div class="card card-product">
                <div class="card-body">
                    <h5>Detalles del pedido</h5>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between">
                            <span>Productos</span>
                            <span><?= number_format($total, 2) ?>€</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span>Gastos de envío</span>
                            <span>4,00€</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span>Impuestos</span>
                            <span>3,00€</span>
                        </li>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span><?= number_format($total + 7, 2) ?>€</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= url ?>js/caducidad.js"></script>
<script src="<?= url ?>js/onlyNumbers.js"></script>

<script>
    //Este script esta en el php porque usa funciones php.
    document.addEventListener("DOMContentLoaded", function () {
    const savedCardsSelect = document.getElementById("savedCards");
    const enableNewCardCheckbox = document.getElementById("enableNewCard");
    const newCardForm = document.getElementById("newCardForm");
    const payButton = document.querySelector(".pay-button");

    const userSession = <?php echo isset($_SESSION["user"]) ? 'true' : 'false'; ?>;
    const cartItemCount = <?php echo isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0; ?>;

    function updateButtonState() {
        if (cartItemCount < 1) {
            payButton.disabled = true; 
            return;
        }

        if (userSession) {
            payButton.disabled = false; 
        } else {
            payButton.disabled = !enableNewCardCheckbox.checked; 
        }
    }

    enableNewCardCheckbox.addEventListener("change", function () {
        const isChecked = enableNewCardCheckbox.checked;
        newCardForm.style.display = isChecked ? "block" : "none";
        if (savedCardsSelect) savedCardsSelect.disabled = isChecked;
        updateButtonState();
    });

    updateButtonState();
});
</script>
