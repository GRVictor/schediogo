<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;


class LoginController {
    public static function login(Router $router) {
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);

            $alerts = $auth->validateLogin();

            if(empty($alerts)) {
                $user = User::where('email', $auth->email);

                if($user) {
                    // Verify password

                    if($user -> validatePassword($auth->password)){
                        // Authenticate user
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . ' ' . $user->last_name;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        // Redirect

                        if($user->admin == 1) {
                            $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /date');

                    }

                    
                } else {
                    
                    User::setAlert('error', 'El usuario no existe');
                }

            }

        }
    }

        $alerts = User::getAlerts();

        $router->render('auth/login', [
            'alerts' => $alerts
        ]);

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
                $result = $user->userExists();

                if($result->num_rows) {
                    $alerts = User::getAlerts();
                } else {
                    // Create a new user

                    // Hash the password
                    $user->hashPassword();

                    // Generate a token
                    $user->generateToken();

                    // Send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendEmail();

                    // Create user
                    $result = $user->save();

                    if($result) {
                        header('Location: /message');
                    }

                    // debug($user);
                } 
            }

        }

        $router->render('auth/sign-up', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function message(Router $router) {
        $router->render('auth/message');
    }

    public static function activate(Router $router) {

        $alerts = [];

        $token = s($_GET['token']);

        $user = User::where('token', $token);

        if(empty($user)) {
            // Show error
            User::setAlert('error', 'Token no válido');
        } else {
            // User confirmed
            User::setAlert('success', 'Cuenta confirmada');

            $user->confirmed = 1;
            $user->token = '';
            $user->save();
        }



        $alerts = User::getAlerts();
        $router->render('auth/activate', [
            'alerts' => $alerts
        ]);
    }

}