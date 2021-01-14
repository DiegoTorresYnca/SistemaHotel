<?php
$usuarios = UsuariosData::obtenerUsuarios(); 

$total_usuarios = count($usuarios);

$documentos = DocumentosData::obtenerDocumentos(); 
$roles = RolesData::obtenerRoles(); 

$documentos_activos = DocumentosData::obtenerDocumentosActivos(); 
$roles_activos = RolesData::obtenerRolesActivos(); 

$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;
?>
<form action="" id="hoteles" method="post" name="hoteles">
	<input type="hidden" id="proceso" name="proceso" value="">
	<input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="">
	<input type="hidden" id="modulos_activos" name="modulos_activos" value="">
	<input type="hidden" id="id_modulo" name="id_modulo" value="<?php echo $id_modulo; ?>">

	<div class="card container-fluid">
	  <div class="card-body">
			<div class="nk-block-head nk-block-head-sm">
			    <div class="nk-block-between">
			        <div class="nk-block-head-content">
			            <h3 class="nk-block-title page-title">Listado de Usuarios</h3>
			            <div class="nk-block-des text-soft">
			                <p>Tiene un total de <?php echo $total_usuarios; ?> usuarios.</p>
			            </div>
			        </div>
			        <div class="nk-block-head-content">
			            <div class="toggle-wrap nk-block-tools-toggle">
			                <div class="toggle-expand-content" data-content="pageMenu">
			                    <ul class="nk-block-tools g-3">
			                        <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#usuario-agregar"><em class="icon ni ni-plus"></em><span>Agregar</span></a></li>
			                    </ul>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>

			<?php if ($total_usuarios == 0) { ?>
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
			                        <div class="nk-tb-col"><span class="sub-text">Rol</span></div>
			                        <div class="nk-tb-col"><span class="sub-text">Estado</span></div>
			                        <div class="nk-tb-col"></div>
			                    </div>
			                    <?php foreach($usuarios as $usuario):?>
			                    <div class="nk-tb-item">
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<?php echo $usuario->id; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <?php echo $usuario->nombre; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $usuario->apellido_paterno; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $usuario->apellido_materno; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                            <span><?php echo $usuario->correo_usuario; ?></span>
			                        </div>
			                        <div class="nk-tb-col">
			                           	<?php foreach($roles as $rol):?>
			                           		<?php if ($usuario->id_rol == $rol->id) { ?>
			                           			<?php echo $rol->nombre_rol; ?>
			                           		<?php } ?>	
			                           	<?php endforeach; ?>
			                        </div>
			                        <div class="nk-tb-col">
			                        	<?php if ($usuario->estado_usuario == 1) { ?>
			                            <span class="tb-status text-success">Activo</span>
			                        	<?php } else { ?>
			                            <span class="tb-status text-danger">Inactivo</span>
			                        	<?php } ?>
			                        </div>
			                        <div class="nk-tb-col nk-tb-col-check">
			                        	<button type="button" class="btn btn-warning edicion_usuario" data-relacionado="<?php echo $usuario->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>
			                        </div>
			                    </div>
			                    <?php endforeach; ?>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php } ?>

			<div class="modal fade" tabindex="-2" id="usuario-agregar">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Registro de Usuarios</h5>
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
				                            <label class="form-label" for="correo">Correo Electrónico</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="correo" name="correo" required value="">
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
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="eliminar_r">Eliminar</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="eliminar_r" name="eliminar_r">
										            <option value="1">Si</option>
										            <option value="0">No</option>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="usuario_nombre">Usuario</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="password">Password</label>
				                            <div class="form-control-wrap">
				                                <input type="password" class="form-control" id="password" name="password" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="rol_r">Rol</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="rol_r" name="rol_r">
										        	<?php foreach($roles_activos as $rol):?>
										            <option value="<?php echo $rol->id; ?>"><?php echo $rol->nombre_rol; ?></option>
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
			                            <button type="button" class="btn btn-lg btn-primary registrar_usuario">Registrar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

			<div class="modal fade" tabindex="-1" id="usuario-edicion">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Edición de Usuarios</h5>
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
				                            <label class="form-label" for="correo">Correo Electrónico</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="correo" name="correo" required value="">
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
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="eliminar">Eliminar</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="eliminar" name="eliminar">
										            <option value="1">Si</option>
										            <option value="0">No</option>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="usuario_nombre">Usuario</label>
				                            <div class="form-control-wrap">
				                                <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="password">Password</label>
				                            <div class="form-control-wrap">
				                                <input type="password" class="form-control" id="password" name="password" required value="">
				                            </div>
				                        </div>
		                    		</div>
		                    		<div class="col-6">
				                        <div class="form-group">
				                            <label class="form-label" for="rol">Rol</label>
				                            <div class="form-control-wrap">
										        <select class="form-select" id="rol" name="rol">
										        	<option value="0">--</option>
										        	<?php foreach($roles_activos as $rol):?>
										            <option value="<?php echo $rol->id; ?>"><?php echo $rol->nombre_rol; ?></option>
										            <?php endforeach; ?>
										        </select>
				                            </div>
				                        </div>
		                    		</div>
		                    	</div>
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
			                            <button type="button" class="btn btn-lg btn-danger eliminar_usuario">Eliminar</button>
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary actualizar_usuario">Actualizar</button>
		                        	</div>
		                        </div>
		                    </form>
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="modal fade" tabindex="-1" id="usuario-permisos">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h5 class="modal-title">Permisos de Usuarios</h5>
		                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
		                        <em class="icon ni ni-cross"></em>
		                    </a>
		                </div>
		                <div class="modal-body">
		                    <form action="#" class="form-validate is-alter">
			                    <div id="modulos" class="row gy-4">
			                    </div>                  	
		                        <div class="form-group row gy-gs">
		                        	<div class="col-6 text-left">
		                        	</div>
		                        	<div class="col-6 text-right">
			                            <button type="button" class="btn btn-lg btn-primary registrar_permisos">Registrar</button>
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