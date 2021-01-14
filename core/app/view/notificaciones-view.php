<?php
$modulos = ModulosData::obtenerModuloPadre();
$habilitados = UsuariosModulosData::obtenerUsuariosModulos($_SESSION["user_id"]);
$notificaciones_habilitados = UsuariosNotificacionesData::obtenerUsuariosNotificaciones($_SESSION["user_id"]);
?>
<form action="" id="hoteles" method="post" name="hoteles">
	<input type="hidden" id="proceso" name="proceso" value="">
	<input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="<?php echo $_SESSION["user_id"]; ?>">
	<input type="hidden" id="modulos_activos" name="modulos_activos" value="">

	<div class="card container-fluid">
	  <div class="card-body">

			<div class="nk-block-head nk-block-head-sm">
			    <div class="nk-block-between">
			        <div class="nk-block-head-content">
			            <h3 class="nk-block-title page-title">Listado de Modulos</h3>
			        </div>
			    </div>
			</div>

            <form action="#" class="form-validate is-alter">
	            <div id="usuario-notificaciones" class="row gy-4">
		        	<?php
		        	$estilo_notificacion = "";
		        	$estilo_notificacion_h = "";

		        	foreach($modulos as $item) {
                        $activo = 0;
                        $codigo_modulo = $item->id;
                        $nombre_modulo = $item->nombre_modulo;

                        if (count($habilitados)>0) {
                            foreach($habilitados as $element) {
                                $codigo_habilitado = $element->id_modulo_usuario;

                                if ($codigo_modulo == $codigo_habilitado) {
                                    $activo = 1;
                                }
                            }           
                        }

                        $hijos = ModulosData::obtenerModuloHijo($codigo_modulo);

                        $tiene_hijos = count($hijos);

                        if ($activo == 1) {
	                        if (count($notificaciones_habilitados)>0) {
	                        	$estilo_notificacion = "";
	                            foreach($notificaciones_habilitados as $notificacion) {
	                                $codigo_notificacion = $notificacion->id_modulo_usuario;

	                                if ($codigo_modulo == $codigo_notificacion) {
	                                    $estilo_notificacion = "checked";	                                	
	                                }
	                            }           
	                        }

                        	if ($tiene_hijos == 0) {
		        	?>
	                <div class="col-3">
	                	<div class="custom-control custom-checkbox">
	                		<input type="checkbox" class="custom-control-input" id="modulo<?php echo $codigo_modulo; ?>" value="<?php echo $codigo_modulo; ?>" <?php echo $estilo_notificacion; ?>>
	                		<label class="custom-control-label" for="modulo<?php echo $codigo_modulo; ?>"><?php echo $nombre_modulo; ?></label>
	                	</div>
	                </div>
		            <?php
		            		} else {
	                            foreach($hijos as $item_h) {
	                                $activo_h = 0;
	                                $codigo_modulo_h = $item_h->id;
	                                $nombre_modulo_h = $item_h->nombre_modulo;

	                                if (count($habilitados)>0) {
	                                    foreach($habilitados as $element) {
	                                        $codigo_habilitado = $element->id_modulo_usuario;

	                                        if ($codigo_modulo_h == $codigo_habilitado) {
	                                            $activo_h = 1;
	                                        }
	                                    }           
	                                }

	                                if ($activo_h == 1) {
				                        if (count($notificaciones_habilitados)>0) {	
				                        	$estilo_notificacion_h = "";			                        	
				                            foreach($notificaciones_habilitados as $notificacion) {
				                                $codigo_notificacion_h = $notificacion->id_modulo_usuario;

				                                if ($codigo_modulo_h == $codigo_notificacion_h) {
				                                    $estilo_notificacion_h = "checked";			                                	
				                                }
				                            }           
				                        }
	                ?>
	                <div class="col-3">
	                	<div class="custom-control custom-checkbox">
	                		<input type="checkbox" class="custom-control-input" id="modulo<?php echo $codigo_modulo_h; ?>" value="<?php echo $codigo_modulo_h; ?>" <?php echo $estilo_notificacion_h; ?>>
	                		<label class="custom-control-label" for="modulo<?php echo $codigo_modulo_h; ?>"><?php echo $nombre_modulo_h; ?></label>
	                	</div>
	                </div>	                
	                <?php
	                				}
	                			}

		            		}
		        		}
		        	}
		        	?>

	                <div class="col-3">
	                	<div class="custom-control custom-checkbox">
	                		<input type="checkbox" class="custom-control-input" id="modulo0" value="0">
	                		<label class="custom-control-label" for="modulo0">Ninguno</label>
	                	</div>
	                </div>

	            </div>                  	

                <div class="form-group row gy-gs">
                	<div class="col-6 text-left">
                	</div>
                	<div class="col-6 text-right">
                        <button type="button" class="btn btn-lg btn-primary registrar_notificaciones">Registrar</button>
                	</div>
                </div>
            </form>

	  </div>
	</div>
</form>