<?= view('includes/header') ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Árboles del Amigo</h2>

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
                <th>Especie</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Tamaño</th>
                <th>Fecha Actualización</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arboles as $arbol): ?>
            <tr>
                <td><?= $arbol['id'] ?></td>
                <td><?= $arbol['especie'] ?></td>
                <td><?= $arbol['ubicacion_geografica'] ?></td>
                <td><?= $arbol['estado'] ?></td>
                <td><?= $arbol['tamanio'] ?: 'Sin registro' ?></td>
                <td><?= $arbol['fecha_actualizacion'] ?: 'Sin registro' ?></td>
                <td>
                    <?php if (!empty($arbol['foto'])): ?>
                        <img src="<?= base_url($arbol['foto']) ?>" alt="Foto del árbol" width="50">
                    <?php else: ?>
                        <span class="text-muted">Sin foto</span>
                    <?php endif; ?>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#actualizacionModal-<?= $arbol['id'] ?>">Registrar Actualización</button>
                    <a href="/amigosAdmin/actualizaciones/<?= $arbol['id'] ?>" class="btn btn-info btn-sm">Ver Historial</a>
                </td>
            </tr>

            <!-- Modal para Registrar Actualización -->
            <div class="modal fade" id="actualizacionModal-<?= $arbol['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/amigosAdmin/agregarActualizacion" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="arbol_id" value="<?= $arbol['id'] ?>">
                            <input type="hidden" name="amigo_id" value="<?= $amigo_id ?>">
                            <input type="hidden" name="especie_id" value="<?= $arbol['especie_id'] ?>">

                            <div class="modal-header">
                                <h5 class="modal-title">Registrar Actualización</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="tamanio" class="form-label">Tamaño</label>
                                    <input type="text" name="tamanio" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                                <p class="text-muted">* El estado y la ubicación se mantendrán como en el registro actual.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
