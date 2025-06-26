<?php

class productos
{

	private $pdo;

    public $idProducto;
 


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
    public function crearPedido($idPro, $idCliente, $cantidad, $estado = 1)
    {
        try {
            $sql = "INSERT INTO carrito (
                idPro, 
                idCliente, 
                cantidad, 
                estado
            ) VALUES (?, ?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);
            
            return $stmt->execute([
                $idPro,
                $idCliente,
                $cantidad,
                $estado        
            ]);
            
        } catch (Exception $e) {
            // Registrar el error en logs
            error_log("Error al crear pedido: " . $e->getMessage());
            return false;
        }
    }
    
	
    public function MenuListaCategoria()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM categoria where estado = 1");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die("Error al listar: " . $e->getMessage());
        }
    }

    public function MenuListaEmpresa()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM empresas where estado = 1");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die("Error al listar: " . $e->getMessage());
        }
    }

	public function MenuListacategoriaSerigrafico()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM categoria where id = 2");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch(Exception $e) {
            die("Error al listar: " . $e->getMessage());
        }
    }
	
	public function MenuLista1()
	{
		try
		{

			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM producto where categoria_id ='2'");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function MenuLista2()
	{
		try
		{

			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM producto where categoria_id ='1'");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function MenuTipo()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM categoria");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function ListarVestir()
    {
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT p.id,p.nombre,p.detalle,p.precio,p.stock,p.imagen,c.nombre as nomrecat,p.estado 
			FROM producto as p inner join categoria c on c.id= p.id_cat where p.id_cat=1 ; ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
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

			$stm = $this->pdo->prepare("SELECT p.id,p.nombre,p.detalle,p.precio,p.stock,p.imagen,c.nombre as nomrecat,p.estado 
			FROM producto as p inner join categoria c on c.id= p.id_cat; ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
    public function CambiarEstado($id, $estado)
    {
        try {
            $sql = "UPDATE producto SET estado = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$estado, $id]);
        } catch(Exception $e) {
            throw new Exception("Error al cambiar estado: " . $e->getMessage());
        }
    }
    public function agregar($nombre, $precio, $stock, $imagen, $categoria_id, $detalle)
    {
        try {
            $sql = "INSERT INTO producto (
                nombre, 
                detalle, 
                precio, 
                stock, 
                imagen, 
                id_cat
              
            ) VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $this->pdo->prepare($sql);
            
            // Si no se subió imagen, guardamos NULL
            $imagenData = (!empty($imagen)) ? $imagen : null;
            
            return $stmt->execute([
                $nombre,
                $detalle,
                $precio,
                $stock,
                $imagenData,
                $categoria_id        
                
            ]);
            
        } catch (Exception $e) {
            // Registrar el error en logs si es necesario
            error_log("Error al agregar producto: " . $e->getMessage());
            return false;
        }
    }

	
	public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }



 public function ObtenerProductos($id) {
    try {
        $stm = $this->pdo->prepare("SELECT p.id, p.nombre, p.detalle, p.precio, p.stock, p.imagen, c.id as idcat, p.estado
        FROM producto as p 
        inner join  categoria c on c.id= p.id_cat
        WHERE p.id = ?");
        $stm->execute([$id]);
        $producto = $stm->fetch(PDO::FETCH_OBJ);

        // Si la imagen existe, la convertimos a Base64
        if ($producto && isset($producto->imagen)) {
            $producto->imagen = base64_encode($producto->imagen);
        }

            return $producto; // Objeto con imagen en Base64
        } catch (PDOException $e) {
            throw new Exception("Error al obtener producto: " . $e->getMessage());
        }
    }
    public function actualizar($id, $imagen)
    {
        try {
            // Construir la consulta SQL
            $sql = "UPDATE producto SET imagen = ? WHERE id = ? ";
            
            // Si hay nueva imagen, la incluimos en la actualización
      
            $stmt = $this->pdo->prepare($sql);
            
            // Si hay imagen, incluimos todos los parámetros
            if (!empty($imagen)) {
                $params = [
                    $imagen,  // La imagen BLOB
                    $id       // El ID va al final
                ];
            } else {
                // Si no hay imagen, no la actualizamos (mantiene la existente)
                $params = [
                    $id       // El ID va al final
                ];
            }
            
            return $stmt->execute($params);
            
        } catch (Exception $e) {
            error_log("Error al actualizar producto: " . $e->getMessage());
            return false;
        }
    }

}
