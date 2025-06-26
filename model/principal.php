<?php

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    // Verificar la acción específica
    if ($action === 'MenuTipoRecomendacionNombreGet') {
        // Obtener el valor enviado en la solicitud
        $valor = $_POST['valor'];
        
        // Llamar al método MenuTipoRecomendacionGet con el valor
        $result = $model->MenuTipoRecomendacionNombreGet($valor);
        
        // Devolver los datos como JSON
        echo json_encode($result);
    }
	
}

class principal
{

	private $pdo;

    public $idProducto;
    public $NeuronaNombre;
    public $NeuronaPesosIdFk;
    public $NeuronaEntrada_1;
	public $NeuronaEntrada_2;
    public $NeuronaEntrada_3;
	public $NeuronaEntrada_4;
	public $NeuronaEntrada_5;
	public $NeuronaEntrada_6;
	public $NeuronaSalida_1;
	public $NeuronaSalida_2;
	public $NeuronaEstado;
	

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
	public function MenuLista()
	{
		try
		{

			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM pedidos");
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
			$stm = $this->pdo->prepare("SELECT * FROM pedidos");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function MenuTipoRecomendacion()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM pedidos");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function MenuTipoRecomendacionGet($valor)
	{
		try
		{
			
			$result = array();
		//	$stm = $this->pdo->prepare("SELECT Recomendacion_id,Recomendacion_titulo FROM recomendacion WHERE Recomendacion_categoria=?");

		$stm->execute(array($valor));
		return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}

	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pedidos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function ListarEntrenamiento()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pedidos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


	



	

	public function ActualizarEstado($data)
	{
		try
		{
			$aux=1;
			$sql = "UPDATE pedidos SET
	    	estado        = ?
			WHERE id_pedido  = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array( 
						$aux,
						$data->Neurona_Id
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Actualizar($data)
	{
		try
		{
			$sql = "UPDATE pedidos SET
			fk_cliente       = ?,
			nit_ci			 = ?,
			estado           = ?		
			WHERE id_pedido  = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array( 
                        $data->idCliente,
						$data->nitCi,
						$data->estado,
						$data->idPedido
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	

	public function Registrar(principal $data)
	{
		try
		{
			   
				$sql = "INSERT INTO pedidos 
				(fk_cliente,
				nit_ci,
				estado)
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->idCliente,
                    $data->nit_ci,
	                $data->estado
                    )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
