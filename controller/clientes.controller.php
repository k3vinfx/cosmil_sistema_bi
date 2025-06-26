<?php
session_start();

require_once 'model/clientes.php';

class ClientesController
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new clientes();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/clientes/clientes.php';
      //  require_once 'view/footerx.php';
    }

    public function Nuevo()
    {
        require_once 'view/header.php';
        require_once 'view/clientes/nuevo.php';
        require_once 'view/footerx.php';
    }

    public function Guardar() 
    {
        try {
            $cliente = new clientes();
            
            // Captura de los datos del formulario
            $cliente->nombre = $_POST['nombre'];
            $cliente->telefono = $_POST['telefono'];
            $cliente->email = $_POST['email'];
            $cliente->direccion = $_POST['direccion'];

            // Registro al modelo clientes
            $this->model->Guardar($cliente);

            // Para peticiones AJAX
            if($this->isAjaxRequest()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Cliente guardado correctamente'
                ]);
                return;
            }

            // Para peticiones normales
            header('Location: ?c=clientes&a=Index');
            
        } catch(Exception $e) {
            // Para peticiones AJAX
            if($this->isAjaxRequest()) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al guardar el cliente: ' . $e->getMessage()
                ]);
                return;
            }

            // Para peticiones normales
            $_SESSION['error'] = 'Error al guardar el cliente: ' . $e->getMessage();
            header('Location: ?c=clientes&a=Nuevo');
        }
    }

   public function Editar()
    {
        try {
            $cliente = new clientes();
            $cliente->id = $_POST['id'];
            $cliente->nombre = $_POST['nombre'];
            $cliente->telefono = $_POST['telefono'];
            $cliente->email = $_POST['email'];
            $cliente->direccion = $_POST['direccion'];
            
            $this->model->Actualizar($cliente);
            
            echo json_encode([
                'success' => true,
                'message' => 'Cliente actualizado correctamente'
            ]);
        } catch(Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar: ' . $e->getMessage()
            ]);
        }
    }

    public function ObtenerCliente()
    {
        try {
            $id = $_POST['id'];
            $cliente = $this->model->Obtener($id);
            
            if($cliente) {
                echo json_encode([
                    'success' => true,
                    'data' => $cliente
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Cliente no encontrado'
                ]);
            }
        } catch(Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

  

    public function CambiarEstado()
    {
        try {
                $id = $_POST['id'];
                $estado = $_POST['estado'] == '1' ? 1 : 0; // Asegurar que sea 0 o 1
                
                $this->model->CambiarEstado($id, $estado);
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Estado actualizado correctamente'
                ]);
            } catch(Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al cambiar estado: ' . $e->getMessage()
                ]);
            }
    }

    public function Eliminar()
    {
        try {
            $id = $_GET['id'];
            $this->model->Eliminar($id);
            
            header('Location: ?c=clientes&a=Index');
            
        } catch(Exception $e) {
            $_SESSION['error'] = 'Error al eliminar cliente: ' . $e->getMessage();
            header('Location: ?c=clientes&a=Index');
        }
    }

    private function evitarCache()
    {
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    private function isAjaxRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}