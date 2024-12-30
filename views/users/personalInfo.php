<section class="container mt-5 mb-250">
    <div class="row">
        <!-- Columna izquierda: Información personal -->
        <div class="col-lg-6">
            <!-- Título -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url ?>user/" class="text-decoration-none"><strong class="text-gray hover-underline">Cuenta</strong></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><strong class="text-gray">Datos personales</strong></li>
                    </ol>
                </nav>
                <div class="mt-3">
                    <h2 class="fw-bold text-gray">Información personal</h2>
                </div>
            </div>
            <!-- Lista de información personal -->
            <div class="container mt-5">
                <!-- Campo 1 -->
                <div class="row field-container mb-4" data-db-field="fullname">
                    <div class="col-12">
                        <label class="form-label">Nombre legal</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="field-value" data-original="<?= $_SESSION["user"]->getName();?> <?= $_SESSION["user"]->getSurnames();?>"><?= $_SESSION["user"]->getName();?> <?= $_SESSION["user"]->getSurnames();?></span>
                            <a class="edit-link">Editar</a>
                        </div>
                    </div>
                </div>

                <!-- Campo 2 -->
                <div class="row field-container mb-4" data-db-field="username">
                    <div class="col-12">
                        <label class="form-label">Nombre de pila</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="field-value" data-original="<?= $_SESSION["user"]->getUsername();?>"><?= $_SESSION["user"]->getUsername();?></span>
                            <a class="edit-link">Editar</a>
                        </div>
                    </div>
                </div>

                <!-- Campo 3 -->
                <div class="row field-container mb-4" data-row="email" data-db-field="email">
                    <div class="col-12">
                        <label class="form-label">Dirección de correo electrónico</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="field-value" data-original="<?= $_SESSION["user"]->getFormattedEmail()?>"><?= $_SESSION["user"]->getFormattedEmail()?></span>
                            <a class="edit-link">Editar</a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const editLinks = document.querySelectorAll('.edit-link');
                    const fieldContainers = document.querySelectorAll('.field-container');

                    editLinks.forEach((editLink) => {
                        editLink.addEventListener("click", function() {
                            const fieldContainer = editLink.closest('.field-container');
                            const fieldValue = fieldContainer.querySelector('.field-value');
                            const dbField = fieldContainer.dataset.dbField; // Obtiene el campo de la base de datos

                            // Si ya estamos editando, salir y resetear
                            if (editLink.textContent === "Cancelar") {
                                resetField(fieldContainer, editLink);
                                return;
                            }

                            // Bloquear otros campos
                            fieldContainers.forEach(container => {
                                if (container !== fieldContainer) container.classList.add('disabled');
                            });

                            // Almacenar valor original
                            const originalValue = fieldValue.dataset.original;

                            // Crear elementos dinámicos
                            const inputField = document.createElement("input");
                            const isEmailField = dbField === "email"; // Ajusta según el valor de data-db-field

                            inputField.type = isEmailField ? "email" : "text";
                            inputField.name = "newValue";
                            inputField.className = "form-control";
                            inputField.value = fieldValue.textContent;

                            // Botón de guardar
                            const saveButton = document.createElement("button");
                            saveButton.type = "button"; // Cambiar a button para manejar redirección
                            saveButton.className = "btn btn-dark btn-sm mt-2";
                            saveButton.textContent = "Guardar";

                            // Reemplazar contenido
                            fieldValue.textContent = '';
                            fieldValue.appendChild(inputField);
                            fieldValue.appendChild(saveButton);

                            // Cambiar texto del enlace a "Cancelar"
                            editLink.textContent = "Cancelar";

                            // Manejar el evento de guardar
                            saveButton.addEventListener("click", function() {
                                const newValue = inputField.value;

                                // Validar si es un email
                                if (isEmailField && !validateEmail(newValue)) {
                                    alert("Por favor, introduce un correo electrónico válido.");
                                    inputField.focus();
                                    return;
                                }

                                // Redirigir a la URL con dbField
                                window.location.href = `<?= url ?>user/update?field=${encodeURIComponent(dbField)}&newValue=${encodeURIComponent(newValue)}`;
                            });

                            // Validación de email
                            function validateEmail(email) {
                                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                return emailRegex.test(email);
                            }

                            // Función para resetear el estado
                            function resetField(container, editLink) {
                                const value = container.querySelector('.field-value');
                                value.textContent = value.dataset.original;
                                editLink.textContent = "Editar";
                                fieldContainers.forEach(container => container.classList.remove('disabled'));
                            }
                        });
                    });
                });
            </script>


            <!-- Columna derecha: Información adicional -->
            <div class="col-lg-6">
            </div>
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