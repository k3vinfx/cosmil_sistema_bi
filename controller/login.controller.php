<?php
require_once 'model/login.php';

class LoginController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new login();
    }

    //Llamado plantilla principal
    public function Index(){
       //require_once 'view/header.php';
        require_once 'view/inicio/login.php';
       require_once 'view/footerx.php';
    }
    public function LoginError(){
        $login = new login();
        require_once 'view/inicio/login.php';
        require_once 'view/footerx.php';

      //  $alert = '<div class="alert alert-danger" role="alert">
       // Ingrese su usuario y su clave
       // </div>';
    
        ?>
        <script>
            alert("Error de CorreoElectronico o Contraseña.");
        </script><?php 
    }   


   


    public function Login() {
        $login = new login();

        if(isset($_REQUEST['CorreoElectronico']) && isset($_REQUEST['Contrasena'])) {
            // Enviar la contraseña en texto plano para que el modelo la verifique con el hash
            $usuario = $this->model->Login($_REQUEST['CorreoElectronico'], $_REQUEST['Contrasena']);

            if ($usuario !== false) {
                $_SESSION["logged_in"] = true;
                $_SESSION["session_rol_id"] = $usuario->rol_id;
                $_SESSION["session_usuario"] = $usuario->nombre;
                $_SESSION["session_id"] = $usuario->id;

                header('Location: index.php?c=productos');
                exit();
            } else {
                // Mostrar error en la misma página de login
                require_once 'view/inicio/login.php';
            }
        } else {
            // Si faltan campos, mostrar el formulario de login
            require_once 'view/inicio/login.php';
        }
    }

    public function Guardar(){
        $login = new login();

        $login->CorreoElectronico = $_REQUEST['CorreoElectronico'];


        $this->model->Registrar($prod);

        header('Location: index.php?c=producto');
    }

}
?>