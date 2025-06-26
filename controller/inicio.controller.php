<?php
//Se incluye el modelo donde conectará el controlador.
require_once 'model/login.php';

class InicioController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new login();
    }

    //Llamado plantilla principal
    public function Index(){
        //require_once 'view/header.php';
        $login = new login();
        require_once 'view/inicio/login.php';
       // require_once 'view/footerx.php';
    }

    //Llamado a la vista proveedor-nuevo
    public function Login(){
        $login = new login();

        //Llamado de las vistas.
         require_once 'view/inicio/login.php';
       
    }
       //Llamado a la vista proveedor-nuevo
    public function LoginError(){
        $login = new login();

        //Llamado de las vistas.
         require_once 'view/inicio/login.php';
       
    }
        //Registrate

     public function Registrate(){
        $login = new login();
             //Llamado de las vistas.
        require_once 'view/Registro/nuevo_usuario.php';
          
    }

        public function registrar() {
        header('Content-Type: application/json');
        
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception("Método no permitido");
            }

            // Validaciones
            if (empty($_POST['nombre']) || strlen($_POST['nombre']) < 3) {
                throw new Exception("El nombre debe tener al menos 3 caracteres");
            }

            if (empty($_POST['telefono']) || !preg_match('/^[0-9]{8,15}$/', $_POST['telefono'])) {
                throw new Exception("Teléfono inválido (8-15 dígitos)");
            }

            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email inválido");
            }

            if (empty($_POST['clave']) || strlen($_POST['clave']) < 8) {
                throw new Exception("La contraseña debe tener al menos 8 caracteres");
            }

            if ($_POST['clave'] !== $_POST['confirm_clave']) {
                throw new Exception("Las contraseñas no coinciden");
            }

            if (empty($_POST['direccion']) || strlen($_POST['direccion']) < 10) {
                throw new Exception("La dirección debe tener al menos 10 caracteres");
            }

            // Preparar datos
            $datos = [
                'nombre' => htmlspecialchars(trim($_POST['nombre'])),
                'telefono' => trim($_POST['telefono']),
                'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
                'clave' => password_hash($_POST['clave'], PASSWORD_DEFAULT),
                'direccion' => htmlspecialchars(trim($_POST['direccion']))
            ];

            // Intentar registro
            if (!$this->model->registrarUsuario($datos)) {
                throw new Exception("El correo electrónico ya está registrado");
            }

            echo json_encode(['success' => true, 'message' => 'Registro guardado exitosamente']);
            
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
