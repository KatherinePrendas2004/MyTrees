<?= view('includes/header') ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Administración de Árboles</h2>

    <!-- Mensajes de éxito o error -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Botón para agregar -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Árbol</button>
    </div>

    <!-- Tabla de árboles -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Especie</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Precio</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arboles as $arbol): ?>
                <tr>
                    <td><?= $arbol['id'] ?></td>
                    <td><?= $arbol['nombre_comercial'] ?></td>
                    <td><?= $arbol['ubicacion_geografica'] ?></td>
                    <td><?= $arbol['estado'] ?></td>
                    <td>$<?= number_format($arbol['precio'], 2) ?></td>
                    <td>
                        <?php if ($arbol['foto']): ?>
                            <img src="<?= base_url($arbol['foto']) ?>" width="50" alt="Foto del árbol">
                        <?php else: ?>
                            <span class="text-muted">Sin foto</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $arbol['id'] ?>">Editar</button>
                        <a href="/arbolesAdmin/eliminar/<?= $arbol['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este árbol?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/arbolesAdmin/agregar" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Árbol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="especie_id">Especie</label>
                        <select name="especie_id" id="especie_id" class="form-control" required>
                            <?php foreach ($especies as $especie): ?>
                                <option value="<?= $especie['id'] ?>"><?= $especie['nombre_comercial'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ubicacion_geografica">Ubicación Geográfica</label>
                        <input type="text" name="ubicacion_geografica" id="ubicacion_geografica" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="Disponible">Disponible</option>
                            <option value="Vendido">Vendido</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
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

<!-- Modales de edición para cada árbol -->
<?php foreach ($arboles as $arbol): ?>
<div class="modal fade" id="editModal-<?= $arbol['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/arbolesAdmin/editar/<?= $arbol['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Árbol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $arbol['id'] ?>">
                    <div class="form-group mb-3">
                        <label for="editEspecieId-<?= $arbol['id'] ?>">Especie</label>
                        <select class="form-control" id="editEspecieId-<?= $arbol['id'] ?>" name="especie_id" required>
                            <?php foreach ($especies as $especie): ?>
                                <option value="<?= $especie['id'] ?>" <?= $especie['id'] == $arbol['especie_id'] ? 'selected' : '' ?>>
                                    <?= $especie['nombre_comercial'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editUbicacion-<?= $arbol['id'] ?>">Ubicación Geográfica</label>
                        <input type="text" class="form-control" id="editUbicacion-<?= $arbol['id'] ?>" name="ubicacion_geografica" value="<?= $arbol['ubicacion_geografica'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editEstado-<?= $arbol['id'] ?>">Estado</label>
                        <select class="form-control" id="editEstado-<?= $arbol['id'] ?>" name="estado">
                            <option value="Disponible" <?= $arbol['estado'] == 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                            <option value="Vendido" <?= $arbol['estado'] == 'Vendido' ? 'selected' : '' ?>>Vendido</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editPrecio-<?= $arbol['id'] ?>">Precio</label>
                        <input type="number" class="form-control" id="editPrecio-<?= $arbol['id'] ?>" name="precio" step="0.01" value="<?= $arbol['precio'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editFoto-<?= $arbol['id'] ?>">Foto del Árbol</label>
                        <div class="mb-3">
                            <?php if ($arbol['foto']): ?>
                                <img id="previewEditFoto-<?= $arbol['id'] ?>" src="<?= base_url($arbol['foto']) ?>" alt="Foto del Árbol" width="100" class="rounded">
                            <?php else: ?>
                                <span class="text-muted">Sin foto</span>
                            <?php endif; ?>
                        </div>
                        <input type="file" class="form-control" id="editFoto-<?= $arbol['id'] ?>" name="foto">
                        <input type="hidden" name="existing_foto" value="<?= $arbol['foto'] ?>">
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
