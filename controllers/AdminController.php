<?php

namespace Controllers;

use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $router->render('admin/index', [
           'name' => $_SESSION['name']
        ]);
    }
}