<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ServiceController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\AppointmentController;
use Controllers\APIController;
use MVC\Router;

$router = new Router();

// Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);
$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

// Crear cuenta
$router->get('/sign-up', [LoginController::class, 'signUp']);
$router->post('/sign-up', [LoginController::class, 'signUp']);

// Confirmar cuenta
$router->get('/activate', [LoginController::class, 'activate']);
$router->get('/message', [LoginController::class, 'message']);

// Private Area
$router->get('/appointment', [AppointmentController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);


// Apointment API
$router->get('/api/services', [APIController::class, 'index']);
$router->post('/api/appointments', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

// Services CRUD
$router->get('/services', [ServiceController::class, 'index']);
$router->get('/services/create', [ServiceController::class, 'create']);
$router->post('/services/create', [ServiceController::class, 'create']);
$router->get('/services/update', [ServiceController::class, 'update']);
$router->post('/services/update', [ServiceController::class, 'update']);
$router->post('/services/delete', [ServiceController::class, 'delete']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->checkRoutes();