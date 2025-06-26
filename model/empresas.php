<?php

class empresas
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

    public function Listar()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM empresas");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die("Error al listar: " . $e->getMessage());
        }
    }

    public function Guardar(empresas $data)
    {
        try {
            $sql = "INSERT INTO empresas (nombre, estado) VALUES (?, 1)";
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
            $stm = $this->pdo->prepare("SELECT * FROM empresas WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception("Error al obtener categoría: " . $e->getMessage());
        }
    }

    public function Actualizar(empresas $data)
    {
        try {
            $sql = "UPDATE empresas SET nombre = ? WHERE id = ?";
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
            $sql = "UPDATE empresas SET estado = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$estado, $id]);
        } catch(Exception $e) {
            throw new Exception("Error al cambiar estado: " . $e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM empresas WHERE id = ?");
            $stm->execute([$id]);
            return true;
        } catch(Exception $e) {
            throw new Exception("Error al eliminar: " . $e->getMessage());
        }
    }
}
