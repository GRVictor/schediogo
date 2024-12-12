<?php

namespace Model;

class User extends ActiveRecord {
    // Data Base
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'name', 'last_name' ,'email', 'password' , 'phone', 'admin', 'confirmed', 'token'];

    // Properties
    public $id;
    public $name;
    public $last_name;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $confirmed;
    public $token;

    // Constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    // Validations
    public function validateNewAccount() {
        if(!$this->name || trim($this->name) === '') {
            self::$alerts['error'][] = 'El nombre es obligatorio';
        } else if (!preg_match('/^[\p{L}\s]+$/u', $this->name)) {
            self::$alerts['error'][] = 'El nombre solo puede contener letras y espacios';
        }
    
        if(!$this->last_name || trim($this->last_name) === '') {
            self::$alerts['error'][] = 'El apellido es obligatorio';
        } else if (!preg_match('/^[\p{L}\s]+$/u', $this->last_name)) {
            self::$alerts['error'][] = 'El apellido solo puede contener letras y espacios';
        }

        if(!$this->email || trim($this->email) === '') {
            self::$alerts['error'][] = 'El email es obligatorio';
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'El email tiene un formato incorrecto';
        }
    
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        } else {
            if(strlen($this->password) < 8) {
                self::$alerts['error'][] = 'La contraseña debe tener al menos 6 caracteres';
            }
    
            if(!preg_match('/[\W]/', $this->password)) {
                self::$alerts['error'][] = 'La contraseña debe contener al menos un símbolo';
            }
        }
    
        return self::$alerts;
    }

    // Check if user exists
    public function userExists() {
        $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $result = self::$db->query($query);

        if(!$result->num_rows) {
            self::$alerts['error'][] = 'El email ya está registrado';
        }

        return $result;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generateToken() {
        $this->token = bin2hex(random_bytes(10));
    }

    

}