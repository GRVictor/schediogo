<?php

namespace Controllers;

use Model\User;
use MVC\Router;


class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login');
    }

    public static function logout() {
        echo 'Desde Logout';
    }

    public static function forgot(Router $router) {
        
        $router->render('auth/forgot');
    }

    public static function recover() {
        echo 'Desde Recover';
    }

    public static function signUp(Router $router) {
        $user = new User;

        // Empty alerts
        $alerts = [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sync($_POST);
            $alerts = $user->validateNewAccount();

            // If there are no errors, the array alerts is empty
            if(empty($alerts)) {
                // Validate if the user already exists
            }

        }

        $router->render('auth/sign-up', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

}