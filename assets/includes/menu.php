<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Administrativo</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
	
</head>
       <?php 
         $idRol = isset($_SESSION['session_rol_id']) ? $_SESSION['session_rol_id'] : 0;
      ?> 

    <!-- Sidebar -->


    
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <div class="particles" id="particles-js"></div>
        <div class="sidebar-content">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="assets/img/logo_menu.png" width="45px" alt="Logo">
                </div>
             </a>     

   <!-- Divider -->   <h4 class="sidebar-brand-text mx-5 "  style="color: white;">Gerencia </h4>
            <?php if ($idRol == 1): ?>
              
        <hr class="sidebar-divider my-0">
        <hr class="sidebar-divider">


            <!-- ========== MENÚ PARA ADMINISTRADOR (ROL 1) ========== -->
            
            <!-- Productos -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=productos">
                    <i class="fas fa-fw fa-splotch"></i>
                    <span>PRODUCTOS</span>
                </a>
            </li>
            <!-- Categorias -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=categorias">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>CATEGORIAS</span>
                </a>
            </li>
            <!-- Empresas -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=empresas">
                    <i class="fas fa-fw fa-building"></i>
                    <span>EMPRESAS</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Ventas -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=ventas&a=verActual">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>VENTAS</span>
                </a>
            </li>

            <!-- Historial de Ventas -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=ventas&a=verHistoricas">
                    <i class="fas fa-fw fa-history"></i>
                    <span>HISTORIAL DE VENTAS</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Usuarios -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=usuarios">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>USUARIOS</span>
                </a>
            </li>

        <?php elseif ($idRol == 2): ?>
            <!-- ========== MENÚ PARA USUARIO NORMAL (ROL 2) ========== -->
            
            <!-- Productos (sólo vista) -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=productos">
                    <i class="fas fa-fw fa-splotch"></i>
                    <span>PRODUCTOS</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <!-- Ventas -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=pedidos&a=ver1">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>VENTAS</span>
                </a>
            </li>

            <!-- Historial Personal -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?c=pedidos&a=mis_ventas">
                    <i class="fas fa-fw fa-user-clock"></i>
                    <span>MIS VENTAS</span>
                </a>
            </li>

        <?php else: ?>
            <!-- ========== MENÚ PARA INVITADOS/NO LOGUEADOS ========== -->
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <i class="fas fa-fw fa-sign-in-alt"></i>
                    <span>INICIAR SESIÓN</span>
                </a>
            </li>
        <?php endif; ?>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </div>
</ul>
   <!-- jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <!-- Biblioteca particles.js para el efecto avanzado -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    
    <script>
        $(document).ready(function() {

			// Toggle del sidebar
    $('#sidebarToggle').click(function(e) {
        e.preventDefault();
        $('body').toggleClass('sidebar-toggled');
        $('.sidebar').toggleClass('toggled');
        
        if ($('.sidebar').hasClass('toggled')) {
            $('.sidebar .collapse').collapse('hide');
        }
    });

    // Cerrar el sidebar cuando se hace clic en un ítem del menú (en móviles)
    $(document).on('click', 'div.sidebar-toggled .nav-item', function() {
        if ($(window).width() < 798) {
            $('body').removeClass('sidebar-toggled');
            $('.sidebar').removeClass('toggled');
        }
    });
            // Inicializar particles.js con configuración personalizada
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 30,
                        "density": {
                            "enable": true,
                            "value_area": 140
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 101
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 2,
                            "size_min": 1,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.3,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 3,  // Aumenté la velocidad de 2 a 3
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "bounce",
                        "bounce": true,
                        "attract": {
                            "enable": true,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 0.8
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });

            // Animación del menú
            $('.nav-link').hover(
                function() {
                    $(this).find('i').css('transform', 'scale(1.3)');
                },
                function() {
                    $(this).find('i').css('transform', 'scale(1)');
                }
            );
            
            // Efecto al hacer clic en items
            $('.collapse-item').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            });
        });
    </script>

</html>