<?php

class pedidos
{

	private $pdo;

    public $idProducto;

    public $pedidoId;
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
    
	
    public function MenuListacategoriaVestir()
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM categoria where id = 1");
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



    
    public function ObtenerPedidosCliente($id) {
        try {
        $stm = $this->pdo->prepare("SELECT a.id, b.nombre as nombrePersona,
        b.telefono, c.nombre as nombreProducto, c.detalle, 
        d.nombre as nombreCategoria, c.imagen, c.precio, c.talla,
        a.cantidad, a.fecha, a.estado 
        FROM carrito as a
        INNER JOIN cliente as b on b.id = a.idCliente
        INNER JOIN producto as c on c.id = a.idPro
        INNER JOIN categoria as d on d.id = c.id_cat
        WHERE b.id = ?");
        $stm->execute([$id]);
        $productos = $stm->fetchAll(PDO::FETCH_OBJ); // Cambiado a fetchAll para obtener todos los registros

        // Procesar imágenes para cada producto
        foreach ($productos as $producto) {
            if (isset($producto->imagen)) {
                $producto->imagen = base64_encode($producto->imagen);
            }
        }

        return $productos; // Retorna un array de objetos
    } catch (PDOException $e) {
        throw new Exception("Error al obtener productos: " . $e->getMessage());
    }
    }
    public function ListarCliente()
    {
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT p.id,p.nombre,p.detalle,p.precio,p.talla,p.imagen,c.nombre as nomrecat,p.estado 
			FROM producto as p inner join categoria c on c.id= p.id_cat where p.id_cat=1 ; ");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }
      public function ListarSerigrafia()
    {
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT p.id,p.nombre,p.detalle,p.precio,p.talla,p.imagen,c.nombre as nomrecat,p.estado 
			FROM producto as p inner join categoria c on c.id= p.id_cat where p.id_cat=2 ; ");
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
            $sql = "UPDATE carrito SET estado = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$estado, $id]);
        } catch(Exception $e) {
            throw new Exception("Error al cambiar estado: " . $e->getMessage());
        }
    }
    public function agregar($nombre, $precio, $talla, $imagen, $categoria_id, $detalle)
    {
        try {
            $sql = "INSERT INTO producto (
                nombre, 
                detalle, 
                precio, 
                talla, 
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
                $talla,
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
        $stm = $this->pdo->prepare("SELECT p.id, p.nombre, p.detalle, p.precio, p.talla, p.imagen, c.id as idcat, p.estado
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
    public function actualizar($id, $nombre, $precio, $talla, $imagen, $categoria_id, $detalle)
    {
        try {
            // Construir la consulta SQL
            $sql = "UPDATE producto SET 
                    nombre = ?, 
                    detalle = ?, 
                    precio = ?, 
                    talla = ?, 
                    id_cat = ?";
            
            // Si hay nueva imagen, la incluimos en la actualización
            if (!empty($imagen)) {
                $sql .= ", imagen = ?";
            }
            
            $sql .= " WHERE id = ?";
            
            $stmt = $this->pdo->prepare($sql);
            
            // Si hay imagen, incluimos todos los parámetros
            if (!empty($imagen)) {
                $params = [
                    $nombre,
                    $detalle,
                    $precio,
                    $talla,
                    $categoria_id,
                    $imagen,  // La imagen BLOB
                    $id       // El ID va al final
                ];
            } else {
                // Si no hay imagen, no la actualizamos (mantiene la existente)
                $params = [
                    $nombre,
                    $detalle,
                    $precio,
                    $talla,
                    $categoria_id,
                    $id       // El ID va al final
                ];
            }
            
            return $stmt->execute($params);
            
        } catch (Exception $e) {
            error_log("Error al actualizar producto: " . $e->getMessage());
            return false;
        }
    }
 public function actualizarPedidoAtendidoQrInicial($idPedido, $qrPago) {
        try {
            $sql = "UPDATE carrito SET 
                    qrInicial = :qrPago,
                    estado = 3 /* Estado 2 = Atendido */
        
                    WHERE id = :idPedido";

            $stmt = $this->pdo->prepare($sql);
            
            // Vincular parámetros
            $stmt->bindParam(':qrPago', $qrPago, PDO::PARAM_LOB);
            $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (Exception $e) {
            error_log("Error en actualizarPedidoAtendido: " . $e->getMessage());
            return false;
        }
    }
     public function cambiarEstadoPedido($pedidoId, $estado) {
        try {
            $sql = "UPDATE carrito SET estado = ? WHERE id = ?";
            $stm = $this->db->prepare($sql);
            return $stm->execute([$estado, $pedidoId]);
        } catch (PDOException $e) {
            error_log("Error al cambiar estado del pedido: " . $e->getMessage());
            return false;
        }
    }


}
