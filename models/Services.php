<?php

namespace Model;

class Services extends ActiveRecord {
    // Database 
    protected static $table = 'services';
    protected static $columnsDB = ['id', 'service_name', 'price'];

    // Variables
    public $id;
    public $service_name;
    public $price;

    // Constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->service_name = $args['service_name'] ?? '';
        $this->price = $args['price'] ?? '';
    }

    public function validate() {

        if(!$this->service_name) {
            self::$alerts['error'][] = 'El nombre del servicio es obligatorio';
        }
        if(!$this->price) {
            self::$alerts['error'][] = 'El precio del servicio es obligatorio';
        } elseif(!is_numeric($this->price)) {
            self::$alerts['error'][] = 'El precio del servicio debe ser un número';
        }

        return self::$alerts;
    }

}