<?php

class usuarios
{

  private $pdo;

    public $id;
    public $nombre;
    public $clave;
    public $email;
    public $rol_id;
    public $estado;

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
 
  public function Listado()
  {
    try
    {
      $result = array();

      $stm = $this->pdo->prepare("SELECT u.id,u.nombre,u.email, r.nombre as rol , u.estado FROM usuario as u 
      inner join rol as r on u.rol_id = r.id
      WHERE u.estado = 1");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
      die($e->getMessage());
    }
  }
   public function Guardar(usuarios $data)
    {
        try {
            $sql = "INSERT INTO usuario (nombre, email, clave, rol_id) 
                    VALUES (?, ?, ?, ?)";
            
            $this->pdo->prepare($sql)->execute([
                $data->nombre,
                $data->email,
                $data->clave,
                $data->rol_id,              
         
            ]);
            
            return $this->pdo->lastInsertId();
            
        } catch(Exception $e) {
            throw new Exception("Error al guardar usuario: " . $e->getMessage());
        }
    }
    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception("Error al obtener usuario: " . $e->getMessage());
        }
    }
    
  public function CambiarEstado($id, $estado)
    {
        try {
            $sql = "UPDATE usuario SET estado = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$estado, $id]);
        } catch(Exception $e) {
            throw new Exception("Error al cambiar estado: " . $e->getMessage());
        }
    }
    public function Actualizar(usuarios $data)
    {
        try {
            $sql = "UPDATE usuario SET 
                    nombre = ?,
                    email = ?,
                    clave = ?,
                    rol_id = ?
                    WHERE id = ?";
            
            return $this->pdo->prepare($sql)->execute([
                $data->nombre,
                $data->email,
                $data->clave,
                $data->rol_id,
                $data->id
            ]);
            
        } catch(Exception $e) {
            throw new Exception("Error al actualizar: " . $e->getMessage());
        }
    }
}
