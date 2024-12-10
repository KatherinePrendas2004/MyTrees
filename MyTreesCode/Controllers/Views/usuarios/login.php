<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - MyTrees</title>
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
    <div class="card shadow-sm border-0" style="width: 100%; max-width: 380px; border-radius: 10px;">
        <div class="card-body px-5 py-4">
            <h2 class="card-title text-center mb-3 text-muted fw-light" style="font-family: 'Segoe UI', Tahoma, sans-serif;">Inicia Sesión</h2>
            <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">Ingresa tus credenciales</p>

            <!-- Mensajes -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/usuarios/autenticar') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="correo" class="form-label text-muted">Correo</label>
                    <input type="email" class="form-control border-0 shadow-sm" id="correo" name="correo" required placeholder="ejemplo@correo.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-muted">Contraseña</label>
                    <input type="password" class="form-control border-0 shadow-sm" id="password" name="password" required placeholder="Tu contraseña">
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary" style="background-color: #f8b5c6; border-color: #f8b5c6;">Ingresar</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p class="text-muted mb-0" style="font-size: 0.85rem;">¿No tienes una cuenta? <a href="<?= base_url('/usuarios/registro') ?>" class="text-decoration-none" style="color: #f8b5c6;">Regístrate aquí</a>.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
