<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <link href="assets/css/body.css" rel="stylesheet" type="text/css">
<body>
<div class="container">
        <!-- Título de la página -->
       <canvas id="wave-interference"></canvas>
    <h2 class="page-title">
        <i class="fas fa-tags"></i> Empresas
    </h2>

    <!-- Filtros -->
    <div class="card">
        <div class="card-header">Búsqueda</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="busquedaGeneral" placeholder="Buscar por nombre">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="btnBuscar"><i class="fas fa-search"></i></button>
                            <button class="btn btn-secondary" id="btnLimpiarBusqueda"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>
            

                <!-- Actualiza esta parte del HTML (filtros) -->
                <div class="col-md-6">
                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons" id="filtroEstadoGroup">
                        <label class="btn btn-outline-primary btn-outline-artistic">
                            <input type="radio" name="filtroEstado" value="" autocomplete="off"> Todos
                        </label>
                        <label class="btn btn-outline-success btn-outline-artistic">
                            <input type="radio" name="filtroEstado" value="1" autocomplete="off"> Activos
                        </label>
                        <label class="btn btn-outline-secondary btn-outline-artistic">
                            <input type="radio" name="filtroEstado" value="0" autocomplete="off"> Inactivos
                        </label>
                    </div>
   
                </div>
                    
                
            </div>
                      <!-- <div class="text-right mt-3">
                        <button class="btn btn-success btn-artistic" data-toggle="modal" data-target="#modalNuevaCategoria">
                            <i class="fas fa-plus"></i> Nueva Empresas
                        </button>
                    </div> -->
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-hover" id="tablaEmpresas">
            <thead class="thead-dark">
            <tr>
                <th width="5%">ID</th>
                <th width="30%">Nombre</th>
                <th width="20%">Fecha Creación</th>
                <th width="10%">Estado</th>
                <th width="10%">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listar() as $r): ?>
            <tr>
                <td><?php echo $r->id; ?></td>
                <td><?php echo $r->nombre; ?></td>
                <td><?php echo date('d/m/Y', strtotime($r->fecha)); ?></td>
                <td class="text-center">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input estado-categoria" 
                            id="estado_<?php echo $r->id; ?>" 
                            <?php echo ($r->estado == 1) ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="estado_<?php echo $r->id; ?>"></label>
                    </div>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-artistic btn-editar" data-id="<?php echo $r->id; ?>" 
                            data-toggle="modal" data-target="#modalEditarCategoria" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
