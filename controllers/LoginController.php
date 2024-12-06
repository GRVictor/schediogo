<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login');
    }

    public static function logout() {
        echo 'Desde Logout';
    }

    public static function forgot() {
        echo 'Desde Forgot';
    }

    public static function recover() {
        echo 'Desde Recover';
    }

    public static function signIn(Router $router) {
        $router->render('auth/sign-in', [
            
        ]);
    }

}