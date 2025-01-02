<?php

namespace Model;

class AdminAppointment extends ActiveRecord {
    protected static $table = 'appointmentsservices';
    protected static $columns = ['id', 'time', 'client', 'email', 'phone', 'service', 'price'];

    public $id;
    public $time;
    public $client;
    public $email;
    public $phone;
    public $service;
    public $price;

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->time = $data['time'] ?? null;
        $this->client = $data['client'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->service = $data['service'] ?? null;
        $this->price = $data['price'] ?? null;
    }
    
}