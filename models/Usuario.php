<?php 

namespace Model; 

class Usuario extends ActiveRecord{
    // Bse de datos 
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','password','telefono'
    ,'admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '' ;
    
    }

    // mensajes de vaidacion para la creacion de una cuenta 

    public function validarNuevaCuenta(){
        if(!$this->nombre) {
            self::$alertas['error'][] = "El nombre del  es obligatorio";
        }
          if(!$this->apellido) {
            self::$alertas['error'][] = "El apellido del  es obligatorio";
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = "El telefono del  es obligatorio";
        }
        if(!$this->email) {
            self::$alertas['error'][] = "El E-mail del  es obligatorio";
        }
        if(!$this->password) {
            self::$alertas['error'][] = "El password del  es obligatorio";
        }
        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = "El password debe de contener al menos 6 caracteres";

        }

        return self::$alertas;
    }

       public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 ";

       $resultado = self::$db->query($query);

      if($resultado->num_rows) {
        self::$alertas['error'][] = 'El usuario ya esta registrado';
      }
      return $resultado;
    }

    }