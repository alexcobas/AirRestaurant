document.addEventListener("DOMContentLoaded", function() {
    const editLinks = document.querySelectorAll('.edit-link');
    const fieldContainers = document.querySelectorAll('.field-container');

    editLinks.forEach((editLink) => {
        editLink.addEventListener("click", function() {
            const fieldContainer = editLink.closest('.field-container');
            const fieldValue = fieldContainer.querySelector('.field-value');
            const dbField = fieldContainer.dataset.dbField;
            if (editLink.textContent === "Cancelar") {
                resetField(fieldContainer, editLink);
                return;
            }

            fieldContainers.forEach(container => {
                if (container !== fieldContainer) container.classList.add('disabled');
            });

            const originalValue = fieldValue.dataset.original;

            const inputField = document.createElement("input");
            const isEmailField = dbField === "email";

            inputField.type = isEmailField ? "email" : "text";
            inputField.name = "newValue";
            inputField.className = "form-control";
            inputField.value = fieldValue.textContent;

            const saveButton = document.createElement("button");
            saveButton.type = "button";
            saveButton.className = "btn btn-dark btn-sm mt-2";
            saveButton.textContent = "Guardar";

            fieldValue.textContent = '';
            fieldValue.appendChild(inputField);
            fieldValue.appendChild(saveButton);

            editLink.textContent = "Cancelar";

            saveButton.addEventListener("click", function() {
                const newValue = inputField.value;

                if (isEmailField && !validateEmail(newValue)) {
                    alert("Por favor, introduce un correo electrónico válido.");
                    inputField.focus();
                    return;
                }

                window.location.href = `<?= url ?>user/update?field=${encodeURIComponent(dbField)}&newValue=${encodeURIComponent(newValue)}`;
            });

            function validateEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function resetField(container, editLink) {
                const value = container.querySelector('.field-value');
                value.textContent = value.dataset.original;
                editLink.textContent = "Editar";
                fieldContainers.forEach(container => container.classList.remove('disabled'));
            }
        });
    });
});