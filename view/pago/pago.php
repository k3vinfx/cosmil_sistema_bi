<!-- Begin Page Content -->


<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-6">
		<h1 class="h3 mb-0 text-gray-800">Pagos</h1>

	</div>
    
	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">

                    <tr>
                        <th >Código </th>
                        <th >Id Usuario</th>
                        <th >Plan</th>
                        <th >Inicio_Servicio</th>
                        <th >Fin_Servicio</th>
                        <th >Comprobante</th>
              
                        <th >Estado</th>
                        <th >Acciones </th>
                
                    </tr>
                </thead>
                <tbody>

    <?php foreach($this->model->MenuLista() as $r): ?>
        <tr>
            <td><?php echo $r->Pago_id; ?></td>
            <td><?php echo $r->Pago_Cliente_Id; ?></td>
            <td><?php if ($r->Pago_Meses == 1) {
                echo "1 MES";
            } if ($r->Pago_Meses == 2) {
                echo "3 MES";
            }if ($r->Pago_Meses == 3) {
                echo "6 MES";
            }?>
        
        
            </td>

            <td><?php 
            if ($r->Pago_Incio !== null) {
                echo $r->Pago_Incio;}else{
                     echo "Falta Aprovación";
                };
            
            ?></td>
            <td><?php  if ($r->Pago_Fin !== null) {
                echo $r->Pago_Fin;}else{
                     echo "Falta Aprovación";
                }; ?></td>
            <td>
                <a href="<?php echo $r->Pago_comprobante; ?>" class="popup-link">
                    <img src="<?php echo $r->Pago_comprobante; ?>" width="200"/>
                </a>
            </td>
   
          <td><?php if ($r->estado == 1) {
                echo "Cancelado";
            } else {
                echo "Falta Aprovación";
            }?></td>
            <td>
                <a href="?c=pago&a=Crud_Aux&Pago_id=<?php echo $r->Pago_id; ?> &Pago_Meses=<?php echo $r->Pago_Meses; ?> &Pago_Cliente_Id=<?php echo $r->Pago_Cliente_Id; ?> "class="btn btn-primary"><i class='fas fa-edit'></i>Aprobar</a>         
            </td>

        
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

</div>
</div>


</div>
<!-- /.container-fluid -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluir CSS para Magnific Popup -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- Incluir JS para Magnific Popup -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>


    <script>
        $(document).ready(function() {
    $('.popup-link').magnificPopup({
        type: 'image'
        // otras opciones si las necesitas
    });
});

    $(document).ready(function(){
        $("#frm-nueva-neurona").submit(function(){
            return $(this).validate();
        });
    })
</script>

