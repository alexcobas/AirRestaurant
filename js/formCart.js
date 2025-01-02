document.addEventListener("DOMContentLoaded", function () {
    const savedCardsSelect = document.getElementById("savedCards");
    const enableNewCardCheckbox = document.getElementById("enableNewCard");
    const newCardForm = document.getElementById("newCardForm");
    const payButton = document.querySelector(".pay-button");

    // Simular estado de sesión y cantidad del carrito desde el servidor
    const userSession = window.userSession || false; // Este valor debe ser inyectado desde PHP
    const cartItemCount = window.cartItemCount || 0; // Este valor debe ser inyectado desde PHP

    // Inicializar estado del botón al cargar la página
    function initializeButtonState() {
        if (cartItemCount < 1) {
            payButton.disabled = true; // Carrito vacío
        } else if (userSession) {
            payButton.disabled = false; // Sesión activa
        } else {
            payButton.disabled = true; // Sin sesión, botón deshabilitado inicialmente
        }
    }

    // Validar el estado del formulario
    function validateForm() {
        if (cartItemCount < 1) {
            payButton.disabled = true; // Carrito vacío
            return;
        }

        if (userSession) {
            payButton.disabled = false; // Sesión activa
            return;
        }

        // Sin sesión, habilitar solo si el checkbox está marcado
        payButton.disabled = !enableNewCardCheckbox.checked;
    }

    // Mostrar/ocultar el formulario de nueva tarjeta
    enableNewCardCheckbox?.addEventListener("change", function () {
        const isChecked = enableNewCardCheckbox.checked;
        newCardForm.style.display = isChecked ? "block" : "none";
        if (savedCardsSelect) savedCardsSelect.disabled = isChecked;
        validateForm(); // Revalida al cambiar el checkbox
    });

    // Prevenir el envío si el botón está deshabilitado
    payButton?.addEventListener("click", function (event) {
        if (payButton.disabled) {
            event.preventDefault();
            alert("Por favor, selecciona o completa una tarjeta válida.");
        }
    });

    // Inicializar estados al cargar la página
    initializeButtonState();
    validateForm();
});
