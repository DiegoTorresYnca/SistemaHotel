<?php
$categorias = CategoriasData::obtenerCategorias(); 
$habitaciones = HabitacionesData::obtenerHabitaciones(); 

$documentos_activos = DocumentosData::obtenerDocumentosActivos(); 
$clientes = ClientesData::obtenerClientes(); 

$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;
?>
<form action="" id="hoteles" method="post" name="hoteles">

	<input type="hidden" id="proceso" name="proceso" value="">
	<input type="hidden" id="id_modulo" name="id_modulo" value="<?php echo $id_modulo; ?>">

<div class="card container-fluid">
	<div class="card-body">
		<h3 class="nk-block-title page-title">Realizar reserva</h3>
		<form action="#" class="form-validate is-alter">
			<div class="w-100">
				<div class="row pb-3">
					<div class="col-lg-4">
						<label class="form-label" for="tipo_categoria">Categoria</label>
						<div class="form-control-wrap">
							<select class="form-select" id="tipo_categoria" name="tipo_categoria">
								<option value="0">Seleccione</option>
								<?php foreach($categorias as $categoria):?>
								<option value="<?php echo $categoria->id; ?>"><?php  echo $categoria->nombre_categoria; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<label class="form-label" for="habitacion">Habitación</label>
						<div class="form-control-wrap">
							<select class="form-select" id="habitacion" name="habitacion">
								<option value="0">Seleccione</option>
								<?php foreach($habitaciones as $habitacion):?>
								<option value="<?php echo $habitacion->id; ?>"><?php echo $habitacion->nombre_habitacion; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label class="form-label" for="fecha_filtro">Fecha</label>
							<div class="form-control-wrap">
								<input type="text" class="form-control date-picker" id="fecha_filtro" name="fecha_filtro" value="">
							</div>
						</div>
					</div>
					<div class="col-lg-1">
						<div class="mt-4 pt-1">
							<button class="btn btn-primary">Filtrar</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- Despues de realizar el filtro mostraremos el calendario con los feriados y reservas actuales que tenga dicha habitacion
		los campos son opcionales -->

		<div id="calendar"></div>

		<div class="modal fade" tabindex="-2" id="reserva-agregar">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Registro de Reserva</h5>
						<a href="#" class="close" data-dismiss="modal" aria-label="Close">
							<em class="icon ni ni-cross"></em>
						</a>
					</div>
					<div class="modal-body">
						<input type="hidden" id="habitacion" name="habitacion">
						<input type="hidden" id="tipo_categoria" name="tipo_categoria">
						<div class="row gy-4">
							<div class="col-lg-10">
								<div class="form-group">
									<label class="form-label" for="cliente">Clientes</label>
									<div class="form-control-wrap">
										<select class="form-select" id="cliente" name="cliente">
											<option value="0">Seleccione</option>
											<?php foreach($clientes as $cliente):?>
											<option value="<?php echo $cliente->id; ?>">
												<?php 
													echo $cliente->nombre; 
													echo " ";
													echo $cliente->apellido_paterno;
													echo " ";
													echo $cliente->apellido_materno;
												?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-1">
								<div class="mt-4 pt-1">
									<button class="btn btn-primary agregar-cliente" type="button">
										<em class="icon ni ni-user-add"></em>
									</button>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label class="form-label" for="referido">Referido</label>
									<div class="form-control-wrap">
										<select class="form-select" id="referido" name="referido">
											<option value="0">Ninguno</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-label" for="check_in">Check In</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control date-picker" id="check_in" name="check_in" required value="">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-label" for="hora_entrada">Hora</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control time-picker" id="hora_entrada" name="hora_entrada" placeholder="Hora de entrada">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-label" for="check_out">Check Out</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control date-picker" id="check_out" name="check_out" required value="">
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-label" for="hora_salida">Hora</label>
									<div class="form-control-wrap">
										<input type="text" class="form-control time-picker" id="hora_salida" name="hora_salida" placeholder="Hora de salida">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-label" for="observacion">Observación</label>
									<div class="form-control-wrap">
										<textarea class="form-control no-resize" id="observacion" name="observacion"></textarea>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="text-center">
									<button type="button" class="btn btn-primary registrar_reserva">Reservar</button>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="text-center">
									<button type="button" class="btn btn-secondary pagar_reserva">Procesar pago</button>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="text-center">
									<button type="button" class="btn btn-danger cancelar_reserva">Cancelar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" tabindex="-2" id="cliente-agregar">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title">Registro de Clientes</h5>
	                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
	                        <em class="icon ni ni-cross"></em>
	                    </a>
	                </div>
	                <div class="modal-body">
	                    <form action="#" class="form-validate is-alter">
	                    	<div class="row gy-4">
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="tipo_documento_r">Tipo de Documento</label>
			                            <div class="form-control-wrap">
									        <select class="form-select" id="tipo_documento_r" name="tipo_documento_r">
									        	<?php foreach($documentos_activos as $documento):?>
									            <option value="<?php echo $documento->id; ?>"><?php echo $documento->nombre_documento; ?></option>
									            <?php endforeach; ?>
									        </select>
			                            </div>
			                        </div>
	                    		</div>
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="numero_documento">Numero de Documento</label>
			                            <div class="form-control-wrap">
			                                <input type="text" class="form-control" id="numero_documento" name="numero_documento" required value="">
			                            </div>
			                        </div>
	                    		</div>
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="nombre">Nombre</label>
			                            <div class="form-control-wrap">
			                                <input type="text" class="form-control" id="nombre" name="nombre" required value="">
			                            </div>
			                        </div>
	                    		</div>
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="apellido_paterno">Apellido Paterno</label>
			                            <div class="form-control-wrap">
			                                <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required value="">
			                            </div>
			                        </div>
	                    		</div>
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="apellido_materno">Apellido Materno</label>
			                            <div class="form-control-wrap">
			                                <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required value="">
			                            </div>
			                        </div>
	                    		</div>
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="celular">Celular</label>
			                            <div class="form-control-wrap">
			                                <input type="text" class="form-control" id="celular" name="celular" required value="">
			                            </div>
			                        </div>
	                    		</div>
	                    		<div class="col-6">
			                        <div class="form-group">
			                            <label class="form-label" for="correo">Correo Electrónico</label>
			                            <div class="form-control-wrap">
			                                <input type="text" class="form-control" id="correo" name="correo" required value="">
			                            </div>
			                        </div>
	                    		</div>
	                    	</div>
	                        <div class="form-group row gy-gs">
	                        	<div class="col-6 text-left">
	                        	</div>
	                        	<div class="col-6 text-right">
									<input type="hidden" id="estado_r" name="estado_r" value="1">

		                            <button type="button" class="btn btn-lg btn-primary registrar_cliente_reserva">Registrar</button>
	                        	</div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>

	</div>
</div>

</form>