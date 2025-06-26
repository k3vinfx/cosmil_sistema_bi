<?php

class proveedor
{
    private $pdo;

    public $id;
    public $nombre;
    public $contacto;

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
            $stm = $this->pdo->prepare("SELECT * FROM proveedores");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Guardar(proveedor $data)
    {
        try {
            $sql = "INSERT INTO proveedores (nombre, contacto) VALUES (?, ?)";
            $this->pdo->prepare($sql)->execute([
                $data->nombre,
                $data->contacto
            ]);
            return $this->pdo->lastInsertId();
        } catch(Exception $e) {
            throw new Exception("Error al guardar: " . $e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT id, nombre, contacto FROM proveedores WHERE id = ?");
            $stm->execute([$id]);
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            throw new Exception("Error al obtener: " . $e->getMessage());
        }
    }

    public function Actualizar(proveedor $data)
    {
        try {
            $sql = "UPDATE proveedores SET nombre = ?, contacto = ? WHERE id = ?";
            return $this->pdo->prepare($sql)->execute([
                $data->nombre,
                $data->contacto,
                $data->id
            ]);
        } catch(Exception $e) {
            throw new Exception("Error al actualizar: " . $e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $sql = "DELETE FROM proveedores WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch(Exception $e) {
            throw new Exception("Error al eliminar: " . $e->getMessage());
        }
    }
}