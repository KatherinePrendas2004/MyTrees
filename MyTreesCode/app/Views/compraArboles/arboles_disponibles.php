<?= view('includes/header') ?>

<div class="container mt-5">
    <!-- Contenedor con fondo blanco translúcido -->
    <div class="p-4 shadow rounded" style="background-color: rgba(255, 255, 255, 0.6); color: #333;">
        <h2 class="text-center mb-4" style="color: #333;">Árboles Disponibles</h2>

        <!-- Tabla de Árboles Disponibles -->
        <div class="table-responsive">
            <table class="table align-middle mt-3" style="border-collapse: separate; border-spacing: 0 10px; color: #333;">
                <thead style="color: #333;">
                    <tr>
                        <th style="border-bottom: 1px solid #333;">ID</th>
                        <th style="border-bottom: 1px solid #333;">Especie</th>
                        <th style="border-bottom: 1px solid #333;">Ubicación</th>
                        <th style="border-bottom: 1px solid #333;">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($arboles_disponibles)): ?>
                        <?php foreach ($arboles_disponibles as $arbol): ?>
                            <tr style="border-bottom: 1px solid #333;">
                                <td><?= htmlspecialchars($arbol['id']) ?></td>
                                <td><?= htmlspecialchars($arbol['especie']) ?></td>
                                <td><?= htmlspecialchars($arbol['ubicacion_geografica']) ?></td>
                                <td>$<?= htmlspecialchars(number_format($arbol['precio'], 2)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay árboles disponibles en este momento.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

