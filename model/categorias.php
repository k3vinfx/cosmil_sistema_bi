<?php

class categorias
{
    private $pdo;

    public $id;
    public $nombre;
    public $estado;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::Conectar();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listado()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM categoria");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die("Error al listar: " . $e->getMessage());
        }
    }

    public function Guardar(categoria $data)
    {
        try {
            $sql = "INSERT INTO categoria (nombre, estado) VALUES (?, 1)";
            $this->pdo->prepare($sql)->execute([
                $data->nombre
            ]);
            return $this->pdo->lastInsertId();
        } catch(Exception $e) {
            throw new Exception("Error al guardar categoría: " . $e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM categoria WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception("Error al obtener categoría: " . $e->getMessage());
        }
    }

    public function Actualizar(categorias $data)
    {
        try {
            $sql = "UPDATE categoria SET nombre = ? WHERE id = ?";
            return $this->pdo->prepare($sql)->execute([
              
                $data->nombre,
                $data->id
            ]);
        } catch(Exception $e) {
            throw new Exception("Error al actualizar: " . $e->getMessage());
        }
    }

    public function CambiarEstado($id, $estado)
    {
        try {
            $sql = "UPDATE categoria SET estado = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$estado, $id]);
        } catch(Exception $e) {
            throw new Exception("Error al cambiar estado: " . $e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM categoria WHERE id = ?");
            $stm->execute([$id]);
            return true;
        } catch(Exception $e) {
            throw new Exception("Error al eliminar: " . $e->getMessage());
        }
    }
}
