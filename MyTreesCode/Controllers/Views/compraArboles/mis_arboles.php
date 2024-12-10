<?= view('includes/header') ?>

<div class="container mt-5">
    <div class="p-4 shadow rounded" style="background-color: rgba(255, 255, 255, 0.6); color: #333;">
        <h2 class="text-center mb-4">Mis Árboles</h2>

        <div class="table-responsive">
            <table class="table align-middle mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Especie</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($arboles_comprados)): ?>
                        <?php foreach ($arboles_comprados as $arbol): ?>
                            <tr>
                                <td><?= htmlspecialchars($arbol['id']) ?></td>
                                <td><?= htmlspecialchars($arbol['especie']) ?></td>
                                <td><?= htmlspecialchars($arbol['ubicacion_geografica']) ?></td>
                                <td><?= htmlspecialchars($arbol['estado']) ?></td>
                                <td>$<?= htmlspecialchars(number_format($arbol['precio'], 2)) ?></td>
                                <td>
                                    <!-- Botón para ver detalles -->
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detallesModal<?= $arbol['id'] ?>">Ver Detalles</button>
                                    <!-- Botón para ver historial -->
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#historialModal<?= $arbol['id'] ?>">Ver Historial</button>
                                </td>
                            </tr>

                            <!-- Modal para ver detalles -->
                            <div class="modal fade" id="detallesModal<?= $arbol['id'] ?>" tabindex="-1" aria-labelledby="detallesModalLabel<?= $arbol['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detallesModalLabel<?= $arbol['id'] ?>">Detalles del Árbol</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="<?= isset($arbol['foto']) && $arbol['foto'] ? base_url($arbol['foto']) : base_url('uploads/default.jpg') ?>" 
                                                         alt="Foto del Árbol" 
                                                         class="img-fluid rounded">
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>ID:</strong> <?= htmlspecialchars($arbol['id']) ?></p>
                                                    <p><strong>Especie:</strong> <?= htmlspecialchars($arbol['especie']) ?></p>
                                                    <p><strong>Ubicación:</strong> <?= htmlspecialchars($arbol['ubicacion_geografica']) ?></p>
                                                    <p><strong>Estado:</strong> <?= htmlspecialchars($arbol['estado']) ?></p>
                                                    <p><strong>Precio:</strong> $<?= htmlspecialchars(number_format($arbol['precio'], 2)) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal para ver historial -->
                            <div class="modal fade" id="historialModal<?= $arbol['id'] ?>" tabindex="-1" aria-labelledby="historialModalLabel<?= $arbol['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="historialModalLabel<?= $arbol['id'] ?>">Historial de Actualizaciones</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                            <?php if (!empty($historiales[$arbol['id']])): ?>
                                                <?php foreach ($historiales[$arbol['id']] as $actualizacion): ?>
                                                    <div class="mb-3">
                                                        <p><strong>Fecha:</strong> <?= htmlspecialchars($actualizacion['fecha_actualizacion']) ?></p>
                                                        <p><strong>Tamaño:</strong> <?= htmlspecialchars($actualizacion['tamanio']) ?></p>
                                                        <img src="<?= isset($actualizacion['foto']) && $actualizacion['foto'] ? base_url($actualizacion['foto']) : base_url('uploads/default.jpg') ?>" 
                                                             alt="Foto de la actualización" 
                                                             class="img-fluid rounded mb-3">
                                                        <hr>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p class="text-center">No hay actualizaciones para este árbol.</p>
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
                            <td colspan="6" class="text-center">No tienes árboles comprados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>