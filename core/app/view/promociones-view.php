<?php
$promociones = PromocionesData::obtenerPromociones(); 

$total_promociones = count($promociones);

$monedas_activos = TipoMonedaData::obtenerTipoMonedaActivos(); 

$categorias_activos = CategoriasData::obtenerCategoriasActivos(); 

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
			            <h3 class="nk-block-title page-title">Listado de Promociones</h3>
			            <div class="nk-block-des text-soft">
			                <p>Tiene un total de <?php echo $total_promociones; ?> promociones.</p>
			            </div>
			        </div>
			        <div class="nk-block-head-content">
			            <div class="toggle-wrap nk-block-tools-toggle">
			                <div class="toggle-expand-content" data-content="pageMenu">
			                    <ul class="nk-block-tools g-3">
			                        <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#promocion-agregar"><em class="icon ni ni-plus"></em><span>Agregar</span></a></li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<?php if ($total_promociones == 0) { ?>
			<?php } else { ?>
			<div class="nk-block">
			    <div class="card card-bordered card-stretch">
			        <div class="card-inner-group">
			            <div class="card-inner p-0">
			                <div class="nk-tb-list nk-tb-ulist is-compact text-center">
			                    <div class="nk-tb-item nk-tb-head">
			                        <div class="nk-tb-col">N°</div>
									<div class="nk-tb-col"><span class="sub-text">Promocion</span></div>
									<div class="nk-tb-col"><span class="sub-text">Costo</span></div>
									<div class="nk-tb-col"><span class="sub-text">Minimo dias</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Estado</span></div>
			                        <div class="nk-tb-col"></div>
			                    </div>
			                    <?php foreach($promociones as $promocion):?>
			                    <div class="nk-tb-item">
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php echo $promocion->id; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $promocion->descripcion; ?>
									</div>
									<div class="nk-tb-col">
			                            <?php echo $promocion->simbolo; ?> <?php echo number_format($promocion->costo,2,'.',' '); ?>
									</div>
									<div class="nk-tb-col">
			                            <?php echo $promocion->dias_minimo; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                        	<?php if ($promocion->estado == 1) { ?>
			                            <span class="tb-status text-success">Activo</span>
			                        	<?php } else { ?>
			                            <span class="tb-status text-danger">Inactivo</span>
			                        	<?php } ?>
			                        </div>
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<button type="button" class="btn btn-warning edicion_promocion" data-relacionado="<?php echo $promocion->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>
			                        </div>
			                    </div>
			                    <?php endforeach; ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php } ?>

			<div class="modal fade" tabindex="-2" id="promocion-agregar">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Registro de Promociones</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
		                    		<div class="col-12">
				                        <div class="form-group">
				                            <label class="form-label" for="descripcion">Descripcion</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="descripcion" name="descripcion" required value="">
				                            </div>
				                        </div>
		                    		</div>
									<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="tipo_moneda_r">Tipo de Moneda</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="tipo_moneda_r" name="tipo_moneda_r">
										        	<?php foreach($monedas_activos as $moneda):?>
										            <option value="<?php echo $moneda->id; ?>"><?php echo $moneda->simbolo; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="costo">Costo</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control input-double" id="costo" name="costo" required value="">
				                            </div>
				                        </div>
		                    		</div>									
									<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="tipo_categoria_r">Tipo de Categoria</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="tipo_categoria_r" name="tipo_categoria_r">
													<option value="0">Seleccione</option>
										        	<?php foreach($categorias_activos as $categoria):?>
										            <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre_categoria; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>		                    		
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="dias_minimo">Dias minimo</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control input-number" id="dias_minimo" name="dias_minimo" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="fecha_vencimiento">Fecha Vencimiento</label>
				                            <div class="form-control-wrap">
				                            	<div class="form-icon form-icon-left">
				                            		<em class="icon ni ni-calendar"></em>
				                            	</div>
				                                <input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" id="fecha_vencimiento" name="fecha_vencimiento" required value="">
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
			                            <button type="button" class="btn btn-lg btn-primary registrar_promocion">Registrar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="modal fade" tabindex="-1" id="promocion-edicion">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Edición de Promociones</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
		                    		<div class="col-12">
				                        <div class="form-group">
				                            <label class="form-label" for="descripcion">Descripcion</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="descripcion" name="descripcion" required value="">
				                            </div>
				                        </div>
		                    		</div>		                    		
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="tipo_moneda">Tipo de Moneda</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="tipo_moneda" name="tipo_moneda">												
										        	<?php foreach($monedas_activos as $moneda):?>
										            <option value="<?php echo $moneda->id; ?>"><?php echo $moneda->simbolo; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
									<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="costo">Costo</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control input-double" id="costo" name="costo" required value="">
				                            </div>
				                        </div>
		                    		</div>
									<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="tipo_categoria">Tipo de Categoria</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="tipo_categoria" name="tipo_categoria">
													<option value="0">Seleccione</option>
										        	<?php foreach($categorias_activos as $categoria):?>
										            <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre_categoria; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="dias_minimo">Dias minimo</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control input-number" id="dias_minimo" name="dias_minimo" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="fecha_vencimiento">Fecha Vencimiento</label>
				                            <div class="form-control-wrap">
				                            	<div class="form-icon form-icon-left">
				                            		<em class="icon ni ni-calendar"></em>
				                            	</div>
				                                <input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" id="fecha_vencimiento" name="fecha_vencimiento" required value="">
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
			                            <button type="button" class="btn btn-lg btn-danger eliminar_promocion">Eliminar</button>
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary actualizar_promocion">Actualizar</button>
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