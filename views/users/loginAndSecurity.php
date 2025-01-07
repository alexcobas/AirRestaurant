<section class="container mt-5 mb-5">
    <div class="row">
        <!-- Columna izquierda: Información personal -->
        <div class="col-lg-6">
            <!-- Título -->
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= url ?>user/" class="text-decoration-none">
                                <strong class="text-gray hover-underline">Cuenta</strong>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <strong class="text-gray">Inicio de sesión y seguridad</strong>
                        </li>
                    </ol>
                </nav>
                <div class="mt-3">
                    <h2 class="fw-bold text-gray">Inicio de sesión y seguridad</h2>
                </div>
            </div>

            <!-- Lista de información personal -->
            <div class="container">
                <div class="border-bottom pt-4 pb-3">
                    <h3 class="fw-bold text-gray">Iniciar sesión</h3>
                </div>

                <!-- Campo de contraseña -->
                <div class="row field-container mb-4" data-db-field="password">
                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-between">
                            <label class="fw-bold text-gray form-label">Contraseña</label>
                            <a href="javascript:void(0)" class="fw-bold edit-link-psw">Actualizar</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="field-value" data-original="********">********</span>
                        </div>
                    </div>
                </div>

                <!-- Formulario de edición oculto inicialmente -->
                <div id="password-form" class="row d-none">
                    <div class="col-12 mt-3">
                        <form action="changePassword" method="POST">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="fw-bold text-gray form-label">Contraseña</label>
                                    <a href="javascript:void(0)" class="fw-bold cancel-link-psw">Cancelar</a>
                                </div>
                                <label for="current-password" class="form-label">Contraseña actual</label>
                                <input type="password" name="current-password" class="form-control" id="current-password" placeholder="Introduce tu contraseña actual">
                            </div>
                            <div class="mb-3">
                                <label for="new-password" class="form-label">Contraseña nueva</label>
                                <input type="password" name="new-password" class="form-control" id="new-password" placeholder="Introduce tu nueva contraseña">
                            </div>
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirma la contraseña</label>
                                <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirma tu nueva contraseña">
                            </div>
                            <?php if(isset($_GET["errorChangePassword"])){?>
                                <p class="errorMessage"><?= $_GET["errorChangePassword"]?></p>
                            <?php } ?>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="fw-bold btn btn-secondary">Actualizar contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="my-4">
            </div>
        </div>
        <div class="container">
                <div class="pt-4 pb-3">
                    <h3 class="fw-bold text-gray">Cuenta</h3>
                </div>

                <!-- Campo de contraseña -->
                <div class="row field-container mb-4" data-db-field="password">
                    <div class="col-12 mt-3">
                        <div class="d-flex justify-content-between">
                            <label class="text-gray form-label">Elimina tu cuenta</label>
                            <a href="<?= url?>user/deleteAccount" class="text-red text-decoration-none">Eliminar</a>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
            </div>
    </div>
</section>

<script src="<?= url ?>js/editLoginAndSecurity.js"></script>
