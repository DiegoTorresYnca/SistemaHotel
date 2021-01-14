<?php
$clientes = ClientesData::obtenerClientes(); 

$total_clientes = count($clientes);

$documentos_activos = DocumentosData::obtenerDocumentosActivos(); 

$referidos = ReferidosData::obtenerReferidos(); 

$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;

$referidos=ReferidosData::obtenerReferidos();
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
			            <h3 class="nk-block-title page-title">Listado de Clientes</h3>
			            <div class="nk-block-des text-soft">
			                <p>Tiene un total de <?php echo $total_clientes; ?> clientes.</p>
			            </div>
			        </div>
			        <div class="nk-block-head-content">
			            <div class="toggle-wrap nk-block-tools-toggle">
			                <div class="toggle-expand-content" data-content="pageMenu">
			                    <ul class="nk-block-tools g-3">
			                        <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#cliente-agregar"><em class="icon ni ni-plus"></em><span>Agregar</span></a></li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<?php if ($total_clientes == 0) { ?>
			<?php } else { ?>
			<div class="nk-block">
			    <div class="card card-bordered card-stretch">
			        <div class="card-inner-group">
			            <div class="card-inner p-0">
			                <div class="nk-tb-list nk-tb-ulist is-compact">
			                    <div class="nk-tb-item nk-tb-head">
			                        <div class="nk-tb-col">N°</div>
			                        <div class="nk-tb-col"><span class="sub-text">Nombres</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Apellido Paterno</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Apellido Materno</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Correo Electonico</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Estado</span></div>
			                        <div class="nk-tb-col"></div>
			                    </div>
			                    <?php foreach($clientes as $cliente):?>
			                    <div class="nk-tb-item">
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php echo $cliente->id; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $cliente->nombre; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $cliente->apellido_paterno; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $cliente->apellido_materno; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $cliente->correo_cliente; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                        	<?php if ($cliente->estado_cliente == 1) { ?>
			                            <span class="tb-status text-success">Activo</span>
			                        	<?php } else { ?>
			                            <span class="tb-status text-danger">Inactivo</span>
			                        	<?php } ?>
			                        </div>
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<button type="button" class="btn btn-warning edicion_cliente" data-relacionado="<?php echo $cliente->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>
			                        </div>
			                    </div>
			                    <?php endforeach; ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php } ?>

			<div class="modal fade" tabindex="-2" id="cliente-agregar">
		        <div class="modal-dialog modal-lg" role="document">
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
										        	<option value="0">--</option>
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
				                            <div class="row">
					                            <div class="form-control-wrap col-9">
					                                <input type="text" class="form-control input-number" id="numero_documento" name="numero_documento" required value="">
					                            </div>
					                            <div class="form-control-wrap col-3">
					                            	<button type="button" class="btn btn-info buscar_cliente" data-seccion="registro"><em class="icon ni ni-search"></em></button>                                
					                            </div>
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
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="pais_r">Pais</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="pais_r" name="pais_r">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_peru">
				                        <div class="form-group">
				                            <label class="form-label" for="departamento_r">Departamento</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="departamento_r" name="departamento_r">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_peru">
				                        <div class="form-group">
				                            <label class="form-label" for="provincia_r">Provincia</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="provincia_r" name="provincia_r">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_peru">
				                        <div class="form-group">
				                            <label class="form-label" for="distrito_r">Distrito</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="distrito_r" name="distrito_r">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_extranjero">
				                        <div class="form-group">
				                            <label class="form-label" for="ciudad">Ciudad</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="ciudad" name="ciudad" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="referido_r">Referido</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="referido_r" name="referido_r">
										        	<option value="0">--</option>
										        	<?php foreach($referidos as $referido):?>
										            <option value="<?php echo $referido->id; ?>"><?php echo $referido->nombre; ?></option>
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
										<input type="hidden" id="estado_r" name="estado_r" value="1">

			                            <button type="button" class="btn btn-lg btn-primary registrar_cliente">Registrar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="modal fade" tabindex="-1" id="cliente-edicion">
		        <div class="modal-dialog modal-lg" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Edición de Clientes</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
		                    	<div class="row gy-4">
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="tipo_documento">Tipo de Documento</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="tipo_documento" name="tipo_documento">
										        	<option value="0">--</option>
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
				                            <div class="row">
					                            <div class="form-control-wrap col-9">
					                                <input type="text" class="form-control input-number" id="numero_documento" name="numero_documento" required value="">
					                            </div>
					                            <div class="form-control-wrap col-3">
					                            	<button type="button" class="btn btn-info buscar_cliente" data-seccion="modificacion"><em class="icon ni ni-search"></em></button>                                
					                            </div>
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
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="pais">Pais</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="pais" name="pais">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_peru">
				                        <div class="form-group">
				                            <label class="form-label" for="departamento">Departamento</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="departamento" name="departamento">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_peru">
				                        <div class="form-group">
				                            <label class="form-label" for="provincia">Provincia</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="provincia" name="provincia">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_peru">
				                        <div class="form-group">
				                            <label class="form-label" for="distrito">Distrito</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="distrito" name="distrito">
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6 ubigeo_extranjero">
				                        <div class="form-group">
				                            <label class="form-label" for="ciudad">Ciudad</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="ciudad" name="ciudad" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="referido">Referido</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="referido" name="referido">
										        	<option value="0">--</option>
										        	<?php foreach($referidos as $referido):?>
										            <option value="<?php echo $referido->id; ?>"><?php echo $referido->nombre; ?></option>
										            <?php endforeach; ?>
										        </select>
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
			                            <button type="button" class="btn btn-lg btn-danger eliminar_cliente">Eliminar</button>
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary actualizar_cliente">Actualizar</button>
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