<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/usuarios/registro', 'UsuariosController::index');
$routes->post('/usuarios/registrar', 'UsuariosController::registrar');

$routes->get('/usuarios/login', 'UsuariosController::login'); // Ruta para el formulario de inicio de sesión
$routes->post('/usuarios/autenticar', 'UsuariosController::autenticar'); // Ruta para autenticar al usuario
$routes->get('/usuarios/logout', 'UsuariosController::logout'); // Cierra la sesión

$routes->get('/dashboard/tableroAdmin', 'DashboardController::indexAdmin');
$routes->get('/dashboard/tableroOperador', 'DashboardController::indexOperador');

$routes->get('/especiesAdmin/crud_especies', 'EspeciesController::index');
$routes->post('/especiesAdmin/agregar', 'EspeciesController::agregar');
$routes->post('/especiesAdmin/editar/(:num)', 'EspeciesController::editar/$1');
$routes->get('/especiesAdmin/eliminar/(:num)', 'EspeciesController::eliminar/$1');

$routes->get('/adminUsuarios/admin_usuarios', 'AdminUsuariosController::index');
$routes->post('/adminUsuarios/agregar', 'AdminUsuariosController::agregar');
$routes->post('/adminUsuarios/editar/(:num)', 'AdminUsuariosController::editar/$1');
$routes->get('/adminUsuarios/eliminar/(:num)', 'AdminUsuariosController::eliminar/$1');

// Gestión de árboles
$routes->get('/arbolesAdmin/crud_arboles', 'ArbolesController::index'); // Listar árboles
$routes->post('/arbolesAdmin/agregar', 'ArbolesController::agregar'); // Agregar un árbol
$routes->post('/arbolesAdmin/editar/(:num)', 'ArbolesController::editar/$1'); // Editar un árbol
$routes->get('/arbolesAdmin/eliminar/(:num)', 'ArbolesController::eliminar/$1'); // Eliminar un árbol

$routes->get('/amigosAdmin/arboles/(:num)', 'ArbolesController::verArboles/$1'); // Ver árboles de un amigo
$routes->get('/amigosAdmin/listaAmigos', 'AmigosController::index'); // Listar amigos
$routes->post('/amigosAdmin/agregarActualizacion', 'ActualizacionesController::agregarActualizacion');
$routes->get('/amigosAdmin/actualizaciones/(:num)', 'ActualizacionesController::index/$1');

$routes->get('/compraArboles/arboles_disponibles', 'ArbolesController::arbolesDisponibles');
