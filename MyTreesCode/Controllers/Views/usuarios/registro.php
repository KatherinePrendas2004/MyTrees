<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Amigo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Configuración de fondo */
        body {
            background-image: url('https://i.postimg.cc/NF4X7SYL/Fondo.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="card shadow-sm border-0" style="width: 100%; max-width: 600px; border-radius: 10px;">
        <div class="card-body px-5 py-4">
            <h2 class="card-title text-center mb-3 text-muted fw-light" style="font-family: 'Segoe UI', Tahoma, sans-serif;">Registro de Amigo</h2>

            <!-- Mensajes de error o éxito -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Formulario -->
            <form action="<?= base_url('/usuarios/registrar') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label text-muted">Nombre</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="nombre" name="nombre" required placeholder="Ingresa tu nombre">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellidos" class="form-label text-muted">Apellidos</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="apellidos" name="apellidos" required placeholder="Ingresa tus apellidos">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label text-muted">Número de Teléfono</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="telefono" name="telefono" required placeholder="Ej: +123456789">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pais" class="form-label text-muted">País</label>
                        <input type="text" class="form-control border-0 shadow-sm" id="pais" name="pais" required placeholder="Ej: Costa Rica">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="correo" class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" class="form-control border-0 shadow-sm" id="correo" name="correo" required placeholder="ejemplo@correo.com">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label text-muted">Contraseña</label>
                        <input type="password" class="form-control border-0 shadow-sm" id="password" name="password" required placeholder="Elige una contraseña">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="direccion" class="form-label text-muted">Dirección</label>
                        <textarea class="form-control border-0 shadow-sm" id="direccion" name="direccion" required placeholder="Tu dirección completa" style="resize: none;"></textarea>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary" style="background-color: #f8b5c6; border-color: #f8b5c6;">Registrarse</button>
                    <p class="text-center mb-0" style="font-size: 0.85rem;">Ya tienes una cuenta? <a href="<?= base_url('/usuarios/login') ?>" class="text-decoration-none" style="color: #f8b5c6;">Inicia sesión aquí</a>.</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
