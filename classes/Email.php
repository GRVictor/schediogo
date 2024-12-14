<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $name;
    public $token;

    public function __construct($email, $name, $token) {
        
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendEmail() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io'; 

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'bcef7b412e58da';
        $mail->Password = '5fa5d8ad9a8bf6';

        $mail->setFrom('accounts@schediogo.com');
        $mail->addAddress('accounts@schediogo.com', 'Schedio / Go Team');
        $mail->Subject = 'Activa tu cuenta';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= '<p> <strong>' . $this->name . '</strong>, confirma tu cuenta dando clic al siguiente enlace </p>';
        $content .= '<p> <a href="http://localhost:3000/activate?token=' . $this->token . '">Activar cuenta</a> </p>';
        $content .= '<p> Si no creaste una cuenta con nosotros, ignora este mensaje </p>';
        $content .= '</html>';

        $mail->Body = $content;

        // Send email
        $mail->send();
    }

    public function sendInstructions() {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io'; 

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'bcef7b412e58da';
        $mail->Password = '5fa5d8ad9a8bf6';

        $mail->setFrom('accounts@schediogo.com');
        $mail->addAddress('accounts@schediogo.com', 'Schedio / Go Team');
        $mail->Subject = 'Restablece tu contraseña';

        // Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $content = '<html>';
        $content .= '<p> <strong>' . $this->name . '</strong>, solicitaste un cambio de contraseña, haz clic en el enlace para reestablecer tu contraseña. </p>';
        $content .= '<p> <a href="http://localhost:3000/recover?token=' . $this->token . '">Restablecer contraseña</a> </p>';
        $content .= '<p> Si no solicitaste un restablecimiento de contraseña, ignora este mensaje. </p>';
        $content .= '</html>';

        $mail->Body = $content;

        // Send email
        $mail->send();
    }

}