<!-- Modal Nueva Empresa -->
<div class="modal fade" id="modalNuevaCategoria" tabindex="-1" role="dialog" aria-labelledby="modalNuevaCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalNuevaCategoriaLabel">
                    <i class="fas fa-plus-circle mr-2"></i>Nueva Empresa
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <!-- Partículas de fondo -->
                <div class="modal-particles"></div>
                
                <form id="frm-nueva-categoria">
                    <div class="form-group">
                        <input type="text" name="nombre" id="nueva_nombre" class="form-control" placeholder=" " required>
                        <label for="nueva_nombre">Nombre de la Empresa</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-artistic" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="submit" form="frm-nueva-categoria" class="btn btn-primary btn-artistic" id="btnGuardarCategoria">
                    <i class="fas fa-save mr-2"></i>Guardar Empresa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Empresas -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditarCategoriaLabel">
                    <i class="fas fa-edit mr-2"></i>Editar Empresas
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <!-- Partículas de fondo -->
                <div class="modal-particles"></div>
                
                <form id="frm-editar-categoria">
                    <input type="hidden" name="id" id="editar_id_categoria">
                    <div class="form-group">
                        <input type="text" name="nombre" id="editar_nombre_categoria" class="form-control" placeholder=" " required>
                        <label for="editar_nombre_categoria">Nombre de la Empresas</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-artistic" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary btn-artistic" id="btnActualizarCategoria">
                    <i class="fas fa-save mr-2"></i>Guardar Cambios
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fluid-canvas/1.0.0/fluid-canvas.min.js"></script>
<script>
$(document).ready(function() {
    // Inicializar DataTable
    var tabla = $('#tablaEmpresas').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        },
        dom: 'lrtip', // Esto elimina el buscador
        columnDefs: [
            { orderable: false, targets: [3,2] } // Columnas de Estado y Acciones no ordenables
        ],
         createdRow: function(row, data, dataIndex) {
            // Agregar atributo data-estado basado en el checkbox
            var checkbox = $(row).find('.estado-categoria');
            $(row).attr('data-estado', checkbox.is(':checked') ? '1' : '0');
        }
    });

    // Búsqueda general
    $('#btnBuscar').click(function() {
        tabla.search($('#busquedaGeneral').val()).draw();
    });



        // Función para filtrar por estado
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
    // Limpiar búsqueda
    $('#btnLimpiarBusqueda').click(function() {
        $('#busquedaGeneral').val('');
        tabla.search('').draw();
    });

    // Filtro por estado
     $('input[name="filtroEstado"]').on('click', function() {
        var estado = $(this).val();
        
        // Actualizar clases activas
        $('#filtroEstadoGroup label').removeClass('active');
        $(this).closest('label').addClass('active');
        
        // Filtrar la tabla
        if (estado === "") {
            // Mostrar todos los registros
  tabla.column(3).search('').draw();
        } else {
      $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var rowEstado = tabla.row(dataIndex).node().querySelector('.estado-categoria').checked;
                    return (estado === "1") ? rowEstado : !rowEstado;
                }
            );
            tabla.draw();
            // Limpiar el filtro para futuras búsquedas
            $.fn.dataTable.ext.search.pop();
            $.fn.dataTable.ext.search.pop();
        }
    });

    // Establecer "Todos" como seleccionado por defecto
    $('#filtroEstadoGroup input[value=""]').prop('checked', true).closest('label').addClass('active');

    // Efecto de onda en botones
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
    
    // Efecto de onda en el fondo
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

    // Configuración de validación para formulario NUEVA Empresas
    $("#frm-nueva-categoria").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre de la Empresa",
                minlength: "El nombre debe tener al menos 3 caracteres"
            }
        },
        errorElement: "small",
        errorClass: "text-danger",
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            var btn = $('#btnGuardarCategoria');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Guardando...');
            
            $.ajax({
                type: 'POST',
                url: '?c=empresas&a=Guardar',
                data: $(form).serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'Empresa guardada correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#modalNuevaCategoria').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Error al guardar la Empresa'
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error de conexión: ' + xhr.statusText
                    });
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="fas fa-save mr-2"></i>Guardar Empresa');
                }
            });
        }
    });

    // Manejar cambio de estado
    $(document).on('change', '.estado-categoria', function() {
        var id = $(this).attr('id').replace('estado_', '');
        var estado = $(this).is(':checked') ? 1 : 0;
        var switchElement = $(this);
        
        $.ajax({
            url: '?c=empresas&a=CambiarEstado',
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
    
    // Cargar datos para edición
    $(document).on('click', '.btn-editar', function() {
        var categoriaId = $(this).data('id');
        
        $.ajax({
            url: '?c=empresas&a=ObtenerCategoria',
            type: 'POST',
            data: {id: categoriaId},
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#editar_id_categoria').val(response.data.id);
                    $('#editar_nombre_categoria').val(response.data.nombre);
                    
                    $('#modalEditarCategoria').modal('show');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Error al cargar los datos', 'error');
            }
        });
    });

    // Validación y envío del formulario de edición
    $("#frm-editar-categoria").validate({
        rules: {
            nombre: { 
                required: true, 
                minlength: 3 
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre de la Empresa",
                minlength: "El nombre debe tener al menos 3 caracteres"
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

    // Enviar formulario de edición
    $('#btnActualizarCategoria').click(function() {
        if($("#frm-editar-categoria").valid()) {
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Guardando...');
            
            $.ajax({
                url: '?c=empresas&a=Editar',
                type: 'POST',
                data: $('#frm-editar-categoria').serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#modalEditarCategoria').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Error de conexión', 'error');
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="fas fa-save mr-2"></i> Guardar Cambios');
                }
            });
        }
    });

    // Limpiar formulario al cerrar modal
    $('#modalNuevaCategoria').on('hidden.bs.modal', function() {
        $('#frm-nueva-categoria')[0].reset();
        $('#frm-nueva-categoria').find('.is-invalid').removeClass('is-invalid');
        $('#frm-nueva-categoria').find('.text-danger').remove();
    });
});
</script>