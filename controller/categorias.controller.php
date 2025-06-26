<?php
session_start();


require_once 'model/categorias.php';

class categoriasController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new categorias();
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

    //Llamado plantilla categorias
    public function ver2(){
       $pvd = new categorias();
       $this->verificarSesion(); // Verificar si el usuario está autenticado
       $this->evitarCache();     // Evitar el almacenamiento en caché

       require_once 'view/header.php';
       require_once 'view/categorias/categorias.php';
       require_once 'view/footerx.php';
    } 
  
    public function Index(){
       $pvd = new categorias();
       //$this->verificarSesion(); // Verificar si el usuario está autenticado  
      // $this->evitarCache();     // Evitar el almacenamiento en caché categorias categoriasSerigraficos

       require_once 'view/header.php';
       require_once 'view/categorias/categorias.php';
      // require_once 'view/footerx.php';
    } 
    //Llamado plantilla categorias
    public function ver1(){
       $pvd = new categorias();
       $this->verificarSesion(); // Verificar si el usuario está autenticado  
       $this->evitarCache();     // Evitar el almacenamiento en caché categorias categoriasSerigraficos

       require_once 'view/header.php';
       require_once 'view/categorias/categorias.php';
     //  require_once 'view/footerx.php';
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
  
    public function Editar()
    {
        try {
            $cat = new categorias();
            $cat->id = $_POST['id'];
            $cat->nombre = $_POST['nombre'];
            $this->model->Actualizar($cat);

            echo json_encode(['success' => true, 'message' => 'Categoría actualizada correctamente']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function Obtenercategoria()
    {
        try {
            $id = $_POST['id'];


            $pvd = $this->model->Obtener($id);
            
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
        $directorio = 'assets/img/categorias/';
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
