<?php
$modulos = ModulosData::obtenerModulos(); 
$modulos_padre = ModulosData::obtenerModuloPadre(); 

$total_modulos = count($modulos);

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
			            <h3 class="nk-block-title page-title">Listado de Modulos</h3>
			            <div class="nk-block-des text-soft">
			                <p>Tiene un total de <?php echo $total_modulos; ?> modulos.</p>
			            </div>
			        </div>
			        <div class="nk-block-head-content">
			            <div class="toggle-wrap nk-block-tools-toggle">
			                <div class="toggle-expand-content" data-content="pageMenu">
			                    <ul class="nk-block-tools g-3">
			                        <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modulo-agregar"><em class="icon ni ni-plus"></em><span>Agregar</span></a></li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<?php if ($total_modulos == 0) { ?>
			<?php } else { ?>
			<div class="nk-block">
			    <div class="card card-bordered card-stretch">
			        <div class="card-inner-group">
			            <div class="card-inner p-0">
			                <div class="nk-tb-list nk-tb-ulist is-compact">
			                    <div class="nk-tb-item nk-tb-head">
			                        <div class="nk-tb-col">N°</div>
			                        <div class="nk-tb-col"><span class="sub-text">Nombres</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">URL de Modulo</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Es Modulo Padre</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Modulo Padre</span></div>
			                        <div class="nk-tb-col"></div>
			                    </div>
			                    <?php foreach($modulos as $modulo):?>
			                    <div class="nk-tb-item">
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php echo $modulo->id; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $modulo->nombre_modulo; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $modulo->url_modulo; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                        	<?php if ($modulo->modulo_padre == 1) { ?>
			                            <span class="tb-status text-success">Si</span>
			                        	<?php } else { ?>
			                            <span class="tb-status text-danger">No</span>
			                        	<?php } ?>
			                        </div>
			                        <div class="nk-tb-col">
			                        	<?php if ($modulo->modulo_padre == 0) { ?>
			                           	<?php foreach($modulos_padre as $item_modulo_padre):?>
			                           		<?php if ($item_modulo_padre->id == $modulo->id_modulo_padre) { ?>
			                           			<?php echo $item_modulo_padre->nombre_modulo; ?>
			                           		<?php } ?>	
			                           	<?php endforeach; ?>
			                        	<?php } else { ?>
			                            ---
			                        	<?php } ?>
			                        </div>
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<button type="button" class="btn btn-warning edicion_modulo" data-relacionado="<?php echo $modulo->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>
			                        </div>
			                    </div>
			                    <?php endforeach; ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php } ?>

			<div class="modal fade" tabindex="-2" id="modulo-agregar">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Registro de Modulos</h5>
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
				                            <label class="form-label" for="url">URL</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="url" name="url" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="icono">Icono</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="icono" name="icono" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="modulo_padre_r">Es Modulo Padre</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="modulo_padre_r" name="modulo_padre_r">
										            <option value="1">Si</option>
										            <option value="0">No</option>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="id_modulo_padre_r">Modulo Padre</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="id_modulo_padre_r" name="id_modulo_padre_r">
										        	<option value="0">--</option>
										        	<?php foreach($modulos_padre as $item_modulo_padre):?>
										            <option value="<?php echo $item_modulo_padre->id; ?>"><?php echo $item_modulo_padre->nombre_modulo; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary registrar_modulo">Registrar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="modal fade" tabindex="-1" id="modulo-edicion">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Edición de Modulos</h5>
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
				                            <label class="form-label" for="url">URL</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="url" name="url" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="icono">Icono</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="icono" name="icono" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="modulo_padre">Es Modulo Padre</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="modulo_padre" name="modulo_padre">
										            <option value="1">Si</option>
										            <option value="0">No</option>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="id_modulo_padre">Modulo Padre</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="id_modulo_padre" name="id_modulo_padre">
										        	<option value="0">--</option>
										        	<?php foreach($modulos_padre as $item_modulo_padre):?>
										            <option value="<?php echo $item_modulo_padre->id; ?>"><?php echo $item_modulo_padre->nombre_modulo; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
			                            <button type="button" class="btn btn-lg btn-danger eliminar_modulo">Eliminar</button>
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary actualizar_modulo">Actualizar</button>
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