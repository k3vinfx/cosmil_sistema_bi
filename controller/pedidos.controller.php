<?php
session_start();


require_once 'model/pedidos.php';

class pedidosController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new pedidos();
    }

        // Método privado para verificar la sesión
    private function verificarSesion(){

       // $login = $this->model->Login($_REQUEST['usuario'],$_REQUEST['Contrasena']);
            // Verificar si el usuario está autenticado
       if (!isset($_SESSION['session_usuario']) || empty($_SESSION['session_usuario'])) {
             // Si no está autenticado, redirigir al inicio de sesión
            header("Location: index.php");
            exit();
        }
    }
    
    // Método privado para evitar el almacenamiento en caché
    private function evitarCache(){
        // Evitar que el navegador almacene en caché la página
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); // Fecha en el pasado
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Siempre modificado
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    //Llamado plantilla pedidos
    public function ver1(){
    $pvd = new pedidos();


    
    require_once 'view/header.php'; // Solo <head>
    

    require_once 'view/pedidos/pedidosCliente.php';
    // NO cerrar body/html aquí, footerx.php lo hará
    
    require_once 'view/footerx.php'; // Este archivo debe incluir </body></html>
    }
  
    //Llamado plantilla pedidos
    public function ver2(){
       $pvd = new pedidos();
       $this->verificarSesion(); // Verificar si el usuario está autenticado  
       $this->evitarCache();     // Evitar el almacenamiento en caché pedidosVestir pedidosSerigraficos

       require_once 'view/header.php';
       require_once 'view/pedidos/pedidosAdmin.php';
       require_once 'view/footerx.php'; 
    }
    
    
    public function cambiarEstadoX() {
        // Verifica que la solicitud sea POST y tenga los datos necesarios
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['estado'])) {
            try {
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                $estado = filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_INT);
                
                // Validación básica
                if ($id === false || $id <= 0 || ($estado !== 0 && $estado !== 1)) {
                    throw new Exception('Datos de entrada inválidos');
                }
                
                // Cambiar el estado en el modelo
                $resultado = $this->model->cambiarEstadoPedido($id, $estado);
                
                if ($resultado) {
                    // Respuesta exitosa
                    echo json_encode([
                        'success' => true,
                        'message' => 'Estado del pedido actualizado correctamente',
                        'nuevoEstado' => $estado
                    ]);
                } else {
                    throw new Exception('No se pudo actualizar el estado del pedido');
                }
            } catch (Exception $e) {
                // Manejo de errores
                http_response_code(400); // Bad Request
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode([
                'success' => false,
                'message' => 'Datos incompletos o método incorrecto'
            ]);
        }
    }

    public function CambiarEstado()
    {
        try {
                $id = $_POST['id'];
                $estado = $_POST['estado']; // Asegurar que sea 0 o 1
                
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
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Obtener datos básicos del formulario
                $nombre = $_POST['nombre'] ?? '';
                $precio = $_POST['precio'] ?? 0;
                $detalle = $_POST['detalle'] ?? '';
                $talla = $_POST['talla'] ?? '';
                $categoria_id = $_POST['categoria_id'] ?? 0;
                
                // Manejo de la imagen
                $imagen = null;
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
                }
               
                // Validaciones básicas
                if (empty($nombre) || empty($categoria_id)) {
                    throw new Exception("Nombre y categoría son campos obligatorios");
                }
                
                if (!is_numeric($precio) || $precio < 0) {
                    throw new Exception("El precio debe ser un valor numérico positivo");
                }
                
                // Insertar en la base de datos
                $result = $this->model->agregar(
                    $nombre, 
                    $precio, 
                    $talla, 
                    $imagen, 
                    $categoria_id,
                    $detalle
                );
                
                if ($result) {
                    $response = [
                        'success' => true,
                        'message' => 'Producto guardado correctamente',
                        'id' => $this->model->getLastInsertId() // Si tu modelo tiene este método
                    ];
                } else {
                    throw new Exception("Error al guardar el producto en la base de datos");
                }
                
            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
    }
  
    public function Obtenerpedidos()
    {
        try {
            $id = $_POST['id'];


            $pvd = $this->model->Obtenerpedidos($id);
            
            if($pvd) {
                echo json_encode([
                    'success' => true,
                    'data' => $pvd
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Producto no encontrado'
                ]);
            }
        } catch(Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

 // Método para atender el pedido
    public function atenderPedidoQrInicial() {
        header('Content-Type: application/json');
        
        try {
            // Validar que se recibieron todos los datos necesarios
            if (!isset($_POST['id_pedido']) || empty($_POST['id_pedido'])) {
                throw new Exception("ID de pedido no especificado");
            }

            if (!isset($_FILES['comprobante_adelanto']) || $_FILES['comprobante_adelanto']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Debe subir un comprobante QR de pago");
            }

            $idPedido = $_POST['id_pedido'];


            // Procesar la imagen QR
            $qrPago = file_get_contents($_FILES['comprobante_adelanto']['tmp_name']);

            // Actualizar el pedido en la base de datos
            $resultado = $this->model->actualizarPedidoAtendidoQrInicial(
                $idPedido,
                $qrPago
            );
               // Limpiar cualquier buffer de salida
            ob_end_clean();
            
            header('Content-Type: application/json');

            if ($resultado) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Pedido adelantado correctamente pendiente entrega y pago final'
                ]);
            } else {
                throw new Exception("Error al actualizar el pedido");
            }

        } catch (Exception $e) {
               ob_end_clean();
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit();
                }
    }
   public function EditarProducto()
    {
        try {
            // Verificar si se recibió el ID del producto
            if (!isset($_POST['id']) || empty($_POST['id'])) {
                throw new Exception('ID del producto no proporcionado');
            }

            // Obtener parámetros del formulario
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $detalle = $_POST['detalle'];
            $precio = $_POST['precio'];
            $talla = $_POST['talla'] ?? null;
            $categoria_id = $_POST['categoria_id'];
            
            // Manejo de la imagen (opcional)
            $imagen = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            }
            
            // Actualizar el producto en la base de datos
            $resultado = $this->model->actualizar(
                $id,
                $nombre,
                $precio,
                $talla,
                $imagen,
                $categoria_id,
                $detalle
            );
            
            if (!$resultado) {
                throw new Exception('No se pudo actualizar el producto en la base de datos');
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Producto actualizado correctamente',
                'data' => [
                    'id' => $id,
                    'nombre' => $nombre
                ]
            ]);
        } catch(Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el producto: ' . $e->getMessage()
            ]);
        }
    }

     public function crearPedido() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Obtener datos del formulario
                $idPro = $_POST['idPro'] ?? 0;
                $idCliente = $_POST['idCliente'] ?? 0;
                $cantidad = $_POST['cantidad'] ?? 1;
                $estado = $_POST['estado'] ?? 1;
                
                // Validaciones básicas
                if (empty($idPro)) {
                    throw new Exception("Debe seleccionar un producto válido");
                }
                
                if (empty($idCliente)) {
                    throw new Exception("No se pudo identificar al cliente");
                }
                
                if (!is_numeric($cantidad) || $cantidad < 1) {
                    throw new Exception("La cantidad debe ser un número mayor a 0");
                }
                
                // Insertar en la base de datos
                $result = $this->model->crearPedido(
                    $idPro,
                    $idCliente,
                    $cantidad,
                    $estado
                );
                
                if ($result) {
                    $response = [
                        'success' => true,
                        'message' => 'Pedido creado correctamente',
                        'id' => $this->model->getLastInsertId() // Si tu modelo tiene este método
                    ];
                } else {
                    throw new Exception("Error al guardar el pedido en la base de datos");
                }
                
            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
    }
    private function procesarImagen($imagen)
    {
        // Configuración para la subida de imágenes
        $directorio = 'assets/img/pedidos/';
        $nombreArchivo = uniqid('producto_') . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);
        $rutaCompleta = $directorio . $nombreArchivo;
        
        // Verificar y crear directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }
        
        // Mover el archivo subido al directorio destino
        if (!move_uploaded_file($imagen['tmp_name'], $rutaCompleta)) {
            throw new Exception('Error al guardar la imagen');
        }
        
        return $rutaCompleta;
    }
    // public function agregar() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $nombre = $_POST['nombre'];
    //         $precio = $_POST['precio'];
    //         $stock = $_POST['stock'];
    //         $talla = $_POST['talla'];
    //         $categoria_id = $_POST['categoria_id'];
    //         $proveedor_id = $_POST['proveedor_id'];
    //         $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    //         $result = $this->model->agregar($nombre, $precio, $stock, $talla, $imagen, $categoria_id, $proveedor_id);

    //         echo json_encode(['success' => $result]);
    //     }
    // }
    




}
