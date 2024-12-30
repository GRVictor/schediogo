<?php
 
namespace Controllers;

use MVC\Router;

class AppointmentController {
    public static function index(Router $router) {

        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAuth();

        $router->render('appointment/index', [
            'name' => $_SESSION['name'] ?? null,
            'id' => $_SESSION['id'] ?? null
        ]);
    }
}