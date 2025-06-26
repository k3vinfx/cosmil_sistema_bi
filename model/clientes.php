<?php

class clientes
{

  private $pdo;

    public $id;
    public $nombre;
    public $telefono;
    public $email;
    public $direccion;
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

      $stm = $this->pdo->prepare("SELECT * FROM cliente");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
      die($e->getMessage());
    }
  }
   public function Guardar(clientes $data)
    {
        try {
            $sql = "INSERT INTO cliente (nombre, telefono, email, direccion, estado) 
                    VALUES (?, ?, ?, ?, 1)";
            
            $this->pdo->prepare($sql)->execute([
                $data->nombre,
                $data->telefono,
                $data->email,
                $data->direccion
            ]);
            
            return $this->pdo->lastInsertId();
            
        } catch(Exception $e) {
            throw new Exception("Error al guardar cliente: " . $e->getMessage());
        }
    }
    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM cliente WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception("Error al obtener cliente: " . $e->getMessage());
        }
    }
    
  public function CambiarEstado($id, $estado)
    {
        try {
            $sql = "UPDATE cliente SET estado = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$estado, $id]);
        } catch(Exception $e) {
            throw new Exception("Error al cambiar estado: " . $e->getMessage());
        }
    }
    public function Actualizar(clientes $data)
    {
        try {
            $sql = "UPDATE cliente SET 
                    nombre = ?,
                    telefono = ?,
                    email = ?,
                    direccion = ?
                    WHERE id = ?";
            
            return $this->pdo->prepare($sql)->execute([
                $data->nombre,
                $data->telefono,
                $data->email,
                $data->direccion,
                $data->id
            ]);
            
        } catch(Exception $e) {
            throw new Exception("Error al actualizar: " . $e->getMessage());
        }
    }
}
