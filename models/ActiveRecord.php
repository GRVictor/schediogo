<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    // Alertas y Mensajes
    protected static $alerts = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    // Validación
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function querySQL($query) {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($record = $result->fetch_assoc()) {
            $array[] = static::createObjet($record);
        }

        // liberar la memoria
        $result->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function createObjet($record) {
        $objet = new static;

        foreach($record as $key => $value ) {
            if(property_exists( $objet, $key )) {
                $objet->$key = $value;
            }
        }

        return $objet;
    }

    // Identificar y unir los atributos de la BD
    public function attributes() {
        $attributes = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Sincroniza BD con Objetos en memoria
    public function sync($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            // actualizar
            $result = $this->update();
        } else {
            // Creando un nuevo registro
            $result = $this->create();
        }
        return $result;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result = self::querySQL($query);
        return $result;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = {$id}";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT {$limit}";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Busca un registro por su id
    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table  ." WHERE ${column} = '{$value}'";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Flat Query SQL (Use it when the model is not enough)
    public static function SQL($query) {
        $result = self::querySQL($query);
        return $result;
    }

    // crea un nuevo registro
    public function create() {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();

        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$table . " (";
        $query .= join(', ', array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";

        // With this line you can see the query, very useful for debugging
        // return json_encode(['query' => $query]);

        // Resultado de la consulta
        $result = self::$db->query($query);
        return [
           'result' =>  $result,
           'id' => self::$db->insert_id
        ];
    }

    // Actualizar el registro
    public function update() {
        // Sanitizar los datos
        $attributes = $this->sanitizeAttributes();

        // Iterar para ir agregando cada campo de la BD
        $values = [];
        foreach($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $result = self::$db->query($query);
        return $result;
    }

    // Eliminar un Registro por su ID
    public function delete() {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

}