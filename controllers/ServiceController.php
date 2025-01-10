<?php

namespace Controllers;

use MVC\Router;
use Model\Services;

class ServiceController {
    public static function index(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        $services = Services::all();

        $router->render('services/index', [
            'name' => $_SESSION['name'],
            'services' => $services
        ]);
    }

    public static function create(Router $router) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

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

        isAdmin();

        if(!is_numeric($_GET['id'])) {
            header('Location: /services');
        }
        $service = Services::find($_GET['id']);
        $alerts = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service->sync($_POST);
            $alerts = $service->validate();
            if(empty($alerts)) {
                $service->update();
                header('Location: /services');
            }
        }

        $router->render('services/update', [
            'name' => $_SESSION['name'],
            'service' => $service,
            'alerts' => $alerts
        ]);
    }

    public static function delete() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $service = Services::find($id);
            $service->delete();
            header('Location: /services');
        }
    }
}