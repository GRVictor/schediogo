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
                            header('Location: /appointment');

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
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function forgot(Router $router) {
        
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validateEmail();

            if(empty($alerts)) {
                $user = User::where('email', $auth->email);

                if($user && $user->confirmed === "1") {
                    // Generate token
                    $user->generateToken();

                    // Save token
                    $user->save();

                    User::setAlert('success', 'Revisa tu email para recuperar tu contraseña');

                    // Send email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();

                } else if ($user && $user->confirmed === 0) {
                    User::setAlert('error', 'Cuenta no confirmada, revisa tu email');
                } else {
                    User::setAlert('error', 'El usuario no existe');
                }
            } 

        }

        $alerts = User::getAlerts();

        $router->render('auth/forgot', [
            'alerts' => $alerts
        ]);
    }

    public static function recover(Router $router) {

        $alerts = [];
        $error = false;

        $token = s($_GET['token']);

        // Search for user with token
        $user = User::where('token', $token);

        if(empty($user)) {
            User::setAlert('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new User($_POST);
            $alerts = $password->validateNewPassword();

            if(empty($alerts)) {
                // Save new password
                $user->password = null;
                $user->password = $password->password;
                $user->hashPassword();
                $user->token = '';
                $result = $user->save();

                if($result) {
                    // Crear mensaje de exito
                    User::setAlert('success', 'Contraseña actualizada, inicia sesión');
                                    
                    // Redireccionar al login tras 3 segundos
                    header('Refresh: 3; url=/');
                }

            }

        }
        
        $alerts = User::getAlerts();

        $router->render('auth/recover', [
            'alerts' => $alerts,
            'error' => $error
        ]);
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