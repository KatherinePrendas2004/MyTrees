<?php
// Inicia la sesión si aún no ha sido iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyTrees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Fondo general */
        body {
            background-image: url('/uploads/FondoDentro.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding-top: 70px; /* Espacio para el navbar */
        }
        .navbar {
            background-color: rgba(255, 245, 245, 0.8); /* Fondo translúcido */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra */
        }
        .navbar-brand {
            font-weight: bold;
            color: #5a5a5a !important;
        }
        .navbar-nav .nav-link {
            color: #6c757d !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover {
            color: #495057 !important;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">MyTrees</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <?php if ($_SESSION['user_role'] === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="/dashboard/tableroAdmin">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="/adminUsuarios/admin_usuarios">Administrar Usuarios</a></li>
                            <li class="nav-item"><a class="nav-link" href="/especiesAdmin/crud_especies">Administrar Especies</a></li>
                            <li class="nav-item"><a class="nav-link" href="/arbolesAdmin/crud_arboles">Administrar Árboles</a></li>
                            <li class="nav-item"><a class="nav-link" href="/amigosAdmin/listaAmigos">Administrar Amigos</a></li>
                        <?php elseif ($_SESSION['user_role'] === 'amigo'): ?>
                            <li class="nav-item"><a class="nav-link" href="/compraArboles/arboles_disponibles">Árboles</a></li>
                            <li class="nav-item"><a class="nav-link" href="/compraArboles/mis_arboles">Mis Árboles</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/usuarios/logout">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/usuarios/login">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="/usuarios/registro">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
