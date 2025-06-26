<?php
include "assets/includes/functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>COSMIL BI</title>
    
    <!-- Bootstrap CSS -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS para el carrito -->
    <style>
        .cart-icon {
            position: relative;
            margin-right: 20px;
            color: white;
            font-size: 1.5rem;
        }
        
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #e74a3b;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
        
        .dropdown-menu-right {
            right: 0;
            left: auto;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .topbar {
            background: linear-gradient(135deg,rgb(11, 110, 20) 0%,rgb(87, 102, 96) 100%);
        }
    </style>
    <!-- En el <head> -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once "assets/includes/menu.php"; ?>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <div class="input-group">
                        <h6 class="text-white">Usuario : <?php echo $_SESSION['session_usuario'] ?? 'Invitado'; ?></h6>
                        <p class="ml-auto text-white"><strong>La Paz, </strong><?php echo fechaPeru(); ?></p>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Carrito de compras -->
                
                        
                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                        <!-- Nav Item - User Information -->
                        <?php if(isset($_SESSION['session_usuario'])): ?>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/img/user.png" class="user-avatar">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                           
                                    <a class="dropdown-item" href="mi-cuenta.php">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Mi Cuenta
                                    </a>
                                    <a class="dropdown-item"  href="index.php?c=pedidos&a=ver1">
                
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Mis Pedidos
                                    </a>
                                    <div class="dropdown-divider"></div>
                                   <a class="dropdown-item" href="#" id="logoutButton">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar Sesión
                                    </a>

                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="btn btn-primary mr-2" href="login.php">
                                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-success" href="registro.php">
                                    <i class="fas fa-user-plus"></i> Registrarse
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <!-- Scripts -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                document.getElementById('logoutButton').addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Quieres cerrar tu sesión?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, cerrar sesión',
                        cancelButtonText: 'Cancelar',
                        backdrop: `
                            rgba(0,0,0,0.7)
                            center top
                            no-repeat
                        `
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Hacer la petición para cerrar sesión
                            fetch('salir.php')
                                .then(response => {
                                    if (response.ok) {
                                        // Mostrar confirmación
                                        Swal.fire({
                                            title: 'Sesión cerrada',
                                            text: 'Has salido del sistema correctamente',
                                            icon: 'success',
                                            timer: 1500,
                                            showConfirmButton: false
                                        }).then(() => {
                                            // Redirigir al index
                                            window.location.href = 'index.php';
                                        });
                                    } else {
                                        Swal.fire('Error', 'No se pudo cerrar la sesión', 'error');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error', 'Error al conectar con el servidor', 'error');
                                });
                        }
                    });
                });
                </script>
                