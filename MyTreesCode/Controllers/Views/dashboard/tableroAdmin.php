<?= view('includes/header') ?>

<div class="container mt-5">
    <h1 class="text-center mb-5" style="color: #5a5a5a;">Tablero del Administrador</h1>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-muted">Amigos Registrados</h5>
                    <p class="display-4 text-primary fw-bold mb-0"><?= $amigos ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-muted">Árboles Disponibles</h5>
                    <p class="display-4 text-success fw-bold mb-0"><?= $arboles_disponibles ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title text-muted">Árboles Vendidos</h5>
                    <p class="display-4 text-danger fw-bold mb-0"><?= $arboles_vendidos ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
