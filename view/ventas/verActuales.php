<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ProductosSerigraficos</title>
    
    <!-- Bootstrap CSS -->    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <link href="assets/css/body.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
        <!-- Título de la página -->
       <canvas id="wave-interference"></canvas>
    <h2 class="page-title">
        <i class=" "></i>Ventas
    </h2>

    <!-- Filtros -->
    <div class="card">
        <div class="card-header">Búsqueda</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="busquedaGeneral" placeholder="Buscar por nombre del producto o categoria">
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
            <div class="text-right mt-3">
                 <button class="btn btn-success btn-artistic" data-toggle="modal" data-target="#modalNuevoProducto">
                     <i class="fas fa-user-plus"></i> Nuevo Producto
                 </button>
            </div>
        </div>
    </div>

<!-- Tabla de Productos Serigráficos -->
<div class="table-responsive">
    <table class="table table-hover" id="tablaProductosSerigraficos">
        <thead class="thead-dark">
            <tr>
                <th width="5%">ID</th>
                <th width="20%">Producto</th>
                <th width="15%">Categoria</th>
                <th width="10%">Stock</th>
                <th width="10%">StockVendido</th>
                <th width="10%">Fecha</th>
                <th width="15%">VentaAcumulada</th>

                <th width="5%">Acciones</th>
                <!-- <th width="10%">Acciones</th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->model->Listado() as $r): ?>
            <tr>
                <td><?php echo $r->id; ?></td>
                <td><?php echo $r->nombre; ?></td>
                <td><?php echo $r->detalle; ?></td>
                <td><?php echo $r->precio; ?></td>
                <td><?php echo $r->stock; ?></td>
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

                <td><?php echo $r->nomrecat; ?></td>
                <!-- <td>?></td> -->
                <td class="text-center">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input estado-ProductosSerigraficos" 
                            id="estado_<?php echo $r->id; ?>" 
                            <?php echo ($r->estado == 1) ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="estado_<?php echo $r->id; ?>"></label>
                    </div>
                </td>

               <!--  </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-primary btn-editar" data-id="<?php echo $r->id; ?>" 
                            data-toggle="modal" data-target="#modalEditarProducto" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
           
                </td> -->
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
                    <i class="fas fa-box mr-2"></i>Nuevo Producto
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
                        <div class="form-group col-md-6">
                            <input type="number" name="precio" id="precio" class="form-control" placeholder=" " required step="0.01" min="0">
                            <label for="precio">Precio</label>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <input type="number" name="stock" id="stock" class="form-control" placeholder=" " maxlength="20">
                            <label for="talla">Stock</label>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                <?php 
                                $categorias = $this->model->MenuListaCategoria();
                                if(!empty($categorias)) {
                                    foreach($categorias as $categoria): 
                                        $id = $categoria->id ?? $categoria->Categoria_id;
                                        $nombre = $categoria->nombre ?? $categoria->Categoria_nombre;
                                ?>
                                    <option value="<?php echo htmlspecialchars($id); ?>">
                                        <?php echo htmlspecialchars($nombre); ?>
                                    </option>
                                <?php 
                                    endforeach;
                                }
                                ?>
                            </select>
                            <label for="categoria_id">Empresa</label>
                        </div>

                         <div class="form-group col-md-6">
                            <select name="empresa_id" id="empresa_id" class="form-control" required>
                                <option value="">Seleccione una empresa</option>
                                <?php 
                                $empresa = $this->model->MenuListaEmpresa();
                                if(!empty($empresa)) {
                                    foreach($empresa as $empresa): 
                                        $id = $empresa->id ?? $empresa->Empresa_id;
                                        $nombre = $empresa->nombre ?? $empresa->Empresa_nombre;
                                ?>
                                    <option value="<?php echo htmlspecialchars($id); ?>">
                                        <?php echo htmlspecialchars($nombre); ?>
                                    </option>
                                <?php 
                                    endforeach;
                                }
                                ?>
                            </select>
                            <label for="empresa_id">Categoría</label>
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

<!-- Modal Editar Producto Serigráfico -->
<div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="modalEditarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditarProductoLabel">
                    <i class="fas fa-edit mr-2"></i>Editar Imagen
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body position-relative">
                <!-- Partículas de fondo -->
                <div class="modal-particles"></div>
                
                <form id="frm-editar-producto" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editar_id">
                    
                   
                    
                    <div class="form-row">
                        <div class="col-md-6">
                            <!-- Vista previa de la imagen actual -->
                            <div class="text-center mb-3">
                                 <small class="text-muted">Imagen actual</small>
                            </br>
                                <img id="editar_imagen_actual" src="" class="img-thumbnail" style="max-width: 200px; max-height: 200px; display: none;">
                            
                            </div>
                               
                        </div>
                        <div class="col-md-6">
                            <div class="custom-file-artistic">
                                <input type="file" name="imagen" id="editar_imagen" class="custom-file-input-artistic" accept="image/*">
                                <label class="custom-file-label-artistic" for="editar_imagen">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i>
                                    <span class="file-label-text">Cambiar imagen (opcional)</span>
                                </label>
                            </div>
                            <!-- Vista previa de la nueva imagen seleccionada -->
                            <div class="text-center mt-2">
                                <img id="editar_nueva_imagen_preview" src="#" class="img-thumbnail" style="max-width: 200px; max-height: 200px; display: none;">
                            </div>
                        </div>
                    </div>
                    
         
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-artistic" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary btn-artistic" id="btnActualizarProducto">
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
            stock: {
                required: true,
                min: 0
            },
            categoria_id: {
                required: true
            },
            empresa_id: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre del producto",
                minlength: "El nombre debe tener al menos 3 caracteres"
            },
            stock: {
                required: "Por favor ingrese el precio",
                min: "El precio no puede ser negativo"
            },
            precio: {
                required: "Por favor ingrese el precio",
                min: "El precio no puede ser negativo"
            },
            categoria_id: {
                required: "Por favor seleccione una categoría"
            },
            empresa_id: {
                required: "Por favor seleccione una empresa"
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
                    // Llenar campos básicos
                    $('#editar_id').val(response.data.id);
                    $('#editar_nombre').val(response.data.nombre);
                    $('#editar_detalle').val(response.data.detalle);
                    $('#editar_precio').val(response.data.precio);
                    $('#editar_talla').val(response.data.talla);
                    $('#editar_categoria_id').val(response.data.idcat);
                    
                    // Mostrar imagen actual si existe
                    if(response.data.imagen) {
                    // $('#editar_imagen_actual').attr('src', response.data.imagen).show();
                    // $('#editar_imagen_actual')..val(response.data.id_cat);
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