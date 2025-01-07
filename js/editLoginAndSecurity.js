document.addEventListener("DOMContentLoaded", function() {
    const editLink = document.querySelector(".edit-link-psw");
    const passwordForm = document.getElementById("password-form");
    const fieldContainer = document.querySelector(".field-container");

    // Verificar si la variable errorChangePassword está presente en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('errorChangePassword')) {
        // Mostrar el formulario automáticamente si la variable está presente
        fieldContainer.classList.add("d-none");
        passwordForm.classList.remove("d-none");
    }

    // Mostrar el formulario al hacer clic en el enlace de editar
    editLink.addEventListener("click", function() {
        // Ocultar el contenido actual
        fieldContainer.classList.add("d-none");
        // Mostrar el formulario
        passwordForm.classList.remove("d-none");
    });

    // Manejar la acción de cancelar
    const cancelLink = passwordForm.querySelector(".cancel-link-psw");
    cancelLink.addEventListener("click", function() {
        // Mostrar el contenido original
        fieldContainer.classList.remove("d-none");
        // Ocultar el formulario
        passwordForm.classList.add("d-none");
    });
});