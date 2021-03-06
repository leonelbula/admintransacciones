<div class="container-fluid">

	 

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Lista de Transacciones</h1>

<!--	<div class="my-2">
		<a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#RegistrarTransaccion">
			<span class="icon text-white-50">
				<i class="fas fa-check"></i>
			</span>
			<span class="text">Nueva Transaccion</span>
		</a>
	</div>-->
	<!-- DataTales Example -->
	<div class="card shadow mb-4">

		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Transacciones Registradas</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
                <table class="table table-bordered tablacuentausuario" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Fecha</th>
							<th>Titular</th>
							<th>Banco</th>
							<th>N° Cuenta</th>
							<th>Valor</th>
							<th>Estado</th>
							<th>Anexo Usuario</th>
							<th>Acciones</th>
							<th>Observaciones</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Fecha</th>
							<th>Titular</th>
							<th>Banco</th>
							<th>N° Cuenta</th>
							<th>Valor</th>
							<th>Estado</th>
							<th>Anexo Usuario</th>
							<th>Acciones</th>
							<th>Observaciones</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
						
						$i = 1;
						while ($row2 = $detalles->fetch_object()) :
					
							$banco = bancosController::ListabancosId($row2->id_banco);

								while ($row1 = $banco->fetch_object()) {

									$nombrebanco = $row1->nombre;
								} 
							?>
							<tr>
								<td><?= $i++ ?></td>
								<td><?= $row2->fecha ?></td>
								<td><?= $row2->titular ?></td>
								<td><?= $nombrebanco ?></td>
								<td><?= $row2->num_cuenta ?></td>
								<td><?= $row2->valor ?></td>
								<td><?php
									if ($row2->estado == 3) {
										echo '<a href="" class="btn btn-primary btn-icon-split">
											<span class="icon text-white-50">
											  <i class="fas fa-flag"></i>
											</span>
											<span class="text">En Espera</span>
										  </a>';
									} elseif ($row2->estado == 2) {
										echo '<a href="" class="btn btn-warning btn-icon-split">
											<span class="icon text-white-50">
											  <i class="fas fa-exclamation-triangle"></i>
											</span>
											<span class="text">Sin Confirmar</span>
										  </a>';
									} elseif ($row2->estado == 1) {
										echo '<a href="" class="btn btn-info btn-icon-split">
												<span class="icon text-white-50">
												  <i class="fas fa-info-circle"></i>
												</span>
												<span class="text">Procesando</span>
											  </a>';
									} else {
										echo '<a href="" class="btn btn-success btn-icon-split">
												<span class="icon text-white-50">
												  <i class="fas fa-check"></i>
												</span>
												<span class="text">Transancion exitosa</span>
											  </a>';
									}
									?></td>
								<td><div class="btn-group">
										<?php if ($row2->estado == 3) {
										echo '<a href="'.URL_BASE.'giros/procesar&id='.$row2->id.'" class="btn btn-info btn-icon-split">
												<span class="icon text-white-50">
												  <i class="fas fa-info-circle"></i>
												</span>
												<span class="text">Continuar</span>
											  </a>';
										} else if($row2->estado == 2){
											echo '<a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#confirmarTransaccion">
											<span class="icon text-white-50">
											  <i class="fas fa-exclamation-triangle"></i>
											</span>
											<span class="text">Confirmar</span>
										</a>';
										}else if($row2->estado == 1){
										echo '<a href="#" class="btn btn-secondary btn-icon-split">
										<span class="icon text-white-50">
										  <i class="fas fa-arrow-right"></i>
										</span>
										<span class="text">Ver anexo</span>
									  </a>';
										}else{
											echo '<a href="" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#confirmarTransaccion">
											<span class="icon text-white-50">
												<i class="fas fa-check"></i>
											</span>
											<span class="text">En Espera</span>
										</a>';
										}?>
									</div>  
								</td>
								<td><div class="btn-group">

										<?php if ($row2->estado == 1 ) {
												echo '<a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#confirmarTransaccion">
											<span class="icon text-white-50">
											  <i class="fas fa-check"></i>
											</span>
											<span class="text">Confirmar</span>
										</a>';
										}?>

										

									</div>  
								</td>
								<td><div class="btn-group">

										<?php if ($row2->anexo != 'NULL') {
												echo '<a href="" class="btn btn-light btn-icon-split">
												<span class="icon text-gray-600">
												  <i class="fas fa-check"></i>
												</span>
												<span class="text">Respuesta</span>
											  </a>';
										} ?>

									

									</div>  
								</td>
							</tr>                    
<?php endwhile; ?>
					</tbody>
                </table>
			</div>
		</div>
	</div>
	  
</div>

<div class="modal fade" id="RegistrarTransaccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Transaccion</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= URL_BASE ?>giros/guardar" method="POST" >
					<input type="hidden" name="idUsuario" value="<?= $_SESSION['identity']->id ?>"/>
					<div class="form-group">
						<label>Cuenta a enviar </label>
						<select class="form-control select2" style="width: 100%;" required name="datosbancarios">
							<option>Selecione un Cuenta</option>
							<?php
							$id_usuario = $_SESSION['identity']->id;
							$listacuentas = cuentasController::datosbancario($id_usuario);
							while ($row = $listacuentas->fetch_object()) :
								?>
								<option value="<?= $row->id ?>"><?= $row->titular ?> - <?= $row->num_cuenta ?></option>
<?php endwhile; ?>

						</select>
					</div>
					<div class="form-group">
						<label for="valoraenviar">Valor a enviar</label>
						<input type="number" class="form-control" id="" name="valor" required placeholder="valor a enviar">
					</div>					

					<center>
						<button class="btn btn-primary" type="submit">
							Procesar Transaccion 
						</button>
					</center>

			</div>
			</form>

		</div>
		<div class="modal-footer">

			<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>

		</div>
	</div>
</div>


<!-- /.container-fluid -->