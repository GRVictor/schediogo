<?php

namespace Controllers;

use Model\AdminAppointment;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Database query
        $consult = "SELECT appointments.id, appointments.time, CONCAT( users.name, ' ', users.last_name) as client, ";
        $consult .= " users.email, users.phone, services.service_name as service, services.price  ";
        $consult .= " FROM appointments ";
        $consult .= " LEFT OUTER JOIN users ";
        $consult .= " ON appointments.userId=users.id  ";
        $consult .= " LEFT OUTER JOIN appointmentsservices ";
        $consult .= " ON appointmentsservices.appointmentId=appointments.id ";
        $consult .= " LEFT OUTER JOIN services ";
        $consult .= " ON services.id=appointmentsservices.serviceId ";
        // $consulta .= " WHERE date =  '${date}' ";

        $appointments = AdminAppointment::SQL($consult);

        $router->render('admin/index', [
           'name' => $_SESSION['name'],
            'appointments' => $appointments
        ]);
    }
}