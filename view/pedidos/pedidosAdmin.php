<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ProductosSerigraficos</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        .error {
            color: #dc3545;
            font-size: 0.875em;
        }
        .is-invalid {
            border-color: #dc3545;
        }
          :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }
        
        body {
            font-size: 0.9rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(-45deg, #f5f7fa 0%, #e8f0fe 50%, #f5f7fa 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            margin: 0;
            padding: 0;
        }
            @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Mejora para los botones de filtro */
        #filtroEstadoGroup label {
            transition: all 0.3s ease;
            margin: 0 3px;
        }

        #filtroEstadoGroup label.active {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.89);
        }

        #filtroEstadoGroup label.btn-outline-primary.active {
            background: rgba(52, 152, 219, 0.89);
        }

        #filtroEstadoGroup label.btn-outline-success.active {
            background: rgba(46, 204, 112, 0.89);
        }

        #filtroEstadoGroup label.btn-outline-secondary.active {
            background: rgba(108, 117, 125, 0.89);
        }
      /* Efecto de elevación para el contenedor principal */
        .container {
            background-color:  rgba(233, 233, 233, 0.95);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7);
            padding: 25px;
            margin-top: 30px;
            margin-bottom: 30px;
            max-width: 95%;
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        #wave-interference {
            position: absolute;
            top: -43%;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -3;
            opacity: 0.7;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(1, 109, 34, 0.59);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 5px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);

        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 500;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table {
            margin-bottom: 0;
        }
            .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        width: 100%;
        }

         #tablaProductosSerigraficos {
        width: 100% !important;
        }
        .table thead th {
            background-color: var(--secondary-color);
            color: white;
            border-bottom: none;
            font-weight: 500;
            padding: 12px 15px;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        .btn {
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 6px;
          transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
            .btn:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn:focus:after,
        .btn:hover:after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 1;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-outline-success {
            color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-outline-success:hover {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-outline-secondary {
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .custom-control-input:checked~.custom-control-label::before {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .error {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .is-invalid {
            border-color: #e74c3c;
        }
        
        .page-title {
            color: var(--secondary-color);
            margin-bottom: 25px;
            font-weight: 600;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            display: inline-block;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-active {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }
        
        .status-inactive {
            background-color: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 3px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box .form-control {
            padding-left: 40px;
            border-radius: 20px;
        }
        
        .search-box .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        
        /* Efecto para las filas de la tabla */
        .table tbody tr {
            transition: all 0.2s ease;
            position: relative;
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: scale(1.005);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Efecto para los inputs */
        .form-control {
            transition: all 0.3s ease;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            transform: scale(1.02);
        }
 /* Asegurar que el select sea visible */
        .form-control:focus, .form-control:hover {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        /* Forzar visualización del valor seleccionado */
        select.form-control option:checked {
            background: #3498db linear-gradient(0deg, #3498db 0%, #3498db 100%);
            color: white;
        }

        /* Estilos específicos para el select */
        select.form-control {
            -webkit-appearance: menulist !important;
            -moz-appearance: menulist !important;
            appearance: menulist !important;
            background-color: white !important;
            padding: 0.375rem 0.75rem !important;
            height: auto !important;
        }

        /* Estilo para las opciones */
        select.form-control option {
            background-color: white;
            color: #495057;
            padding: 5px;
        }

        /* Estilo para la opción seleccionada */
        select.form-control option:checked {
            background-color: #3498db !important;
            color: white !important;
        }

        /* Resto de tus estilos existentes... */
        .error {
            color: #dc3545;
            font-size: 0.875em;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --light-bg: #f8f9fa;
            --dark-bg: #343a40;
        }
        
        .card-header {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 500;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            width: 100%;
        }

        #tablaProductosSerigraficos {
            width: 100% !important;
        }
        
        .table thead th {
            background-color: var(--secondary-color);
            color: white;
            border-bottom: none;
            font-weight: 500;
            padding: 12px 15px;
        }
        
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-outline-success {
            color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .btn-outline-success:hover {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn-outline-secondary {
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .custom-control-input:checked~.custom-control-label::before {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .error {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .page-title {
            color: var(--secondary-color);
            margin-bottom: 25px;
            font-weight: 600;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            display: inline-block;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-active {
            background-color: rgba(46, 204, 113, 0.2);
            color: var(--success-color);
        }
        
        .status-inactive {
            background-color: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 3px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box .form-control {
            padding-left: 40px;
            border-radius: 20px;
        }
        
        .search-box .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }
     

        #fluid-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.6;
        }

        
        /* Botón de estado (Activo/Inactivo) - Efecto Neón */
        .custom-switch .custom-control-label::before {
            width: 3.5rem;
            height: 1.75rem;
            border-radius: 2rem;
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            box-shadow: 3px 3px 6px #d1d1d1, 
                        -3px -3px 6px #ffffff;
            border: none;
            transition: all 0.4s ease;
        }

        .custom-switch .custom-control-input:checked~.custom-control-label::before {
            background: linear-gradient(145deg, #25d366, #2ecc71);
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.7), 
                        0 0 20px rgba(46, 204, 113, 0.5),
                        3px 3px 6px #1e8449, 
                        -3px -3px 6px #3eff99;
        }

        .custom-switch .custom-control-label::after {
            width: calc(1.75rem - 4px);
            height: calc(1.75rem - 4px);
            border-radius: 50%;
            background: white;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.3);
            transform: translateX(0.25rem);
            transition: all 0.3s ease;
        }

        .custom-switch .custom-control-input:checked~.custom-control-label::after {
            transform: translateX(1.75rem);
            background: white;
            box-shadow: -1px 1px 3px rgba(0,0,0,0.2);
        }

        /* Botones principales - Efecto Vidrio Morfológico */
        .btn-artistic {
            position: relative;
            overflow: hidden;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(5px);
            transition: all 0.5s ease;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.1),
                        -5px -5px 15px rgba(255,255,255,0.9);
        }

        .btn-artistic::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                        rgba(255,255,255,0.4) 0%, 
                        rgba(255,255,255,0.1) 50%, 
                        rgba(255,255,255,0.4) 100%);
            border-radius: 10px;
            z-index: 1;
        }

        .btn-artistic:hover {
            transform: translateY(-3px);
            box-shadow: 8px 8px 20px rgba(0,0,0,0.15),
                        -8px -8px 20px rgba(255,255,255,0.8);
        }

        .btn-artistic:active {
            transform: translateY(1px);
        }

        /* Botón Primario */
        .btn-primary.btn-artistic {
            background: rgba(52, 152, 219, 0.9);
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .btn-primary.btn-artistic:hover {
            background: rgba(52, 152, 219, 1.9);
        }

        /* Botón Success */
        .btn-success.btn-artistic {
            background: rgb(46, 204, 112);
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.88);
        }

        .btn-success.btn-artistic:hover {
            background: rgb(18, 197, 92);
        }

        /* Botón Secondary */
        .btn-secondary.btn-artistic {
            background: rgb(108, 117, 125);
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.74);
        }

        .btn-secondary.btn-artistic:hover {
            background: rgba(108, 117, 125, 0.9);
        }

        /* Botón Outline - Efecto Borde Luminoso */
        .btn-outline-artistic {
            position: relative;
            overflow: hidden;
            background: transparent;
            border: 2px solid;
            border-radius: 12px;
            padding: 8px 18px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.5s ease;
            z-index: 1;
        }

        .btn-outline-artistic::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: currentColor;
            opacity: 0;
            z-index: -1;
            transition: all 0.4s ease;
            transform: scale(0.5);
        }

        .btn-outline-artistic:hover::before {
            opacity: 0.1;
            transform: scale(1);
        }

        .btn-outline-artistic:hover {
            box-shadow: 0 0 10px currentColor,
                        0 0 20px currentColor;
            transform: translateY(-3px);
        }

        /* Botón de Acción (Editar) - Efecto Flotante 3D */
        .btn-action-artistic {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(145deg, #e6e6e6, #ffffff);
            box-shadow: 5px 5px 10px #d1d1d1,
                        -5px -5px 10px #ffffff;
            color: var(--primary-color);
            transition: all 0.3s ease;
            border: none;
        }

        .btn-action-artistic:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 8px 8px 15px #c9c9c9,
                        -8px -8px 15px #ffffff;
            color: var(--primary-color);
        }

        .btn-action-artistic:active {
            transform: translateY(1px);
            box-shadow: 3px 3px 6px #d1d1d1,
                        -3px -3px 6px #ffffff;
        }

        /* Botón de Radio (Filtros) - Efecto Pulsante */
        .btn-group-toggle .btn-outline-artistic {
            margin: 0 5px;
        }

        .btn-group-toggle .btn-outline-artistic.active {
            background: rgba(52, 152, 219, 0.2);
            box-shadow: 0 0 10px rgba(52, 152, 219, 0.5),
                        inset 3px 3px 5px rgba(0,0,0,0.1);
            transform: scale(1.05);
        }
        /* Estilos personalizados para el input de archivo */
        .custom-file-artistic {
            position: relative;
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .custom-file-input-artistic {
            position: absolute;
            opacity: 0;
            width: 0.1px;
            height: 0.1px;
            overflow: hidden;
            z-index: -1;
        }

        .custom-file-label-artistic {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            border: 2px dashed #adb5bd;
            border-radius: 10px;
            color: #495057;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            min-height: 50px;
        }

        .custom-file-label-artistic:hover {
            background: linear-gradient(145deg, #e9ecef, #f8f9fa);
            border-color: #3498db;
            color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .custom-file-label-artistic i {
            font-size: 1.2rem;
            margin-right: 8px;
        }

        .custom-file-input-artistic:focus + .custom-file-label-artistic {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        /* Efecto cuando se selecciona un archivo */
        .custom-file-input-artistic:valid + .custom-file-label-artistic {
            border-style: solid;
            border-color: #28a745;
            background: linear-gradient(145deg, #e6f7ed, #d4edda);
        }

        .custom-file-input-artistic:valid + .custom-file-label-artistic .file-label-text::after {
            content: " (archivo seleccionado)";
            font-weight: normal;
            color: #28a745;
        }

        .file-preview-container {
            margin-top: 10px;
            text-align: center;
        }

        .img-thumbnail {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Efecto de onda al hacer clic */
        @keyframes ripple-effect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .btn-artistic-click-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            transform: scale(0);
            animation: ripple-effect 0.6s linear;
            pointer-events: none;
        }
        /* Efectos para los modales */
        .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .modal.show .modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2980b9 100%);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            transform: rotate(30deg);
            z-index: -1;
            animation: shine 3s infinite linear;
        }

        @keyframes shine {
            0% { transform: rotate(30deg) translate(-10%, -10%); }
            100% { transform: rotate(30deg) translate(10%, 10%); }
        }

        .modal-body {
            background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }

        .modal-body::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--primary-color) 50%, transparent 100%);
        }

        .modal-footer {
            background-color: #f1f3f5;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        /* Efecto de partículas en el fondo del modal */
        .modal-particle {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: rgba(255,255,255,0.6);
            animation: float 15s infinite linear;
            z-index: 0;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) translateX(20px); opacity: 0; }
        }

        /* Efecto especial para los inputs en los modales */
        .modal .form-control {
            background-color: rgba(255,255,255,0.8);
            border: 1px solid rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            box-shadow: inset 2px 2px 5px rgba(0,0,0,0.05);
        }

        .modal .form-control:focus {
            background-color: white;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25),
                        inset 2px 2px 5px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }

        /* Efecto de etiquetas flotantes */
        .modal .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .modal .form-group label {
            position: absolute;
            top: -10px;
            left: 15px;
            background: white;
            padding: 0 5px;
            font-size: 0.85rem;
            color: var(--primary-color);
            font-weight: 500;
            z-index: 10;
            transform: translateY(0);
            opacity: 1;
            transition: all 0.2s ease;
        }
        .modal .form-control {
            background-color: rgba(255,255,255,0.8);
            border: 1px solid rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            box-shadow: inset 2px 2px 5px rgba(0,0,0,0.05);
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .modal .form-control:focus {
            background-color: white;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25),
                        inset 2px 2px 5px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }
      
        .img-thumbnail {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .img-thumbnail:hover {
            transform: scale(1.05);
        }
        .product-image-container {
                height: 350px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f8f9fa;
                border-radius: 8px;
                overflow: hidden;
            }
            
            .product-description-box {
                min-height: 120px;
            }
            
            .price-box {
                min-width: 120px;
                text-align: center;
            }
            
            .size-box {
                min-width: 100px;
                text-align: center;
            }
            
            .quantity-section {
                background-color: #f8f9fa;
                padding: 1.5rem;
                border-radius: 8px;
            }
            .fade-out {
                opacity: 0.5;
                transition: opacity 1.5s ease-out;
            }
    </style>
</head>
<body>
<div class="container">
        <!-- Título de la página -->
       <canvas id="wave-interference"></canvas>
    <h2 class="page-title">
         <i class="fas fa-shopping-cart"></i>Pedidos
    </h2>

    <!-- Filtros -->
    <div class="card">
        <div class="card-header">Búsqueda</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="busquedaGeneral" placeholder="Buscar por nombre, email o teléfono">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i></button>
                            <button class="btn btn-secondary" id="btnLimpiarBusqueda"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
            

              
            </div>

        </div>
    </div>

<!-- Tabla de Productos Serigráficos -->
<div class="table-responsive">
    <table class="table table-hover" id="tablaProductosSerigraficos">
        <thead class="thead-dark">
            <tr>
                <th width="5%">ID</th>
                <th width="20%">Nombre</th>
                <th width="15%">Detalle</th>
                <th width="10%">Precio</th>
                <th width="10%">Talla</th>
                <th width="10%">Imagen</th>


        
                <th width="10%">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->ListarSerigrafia() as $r): ?>
            <tr>
                <td><?php echo $r->id; ?></td>
                <td><?php echo $r->nombre; ?></td>
                <td><?php echo $r->detalle; ?></td>
                <td><?php echo $r->precio; ?></td>
                <td><?php echo $r->talla; ?></td>
                <td>
                    <?php if(!empty($r->imagen)): ?>
                    <a href="#" class="img-popup" data-img="<?php echo base64_encode($r->imagen); ?>">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($r->imagen); ?>" 
                             class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                    </a>
                    <?php else: ?>
                        <span class="text-muted">Sin imagen</span>
                    <?php endif; ?>
                </td>

       
                <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-editar" data-id="<?php echo $r->id; ?>" 
                            data-toggle="modal" data-target="#modalEditarProducto" title="Editar">
                        <i class="fas fa-cart-plus"></i>
                    </button>
           
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


</div>


<!-- Modal para nuevo Producto -->
<div class="modal fade" id="modalNuevoProducto" tabindex="-1" role="dialog" aria-labelledby="modalNuevoProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalNuevoProductoLabel">
                    <i class="fas fa-box mr-2"></i>Nuevo Producto de Vestir
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <!-- Partículas de fondo -->
                <div class="modal-particles"></div>
                
                <form id="frm-nuevo-Producto" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder=" " required maxlength="200">
                        <label for="nombre">Nombre del Producto</label>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="detalle" id="detalle" class="form-control" placeholder=" " required maxlength="200" rows="2"></textarea>
                        <label for="detalle">Detalle del Producto</label>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="number" name="precio" id="precio" class="form-control" placeholder=" " required step="0.01" min="0">
                            <label for="precio">Precio</label>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <input type="text" name="talla" id="talla" class="form-control" placeholder=" " maxlength="20">
                            <label for="talla">Talla</label>
                        </div>
             
                          <div class="form-group col-md-4">
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                <?php 
                                $categorias = $this->model->MenuListacategoriaVestir();
                                if(!empty($categorias)) {
                                    foreach($categorias as $categoria): 
                                        $id = $categoria->id ?? $categoria->Categoria_id ?? $categoria->categoria_id;
                                        $nombre = $categoria->nombre ?? $categoria->Categoria_nombre ?? $categoria->categoria_nombre;
                                ?>
                                    <option value="<?php echo htmlspecialchars($id); ?>">
                                        <?php echo htmlspecialchars($nombre); ?>
                                    </option>
                                <?php 
                                    endforeach;
                                }
                                
                                ?>
                            </select>
                            <label for="categoria_id">Categoría</label>
                        </div>
                    </div>
                    
                    <div class="form-row">
               
                           <div class="custom-file-artistic col-md-12">
                                <input type="file" name="imagen" id="edit_imagen" class="custom-file-input-artistic" accept="image/*">
                                <label class="custom-file-label-artistic" for="edit_imagen">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i>
                                    <span class="file-label-text">Seleccionar nueva imagen (opcional)</span>
                                </label>
                         
                            </div>

                      
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-artistic" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary btn-artistic" id="btnGuardarProducto">
                    <i class="fas fa-save mr-2"></i>Guardar Producto
                </button>
            </div>
        </div>
    </div>
</div>




<!-- Modal para imagen ampliada -->
<div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Imagen del Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="imagenAmpliada" src="" class="img-fluid" style="max-height: 80vh;">
            </div>
        </div>
    </div>
</div>


<!-- Modal Ver Producto y Pedir Cantidad - Versión Grande con Campos Ocultos -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditarProductoLabel">
                    <i class="fas fa-info-circle mr-2"></i>Detalle del Producto
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <!-- Partículas de fondo -->
                <div class="modal-particles"></div>
                
                <form id="frm-editar-producto">
                    <!-- Campos ocultos necesarios para el pedido -->
                    <input type="hidden" name="id" id="editar_id">
                    <input type="hidden" name="idPro" id="editar_idPro">
                    <input type="hidden" name="idCliente" id="editar_idCliente" value="<?php echo isset($_SESSION['session_id']) ? $_SESSION['session_id'] : ''; ?>">
                    <input type="hidden" name="estado" value="1">
                    
                    <div class="row">
                        <!-- Columna de la imagen -->
                        <div class="col-md-6 text-center mb-3">
                            <div class="product-image-container">
                                <img id="editar_imagen_actual" src="" class="img-fluid rounded shadow" style="max-height: 350px; display: none; width: auto;">
                            </div>
                            <div class="mt-3">
                                <span class="badge badge-pill badge-primary p-2" id="editar_categoria" style="font-size: 1rem;"></span>
                            </div>
                        </div>
                        
                        <!-- Columna de la información -->
                        <div class="col-md-6">
                            <h3 id="editar_nombre" class="text-primary font-weight-bold mb-3"></h3>
                            <div class="product-description-box bg-light p-3 rounded mb-3">
                                <h5 class="font-weight-bold">Descripción:</h5>
                                <p id="editar_detalle" class="text-muted mb-0" style="font-size: 1.1rem;"></p>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="price-box bg-success text-white p-2 rounded">
                                    <span class="font-weight-bold" style="font-size: 1.1rem;">Precio:</span>
                                    <span id="editar_precio" class="font-weight-bold" style="font-size: 1.3rem;"></span>
                                </div>
                                <div class="size-box bg-light p-2 rounded">
                                    <span class="font-weight-bold text-dark" style="font-size: 1.1rem;">Talla:</span>
                                    <span id="editar_talla" class="font-weight-bold text-dark" style="font-size: 1.2rem;"></span>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="quantity-section">
                                <h5 class="font-weight-bold mb-3">Cantidad a Pedir:</h5>
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary btn-minus" type="button" style="padding: 0.5rem 1rem;">
                                            <i class="fas fa-minus fa-lg"></i>
                                        </button>
                                    </div>
                                    <input type="number" name="cantidad" id="editar_cantidad" 
                                           class="form-control form-control-lg text-center font-weight-bold" 
                                           value="1" min="1" style="font-size: 1.2rem;">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-plus" type="button" style="padding: 0.5rem 1rem;">
                                            <i class="fas fa-plus fa-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg btn-artistic" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cerrar
                </button>
                <button type="button" class="btn btn-success btn-lg btn-artistic" id="btnAgregarPedido">
                    <i class="fas fa-cart-plus mr-2"></i>Agregar al Pedido
                </button>
            </div>
        </div>
    </div>
</div>



<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>




    // Añadir efecto de onda al hacer clic en botones artísticos
$(document).on('click', '.btn-artistic, .btn-outline-artistic, .btn-action-artistic', function(e) {
    const btn = $(this);
    const x = e.pageX - btn.offset().left;
    const y = e.pageY - btn.offset().top;
    
    const ripple = $('<span class="btn-artistic-click-effect"></span>').css({
        left: x,
        top: y,
        width: btn.outerWidth() / 4,
        height: btn.outerWidth() / 4
    });
    
    btn.append(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
});
    
  const canvas = document.getElementById('wave-interference');
  const ctx = canvas.getContext('2d');
  canvas.width = canvas.offsetWidth;
  canvas.height = canvas.offsetHeight;

  let time = 0;
  const waves = [
    { amplitude: 20, frequency: 0.02, phase: 0, color: 'rgba(52, 152, 219, 0.5)' },
    { amplitude: 30, frequency: 0.015, phase: 1.5, color: 'rgba(46, 204, 113, 0.5)' },
    { amplitude: 15, frequency: 0.025, phase: 3, color: 'rgba(155, 89, 182, 0.5)' }
  ];

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    waves.forEach(wave => {
      ctx.beginPath();
      ctx.strokeStyle = wave.color;
      ctx.lineWidth = 2;
      
      for (let x = 0; x < canvas.width; x++) {
        const y = canvas.height / 2 + 
                 wave.amplitude * Math.sin(x * wave.frequency + time + wave.phase) * 
                 Math.sin(time * 0.5);
        
        if (x === 0) {
          ctx.moveTo(x, y);
        } else {
          ctx.lineTo(x, y);
        }
      }
      
      ctx.stroke();
    });
    
    time += 0.05;
    requestAnimationFrame(draw);
  }

  draw();
  // Interacción con mouse/touch
  canvas.addEventListener('mousemove', (e) => {
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

  });

$(document).ready(function() {

    // Mostrar imagen ampliada al hacer clic
    $('.img-popup').click(function(e) {
        e.preventDefault();
        var imgData = $(this).data('img');
        $('#imagenAmpliada').attr('src', 'data:image/jpeg;base64,' + imgData);
        $('#imagenModal').modal('show');
    });
    // Inicializar DataTable
    var tabla = $('#tablaProductosSerigraficos').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        },
        dom: 'lrtip', // Esto elimina el buscador
        columnDefs: [
            { orderable: false, targets: [4,2] } // Ajusté los índices de columnas
        ],
         createdRow: function(row, data, dataIndex) {
            // Agregar atributo data-estado basado en el checkbox
            var checkbox = $(row).find('.estado-ProductosSerigraficos');
            $(row).attr('data-estado', checkbox.is(':checked') ? '1' : '0');
        }
    });

    function filtrarPorEstado(estado) {
        // Limpiar filtros previos
        tabla.search('').columns().search('').draw();
        
        if (estado !== "") {
            // Filtrar usando una función personalizada
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var row = tabla.row(dataIndex).node();
                    return $(row).attr('data-estado') === estado;
                }
            );
            
            tabla.draw();
            // Limpiar el filtro para futuras búsquedas
            $.fn.dataTable.ext.search.pop();
        }
    }
    // Filtrar al hacer clic en los radio
    $('input[name="filtroEstado"]').on('click', function() {
        const estado = $(this).val();
     
        
        $('#filtroEstadoGroup label').removeClass('active');
        $(this).closest('label').addClass('active');

        if (estado === "") {
            tabla.column(4).search('').draw();
        } else {
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var rowEstado = tabla.row(dataIndex).node().querySelector('.estado-ProductosSerigraficos').checked;
                    return (estado === "1") ? rowEstado : !rowEstado;
                }
            );
            tabla.draw();
            // Limpiar el filtro para futuras búsquedas
            $.fn.dataTable.ext.search.pop();
        }


  
    });

    // Mantener activo el filtro "Todos"
    $('#filtroEstadoGroup input[value=""]').prop('checked', true).closest('label').addClass('active');

 


// Manejar el envío del formulario
    $('#btnGuardarProducto').click(function() {
          // Validar el formulario
        if ($('#frm-nuevo-Producto')[0].checkValidity()) {
            // Crear FormData para enviar los datos, incluyendo archivos
            var formData = new FormData($('#frm-nuevo-Producto')[0]);
            
            // Mostrar loader o indicador de carga
            $('#btnGuardarProducto').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Guardando...');
            
            // Enviar datos por AJAX
            $.ajax({
                url: '?c=productos&a=agregar',
                type: 'POST',
                data: formData,
                processData: false, // Importante para FormData
                contentType: false, // Importante para FormData
                success: function(response) {
                    console.log("Respuesta del servidor:", response);
                    
                    if (response.success) {  // <-- Sin JSON.parse
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Producto guardado correctamente',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#modalNuevoProducto').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Ocurrió un error al guardar el producto'
                        });
                    }
                },
                complete: function() {
                    $('#btnGuardarProducto').prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Producto');
                }
            });
        } else {
            // Mostrar mensaje de validación
            $('#frm-nuevo-Producto')[0].reportValidity();
        }
    });

    // Configuración de validación para el formulario
    $("#frm-nuevo-Producto").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 3
            },
            precio: {
                required: true,
                min: 0
            },
            categoria_id: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del producto",
                minlength: "El nombre debe tener al menos 3 caracteres"
            },
            precio: {
                required: "Por favor ingrese el precio",
                min: "El precio no puede ser negativo"
            },
            categoria_id: {
                required: "Por favor seleccione una categoría"
            }
        },
        errorElement: "small",
        errorClass: "text-danger",
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    // Mostrar nombre de archivo seleccionado
    $('.custom-file-input-artistic').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $(this).siblings('.custom-file-label-artistic').find('.file-label-text').text(fileName);
        } else {
            $(this).siblings('.custom-file-label-artistic').find('.file-label-text').text('Seleccionar nueva imagen (opcional)');
        }
    });

    // Función para filtrar por estado
            // Búsqueda general
    $('#btnBuscar').click(function() {
        tabla.search($('#busquedaGeneral').val()).draw();
    });

    // Limpiar búsqueda
    $('#btnLimpiarBusqueda').click(function() {
        $('#busquedaGeneral').val('');
        tabla.search('').draw();
    });

   // Mostrar nombre de archivo seleccionado
    $('.custom-file-input-artistic').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $(this).next('.custom-file-label-artistic').find('.file-label-text')
                .html('<i class="fas fa-check-circle text-success mr-2"></i>' + fileName);
        }
    });
    
    // Mostrar imagen actual si existe
    if ($('#edit_imagen_actual').attr('src')) {
        $('#edit_imagen_actual').show();
    }

    // Manejar cambio de estado
    $(document).on('change', '.estado-ProductosSerigraficos', function() {
        var id = $(this).attr('id').replace('estado_', '');
        var estado = $(this).is(':checked') ? 1 : 0;
        var switchElement = $(this);
        
        $.ajax({
            url: '?c=productos&a=CambiarEstado',
            type: 'POST',
            data: {
                id: id,
                estado: estado
            },
            dataType: 'json',
            success: function(response) {
                if(!response.success) {
                    // Revertir el cambio si falla
                    switchElement.prop('checked', !switchElement.prop('checked'));
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                // Revertir el cambio si hay error de conexión
                switchElement.prop('checked', !switchElement.prop('checked'));
                Swal.fire('Error', 'Error de conexión', 'error');
            }
        });
    });
    
    $(document).on('click', '.btn-editar', function() {
    var ProductosSerigraficosId = $(this).data('id');
    
    $.ajax({
        url: '?c=productos&a=Obtenerproductos',
        type: 'POST',
        data: {id: ProductosSerigraficosId},
        dataType: 'json',
        success: function(response) {
            console.log("Respuesta del servidor:", response);
            
            if(response.success) {
                // Llenar campos de visualización
                $('#editar_id').val(response.data.id);
                $('#editar_idPro').val(ProductosSerigraficosId);
                $('#editar_nombre').text(response.data.nombre);
                $('#editar_detalle').text(response.data.detalle);
                $('#editar_precio').text('$' + parseFloat(response.data.precio).toFixed(2));
                $('#editar_talla').text(response.data.talla || 'N/A');
                $('#editar_categoria').text(response.data.categoria || 'General');
                
                // Resetear cantidad a 1
                $('#editar_cantidad').val(1);
                
                // Mostrar imagen actual si existe
                if(response.data.imagen) {
                    $('#editar_imagen_actual').attr('src', 'data:image/jpeg;base64,' + response.data.imagen).show();
                } else {
                    $('#editar_imagen_actual').hide();
                }
                
                // Mostrar modal
                $('#modalEditarProducto').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            Swal.fire('Error', 'Error al cargar los datos: ' + error, 'error');
        }
    });

        
$('#btnAgregarPedido').click(function() {
    var formData = $('#frm-editar-producto').serialize();
        // 1. Capturar los datos del modal antes de enviar
    const productData = {
        nombre: $('#editar_nombre').text(),
        precio: $('#editar_precio').text(),
        talla: $('#editar_talla').text(),
        cantidad: $('#editar_cantidad').val(),
        detalle: $('#editar_detalle').text()
    };
    
    $.ajax({
        url: '?c=productos&a=CrearPedido',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                // 1. Cerrar primero el modal de Bootstrap
                $('#modalEditarProducto').modal('hide');
                
                // 2. Esperar a que termine la animación de cierre del modal
                $('#modalEditarProducto').on('hidden.bs.modal', function() {
                    // 3. Mostrar SweetAlert después
                    let timerInterval;
                    Swal.fire({
                        title: '¡Producto agregado correctamente!',
                        html: `
                            <div style="text-align: center; margin: 15px 0;">
                                <svg width="80" height="80" viewBox="0 0 16 16" class="bi bi-check2-circle" fill="#28a745" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    <path fill-rule="evenodd" d="M8 2.5A5.5 5.5 0 1 0 13.5 8a.5.5 0 0 1 1 0 6.5 6.5 0 1 1-3.25-5.63.5.5 0 1 1-.5.865A5.472 5.472 0 0 0 8 2.5z"/>
                                </svg>
                            </div>
                            <div style="text-align: left; background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 10px 0;">
                                       <p><strong>Producto:</strong> ${productData.nombre}</p>
                                       <p><strong>Detalle:</strong> ${productData.detalle}</p>
                                       <p><strong>Cantidad:</strong> ${productData.cantidad}</p>
                                       <p><strong>Precio Unitario:</strong> ${productData.precio}</p>

                            </div>
                            <p style="margin-top: 15px; color: #6c757d;">Cerrando en <b></b> segundos...</p>
                        `,
                        timer: 4500,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: () => {
                            const timer = Swal.getPopup().querySelector('b');
                            timerInterval = setInterval(() => {
                                timer.textContent = (Swal.getTimerLeft() / 1000).toFixed(1);
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                            $('.modal').modal('hide');
                        }
                    });
                });
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error', 'Error al procesar el pedido: ' + error, 'error');
        }
    });
});

});

// Funcionalidad para aumentar/disminuir cantidad
$(document).on('click', '.btn-plus', function() {
    var input = $(this).closest('.input-group').find('input');
    input.val(parseInt(input.val()) + 1);
});

$(document).on('click', '.btn-minus', function() {
    var input = $(this).closest('.input-group').find('input');
    var value = parseInt(input.val());
    if(value > 1) {
        input.val(value - 1);
    }
});

    // Limpiar formulario al cerrar modal
    $('#modalNuevoProductosSerigraficos').on('hidden.bs.modal', function() {
        $('#frm-nuevo-ProductosSerigraficos')[0].reset();
        $('#frm-nuevo-ProductosSerigraficos').find('.is-invalid').removeClass('is-invalid');
        $('#frm-nuevo-ProductosSerigraficos').find('.text-danger').remove();
    });


        // Manejar el envío del formulario de edición
    $('#btnActualizarProducto').click(function() {
        // Validar el formulario
        if ($('#frm-editar-producto')[0].checkValidity()) {
            // Crear FormData para enviar los datos, incluyendo archivos
            var formData = new FormData($('#frm-editar-producto')[0]);
            
            // Mostrar loader o indicador de carga
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Guardando...');
            
            // Enviar datos por AJAX
            $.ajax({
                url: '?c=productos&a=EditarProducto',
                type: 'POST',
                data: formData,
                processData: false, // Importante para FormData
                contentType: false, // Importante para FormData
                dataType: 'json',
                success: function(response) {
                    console.log("Respuesta del servidor:", response);
                    
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#modalEditarProducto').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en AJAX:", error);
                    Swal.fire('Error', 'Error de conexión: ' + error, 'error');
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="fas fa-save mr-2"></i> Guardar Cambios');
                }
            });
        } else {
            // Mostrar mensaje de validación
            $('#frm-editar-producto')[0].reportValidity();
        }
    });

    // Configuración de validación para el formulario de edición
    $("#frm-editar-producto").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 3
            },
            precio: {
                required: true,
                min: 0
            },
            categoria_id: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del producto",
                minlength: "El nombre debe tener al menos 3 caracteres"
            },
            precio: {
                required: "Por favor ingrese el precio",
                min: "El precio no puede ser negativo"
            },
            categoria_id: {
                required: "Por favor seleccione una categoría"
            }
        },
        errorElement: "small",
        errorClass: "text-danger",
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    // Vista previa de la nueva imagen seleccionada
    $('#editar_imagen').change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#editar_nueva_imagen_preview').attr('src', e.target.result).show();
                $('.custom-file-label-artistic .file-label-text').text(this.files[0].name);
            }.bind(this);
            
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
</body>
</html>