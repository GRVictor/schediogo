<?php

namespace Controllers;

use MVC\Router;
use Model\Services;

class ServiceController {
    public static function index(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $router->render('services/index', [
            'name' => $_SESSION['name']
        ]);
    }

    public static function create(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $service = new Services;
        $alerts = [];

        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service->sync($_POST);
            $alerts = $service->validate();

            if(empty($alerts)) {
                $service->save();
                header('Location: /services');
            }
        }

        $router->render('services/create', [
            'name' => $_SESSION['name'],
            'service' => $service,
            'alerts' => $alerts
        ]);

    }

    public static function update(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }

        $router->render('services/update', [
            'name' => $_SESSION['name']
        ]);
    }

    public static function delete(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        }
    }

    
}