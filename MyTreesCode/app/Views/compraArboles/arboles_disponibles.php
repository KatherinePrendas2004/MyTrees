<?= view('includes/header') ?>

<div class="container mt-5">
    <div class="p-4 shadow rounded" style="background-color: rgba(255, 255, 255, 0.6); color: #333;">
        <h2 class="text-center mb-4">Árboles Disponibles</h2>

        <div class="table-responsive">
            <table class="table align-middle mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Especie</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($arboles_disponibles)): ?>
                        <?php foreach ($arboles_disponibles as $arbol): ?>
                            <tr>
                                <td><?= htmlspecialchars($arbol['id']) ?></td>
                                <td><?= htmlspecialchars($arbol['especie']) ?></td>
                                <td><?= htmlspecialchars($arbol['ubicacion_geografica']) ?></td>
                                <td>$<?= htmlspecialchars(number_format($arbol['precio'], 2)) ?></td>
                                <td>
                                    <!-- Botón que abre el modal -->
                                    <button class="btn btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#comprarModal<?= $arbol['id'] ?>">
                                        Comprar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="comprarModal<?= $arbol['id'] ?>" tabindex="-1" 
                                 aria-labelledby="comprarModalLabel<?= $arbol['id'] ?>" 
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="comprarModalLabel<?= $arbol['id'] ?>">Confirmar Compra</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- Verificar si 'foto' está definido -->
                                                    <img src="<?= isset($arbol['foto']) && $arbol['foto'] ? base_url($arbol['foto']) : base_url('uploads/default.jpg') ?>" 
                                                         alt="Foto del Árbol" 
                                                         class="img-fluid rounded">
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Especie:</strong> <?= htmlspecialchars($arbol['especie']) ?></p>
                                                    <p><strong>Ubicación:</strong> <?= htmlspecialchars($arbol['ubicacion_geografica']) ?></p>
                                                    <p><strong>Estado:</strong> <?= htmlspecialchars($arbol['estado']) ?></p>
                                                    <p><strong>Precio:</strong> $<?= htmlspecialchars(number_format($arbol['precio'], 2)) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="<?= base_url('compras/confirmar') ?>" method="POST">
                                                <input type="hidden" name="arbol_id" value="<?= $arbol['id'] ?>">
                                                <button type="submit" class="btn btn-success">Confirmar Compra</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay árboles disponibles en este momento.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
