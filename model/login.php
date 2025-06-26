<?php

session_start();
class login
{

  public $CorreoElectronico;
  public $Contrasena;
  private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

  public function registrarUsuario($datos) {
         try {
        // Verificar si el email ya existe
        $query = "SELECT id FROM cliente WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return false;
        }
        
        // Consulta SQL
        $query = "INSERT INTO cliente (nombre, telefono, email, clave, direccion) 
                VALUES (:nombre, :telefono, :email, :clave, :direccion)";
        
        // Preparar y ejecutar
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':telefono', $datos['telefono']);
        $stmt->bindParam(':email', $datos['email']);
        $stmt->bindParam(':clave', $datos['clave']);
        $stmt->bindParam(':direccion', $datos['direccion']);

        return $stmt->execute();
        
    } catch (PDOException $e) {
        error_log("Error en registrarUsuario: " . $e->getMessage());
        return false;
    }
    }
    
    private function existeEmail($email) {
        $query = "SELECT id FROM cliente WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    public function Login($CorreoElectronico, $Contrasena) {
        try {
            // 1. Buscar usuario por email
            $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ?");
            $stm->execute(array($CorreoElectronico));
            $usuario = $stm->fetch(PDO::FETCH_OBJ);

            // 2. Verificar si el usuario existe y la contraseña coincide
            if ($usuario && password_verify($Contrasena, $usuario->clave)) {
                return $usuario;
            }
            
            return false;
            
        } catch (Exception $e) {
            error_log("Error en Login: " . $e->getMessage());
            return false;
        }
    }
  
    public function ObtenerSecion($usuario)
    {
      try
      {
        $stm = $this->pdo->prepare("SELECT usuario FROM  usuario WHERE usuario = ?");
        $stm->execute(array($usuario));
      
        $resultado = $stm->fetch(PDO::FETCH_OBJ);
        if ($resultado) {
        $_SESSION["logged_in"] = true;
        $_SESSION["session_usuario"] = $usuario->usuario;
      
      }
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e)
      {
        die($e->getMessage());
      }
    }
	
}

/*
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = '<div class="alert alert-danger" role="alert">
  Ingrese su usuario y su clave
</div>';
    } else {
      require_once "conexion.php";
      $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
      $query = mysqli_query($conexion, "SELECT u.IDUsuario, u.Nombres, u.Apellidos, u.CorreoElectronico,r.IDRol,r.Rol 
      
      FROM usuario u INNER JOIN roles r ON u.IDRol = r.IDRol WHERE u.CorreoElectronico = '$user' AND u.Contrasena = '$clave' AND u.Estado=1");
      mysqli_close($conexion);
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) {
        $dato = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['IdUser'] = $dato['IDUsuario'];
        $_SESSION['Nombres'] = $dato['Nombres'];
        $_SESSION['Apellidos'] = $dato['Apellidos'];
        $_SESSION['Correo'] = $dato['CorreoElectronico'];


        $_SESSION['CarnetIdentidad'] = $dato['CarnetIdentidad'];
        $_SESSION['rol'] = $dato['IDRol'];
        $_SESSION['rol_name'] = $dato['Rol'];
        header('location: sistema/');
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
              Usuario o Contraseña Incorrecta
            </div>';
        session_destroy();
      }
    }
  }
}*/
?>


