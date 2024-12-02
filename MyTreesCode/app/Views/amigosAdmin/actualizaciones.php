<?= view('includes/header') ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Historial de Actualizaciones - Árbol ID <?= $arbol['id'] ?></h2>

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
    <!-- Tabla del historial de actualizaciones -->
    <h5 class="mb-3">Actualizaciones</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tamaño</th>
                <th>Fecha</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($actualizaciones)): ?>
                <?php foreach ($actualizaciones as $actualizacion): ?>
                    <tr>
                        <td><?= $actualizacion['id_registro'] ?></td>
                        <td><?= $actualizacion['tamanio'] ?></td>
                        <td><?= $actualizacion['fecha_actualizacion'] ?></td>
                        <td>
                            <?php if (!empty($actualizacion['foto'])): ?>
                                <img src="<?= base_url($actualizacion['foto']) ?>" alt="Foto" width="50">
                            <?php else: ?>
                                <span class="text-muted">Sin foto</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Botón para ver detalles -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detalleModal-<?= $actualizacion['id_registro'] ?>">Ver Detalles</button>
                        </td>
                    </tr>

                    <!-- Modal para ver detalles -->
                    <div class="modal fade" id="detalleModal-<?= $actualizacion['id_registro'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detalles de Actualización - Registro ID <?= $actualizacion['id_registro'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Tamaño:</strong> <?= $actualizacion['tamanio'] ?></p>
                                    <p><strong>Fecha:</strong> <?= $actualizacion['fecha_actualizacion'] ?></p>
                                    <p><strong>Foto:</strong></p>
                                    <?php if (!empty($actualizacion['foto'])): ?>
                                        <img src="<?= base_url($actualizacion['foto']) ?>" alt="Foto" class="img-fluid">
                                    <?php else: ?>
                                        <span class="text-muted">Sin foto</span>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No hay actualizaciones registradas para este árbol.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
