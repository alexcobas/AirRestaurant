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
                            <span class="field-value" data-original="<?= $_SESSION["user"]->getName(); ?> <?= $_SESSION["user"]->getSurnames(); ?>"><?= $_SESSION["user"]->getName(); ?> <?= $_SESSION["user"]->getSurnames(); ?></span>
                            <a class="edit-link">Editar</a>
                        </div>
                    </div>
                </div>

                <!-- Campo 2 -->
                <div class="row field-container mb-4" data-db-field="username">
                    <div class="col-12">
                        <label class="form-label">Nombre de pila</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="field-value" data-original="<?= $_SESSION["user"]->getUsername(); ?>"><?= $_SESSION["user"]->getUsername(); ?></span>
                            <a class="edit-link">Editar</a>
                        </div>
                    </div>
                </div>

                <!-- Campo 3 -->
                <div class="row field-container mb-4" data-row="email" data-db-field="email">
                    <div class="col-12">
                        <label class="form-label">Dirección de correo electrónico</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="field-value" data-original="<?= $_SESSION["user"]->getFormattedEmail() ?>"><?= $_SESSION["user"]->getFormattedEmail() ?></span>
                            <a class="edit-link">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            </div>
        </div>
</section>
<script src="<?= url?>js/editPersonalInfo.js"></script>