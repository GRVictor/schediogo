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

}