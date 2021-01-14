<?php
$habitaciones = HabitacionesData::obtenerHabitaciones(); 

$total_habitaciones = count($habitaciones);

$categorias_activos = CategoriasData::obtenerCategoriasActivos(); 

$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;
?>
<form action="" id="hoteles" method="post" name="hoteles">
	<input type="hidden" id="proceso" name="proceso" value="">
	<input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="">
	<input type="hidden" id="imagen_actual" name="imagen_actual" value="">
	<input type="hidden" id="id_modulo" name="id_modulo" value="<?php echo $id_modulo; ?>">

	<div class="card container-fluid">
	  <div class="card-body">
			<div class="nk-block-head nk-block-head-sm">
			    <div class="nk-block-between">
			        <div class="nk-block-head-content">
			            <h3 class="nk-block-title page-title">Listado de Habitaciones</h3>
			            <div class="nk-block-des text-soft">
			                <p>Tiene un total de <?php echo $total_habitaciones; ?> habitaciones.</p>
			            </div>
			        </div>
			        <div class="nk-block-head-content">
			            <div class="toggle-wrap nk-block-tools-toggle">
			                <div class="toggle-expand-content" data-content="pageMenu">
			                    <ul class="nk-block-tools g-3">
			                        <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#habitacion-agregar"><em class="icon ni ni-plus"></em><span>Agregar</span></a></li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<?php if ($total_habitaciones == 0) { ?>
			<?php } else { ?>
			<div class="nk-block">
			    <div class="card card-bordered card-stretch">
			        <div class="card-inner-group">
			            <div class="card-inner p-0">
			                <div class="nk-tb-list nk-tb-ulist is-compact">
			                    <div class="nk-tb-item nk-tb-head">
			                        <div class="nk-tb-col">N°</div>
			                        <div class="nk-tb-col"><span class="sub-text">Habitacion</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Estado</span></div>
			                        <div class="nk-tb-col"></div>
			                    </div>
			                    <?php foreach($habitaciones as $habitacion):?>
			                    <div class="nk-tb-item">
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php echo $habitacion->id; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $habitacion->nombre_habitacion; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                        	<?php if ($habitacion->estado_habitacion == 1) { ?>
			                            <span class="tb-status text-success">Activo</span>
			                        	<?php } else { ?>
			                            <span class="tb-status text-danger">Inactivo</span>
			                        	<?php } ?>
			                        </div>
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<button type="button" class="btn btn-warning edicion_habitacion" data-relacionado="<?php echo $habitacion->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>
			                        </div>
			                    </div>
			                    <?php endforeach; ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php } ?>

			<div class="modal fade" tabindex="-2" id="habitacion-agregar">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Registro de Habitaciones</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
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
				                            <label class="form-label" for="detalles">Detalles</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="detalles" name="detalles" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="id_categoria_r">Categoria</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="id_categoria_r" name="id_categoria_r">
										        	<?php foreach($categorias_activos as $categoria):?>
										            <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre_categoria; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
									<div class="col-6">
										<div class="form-group">
											<label class="form-label">URL Imagen</label>
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" multiple="" class="custom-file-input" id="url_imagen_r" name="url_imagen_r" required>
													<label class="custom-file-label" for="url_imagen_r">Choose file</label>
												</div>
											</div>
										</div>
									</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="estado_r">Estado</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="estado_r" name="estado_r">
										            <option value="1">Activo</option>
										            <option value="0">Inactivo</option>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary registrar_habitacion">Registrar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="modal fade" tabindex="-1" id="habitacion-edicion">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Edición de Habitaciones</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
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
				                            <label class="form-label" for="detalles">Detalles</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="detalles" name="detalles" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="id_categoria">Categoria</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="id_categoria" name="id_categoria">
										        	<?php foreach($categorias_activos as $categoria):?>
										            <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre_categoria; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
									<div class="col-6">
										<div class="form-group">
											<label class="form-label">URL Imagen</label>
											<div class="form-control-wrap">
												<div class="custom-file">
													<input type="file" multiple="" class="custom-file-input" id="url_imagen" name="url_imagen" required>
													<label class="custom-file-label" for="url_imagen">Choose file</label>
												</div>
											</div>
										</div>
									</div>
		                    		<div class="col-12">
		                    			<div class="form-group">
		                    				<div class="form-control-wrap">
		                    					<img src="" id="imagen_habitacion" name="imagen_habitacion" />
		                    				</div>
		                    			</div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="estado">Estado</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="estado" name="estado">
										            <option value="1">Activo</option>
										            <option value="0">Inactivo</option>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
			                            <button type="button" class="btn btn-lg btn-danger eliminar_habitacion">Eliminar</button>
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary actualizar_habitacion">Actualizar</button>
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