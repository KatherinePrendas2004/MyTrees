<?= view('includes/header') ?>

<div class="container mt-5">
    <h2 class="text-center">Lista de Amigos Registrados</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($amigos as $amigo): ?>
                <tr>
                    <td><?= $amigo['id'] ?></td>
                    <td><?= $amigo['nombre'] ?> <?= $amigo['apellidos'] ?></td>
                    <td><?= $amigo['correo'] ?></td>
                    <td>
                        <a href="/amigosAdmin/arboles/<?= $amigo['id'] ?>" class="btn btn-primary btn-sm">Ver Árboles</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
