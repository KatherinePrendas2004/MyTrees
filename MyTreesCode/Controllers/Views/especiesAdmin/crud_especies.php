<?= view('includes/header') ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Administración de Especies</h2>

    <!-- Mensajes de éxito o error -->
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

    <!-- Botón para abrir el modal de agregar especie -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Especie</button>
    </div>

    <!-- Tabla de especies -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Comercial</th>
                <th>Nombre Científico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($especies as $especie): ?>
                <tr>
                    <td><?= $especie['id'] ?></td>
                    <td><?= $especie['nombre_comercial'] ?></td>
                    <td><?= $especie['nombre_cientifico'] ?></td>
                    <td>
                        <!-- Botón para abrir el modal de edición -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $especie['id'] ?>">Editar</button>

                        <!-- Enlace para eliminar -->
                        <a href="/especiesAdmin/eliminar/<?= $especie['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta especie?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar especie -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/especiesAdmin/agregar" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Especie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre_comercial">Nombre Comercial</label>
                        <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nombre_cientifico">Nombre Científico</label>
                        <input type="text" name="nombre_cientifico" id="nombre_cientifico" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modales de edición para cada especie -->
<?php foreach ($especies as $especie): ?>
<div class="modal fade" id="editModal-<?= $especie['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/especiesAdmin/editar/<?= $especie['id'] ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Especie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $especie['id'] ?>">
                    <div class="form-group mb-3">
                        <label for="edit_nombre_comercial_<?= $especie['id'] ?>">Nombre Comercial</label>
                        <input type="text" name="nombre_comercial" id="edit_nombre_comercial_<?= $especie['id'] ?>" class="form-control" value="<?= $especie['nombre_comercial'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_nombre_cientifico_<?= $especie['id'] ?>">Nombre Científico</label>
                        <input type="text" name="nombre_cientifico" id="edit_nombre_cientifico_<?= $especie['id'] ?>" class="form-control" value="<?= $especie['nombre_cientifico'] ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
