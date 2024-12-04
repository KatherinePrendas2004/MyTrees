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
                        <th>Foto</th>
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
                                    <img src="<?= isset($arbol['foto']) && $arbol['foto'] ? base_url($arbol['foto']) : base_url('uploads/default.jpg') ?>" 
                                         alt="Foto del Árbol" 
                                         class="img-fluid rounded" 
                                         style="max-width: 100px; height: auto;">
                                </td>
                            </tr>
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
