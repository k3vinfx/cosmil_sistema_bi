<?php
session_start();
require_once 'model/principal.php';

class PrincipalController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new principal();

    }

     // Método privado para verificar la sesión
     private function verificarSesion(){
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

    
    //Llamado plantilla principal
    public function Index(){

       $this->verificarSesion(); // Verificar si el usuario está autenticado
      // $this->evitarCache();     // Evitar el almacenamiento en caché

       require_once 'view/header.php';
       require_once 'view/productos/productosSerigraficos.php';
       require_once 'view/footerx.php';
    } 
  



}
