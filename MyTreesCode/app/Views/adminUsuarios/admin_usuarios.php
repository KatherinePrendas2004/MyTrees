<?= view('includes/header') ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Administración de Usuarios</h2>

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

    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Usuario</button>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <?php if (in_array($usuario['rol'], ['admin', 'operador'])): ?>
                    <tr>
                        <td><?= $usuario['id'] ?></td>
                        <td><?= $usuario['nombre'] . ' ' . $usuario['apellidos'] ?></td>
                        <td><?= $usuario['correo'] ?></td>
                        <td><?= $usuario['telefono'] ?></td>
                        <td><?= ucfirst($usuario['rol']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $usuario['id'] ?>">Editar</button>
                            <a href="/usuarios/eliminar/<?= $usuario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/adminUsuarios/agregar" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre" required>
                    <input type="text" name="apellidos" class="form-control mb-3" placeholder="Apellidos" required>
                    <input type="text" name="telefono" class="form-control mb-3" placeholder="Número de Teléfono" required>
                    <input type="email" name="correo" class="form-control mb-3" placeholder="Correo Electrónico" required>
                    <input type="text" name="direccion" class="form-control mb-3" placeholder="Dirección" required>
                    <input type="text" name="pais" class="form-control mb-3" placeholder="País" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required>
                    <select name="rol" class="form-select" required>
                        <option value="operador">Operador</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modales Editar -->
<?php foreach ($usuarios as $usuario): ?>
    <?php if (in_array($usuario['rol'], ['admin', 'operador'])): ?>
        <div class="modal fade" id="editModal-<?= $usuario['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/adminUsuarios/editar/<?= $usuario['id'] ?>" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="nombre" class="form-control mb-3" value="<?= $usuario['nombre'] ?>" required>
                            <input type="text" name="apellidos" class="form-control mb-3" value="<?= $usuario['apellidos'] ?>" required>
                            <input type="text" name="telefono" class="form-control mb-3" value="<?= $usuario['telefono'] ?>" required>
                            <input type="email" name="correo" class="form-control mb-3" value="<?= $usuario['correo'] ?>" required>
                            <input type="text" name="direccion" class="form-control mb-3" value="<?= $usuario['direccion'] ?>" required>
                            <input type="text" name="pais" class="form-control mb-3" value="<?= $usuario['pais'] ?>" required>
                            <input type="password" name="password" class="form-control mb-3" value="<?= $usuario['password'] ?>" required>
                            <select name="rol" class="form-select" required>
                                <option value="operador" <?= $usuario['rol'] === 'operador' ? 'selected' : '' ?>>Operador</option>
                                <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
