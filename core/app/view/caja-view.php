<?php
date_default_timezone_set('America/Lima');
$fecha_apertura = date('d/m/Y H:i:s');

$cajas = CajasData::obtenerCajas(); 

$total_cajas = count($cajas);

$caja = CajasData::obtenerCaja(); 

$total_caja = count($caja);

$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;
?>
<form action="" id="hoteles" method="post" name="hoteles">
	<input type="hidden" id="proceso" name="proceso" value="">
	<input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="">
	<input type="hidden" id="id_modulo" name="id_modulo" value="<?php echo $id_modulo; ?>">

	<div class="card container-fluid">
	  <div class="card-body">
			<div class="nk-block-head nk-block-head-sm">
			    <div class="nk-block-between">
			        <div class="nk-block-head-content">
			            <h3 class="nk-block-title page-title">Listado de Mi Caja</h3>
			            <div class="nk-block-des text-soft">
			                <p>Tiene un total de <?php echo $total_cajas; ?> cajas.</p>
			            </div>
			        </div>
			        <div class="nk-block-head-content">
			            <div class="toggle-wrap nk-block-tools-toggle">
			                <div class="toggle-expand-content" data-content="pageMenu">
			                    <ul class="nk-block-tools g-3">
			                    	<?php if ($total_caja == 0) { ?>
			                        <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#caja-agregar"><em class="icon ni ni-plus"></em><span>Agregar</span></a></li>
			                    	<?php } ?>
			                    </ul>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<?php if ($total_cajas == 0) { ?>
			<?php } else { ?>
			<div class="nk-block">
			    <div class="card card-bordered card-stretch">
			        <div class="card-inner-group">
			            <div class="card-inner p-0">
			                <div class="nk-tb-list nk-tb-ulist is-compact">
			                    <div class="nk-tb-item nk-tb-head">
			                        <div class="nk-tb-col">N°</div>
			                        <div class="nk-tb-col"><span class="sub-text">Fecha de Apertura</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Monto de Apertura</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Fecha de Cierre</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Monto de Cierre</span></div>
			                        <div class="nk-tb-col"></div>
			                    </div>
			                    <?php foreach($cajas as $caja):?>
			                    <div class="nk-tb-item">
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php echo $caja->id; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $caja->fecha_apertura; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo number_format($caja->monto_apertura,2,'.',' '); ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $caja->fecha_cierre; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo number_format($caja->monto_cierre,2,'.',' '); ?>
			                        </div>
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php if ($caja->fecha_cierre == NULL) { ?>
			                        	<button type="button" class="btn btn-warning edicion_caja" data-relacionado="<?php echo $caja->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>
			                        	<?php } else { ?>
			                        	---
			                        	<?php } ?>
			                        </div>
			                    </div>
			                    <?php endforeach; ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php } ?>

			<div class="modal fade" tabindex="-2" id="caja-agregar">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Registro de Cajas</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
									<div class="col-6">
										<div class="form-group">
											<label class="form-label" for="fecha_apertura">Fecha de Apertura</label>
											<div class="form-control-wrap">
												<input type="text" class="form-control" id="fecha_apertura" name="fecha_apertura" readonly="true" value="<?php echo $fecha_apertura;?>">
											</div>
										</div>
									</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="monto_apertura">Monto de Apertura</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control input-double" id="monto_apertura" name="monto_apertura" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary registrar_caja">Registrar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="modal fade" tabindex="-1" id="caja-edicion">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Edición de Cajas</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
									<div class="col-6">
										<div class="form-group">
											<label class="form-label" for="fecha_cierre">Fecha de Cierre</label>
											<div class="form-control-wrap">
												<input type="text" class="form-control" id="fecha_cierre" name="fecha_cierre" readonly="true" value="">
											</div>
										</div>
									</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="monto_cierre">Monto de Cierre</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control input-double" id="monto_cierre" name="monto_cierre" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary actualizar_caja">Actualizar</button>
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