<?php

namespace Controllers;

use Model\AppointmentServices;
use Model\Appointment;
use Model\Services;

class APIController {
    public static function index() {
        $services = Services::all();
        echo json_encode($services);
    }

    public static function save() {

        // Store the appointment and return the ID
        $appointment = new Appointment($_POST);
        $result = $appointment->save();

        $id = $result['id'];

        // Store the appointment and services

        $idServices = explode(',', $_POST['services']);

        // Store services wtih the appointment ID
        foreach($idServices as $idService) {
            $args = [
                'appointmentId' => $id,
                'serviceId' => $idService
            ];
            $appointmentService = new AppointmentServices($args);
            $appointmentService->save();
        }

        echo json_encode(['result' => $result]);
    }

    public static function delete() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $appointment = Appointment::find($id);
            $appointment->delete();
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

}