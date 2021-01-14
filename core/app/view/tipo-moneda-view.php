<?php
$tipo_monedas = TipoMonedaData::obtenerTipoMonedas();

$total_tipos_moneda = count($tipo_monedas);

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
                        <h3 class="nk-block-title page-title">Listado de Tipo Moneda</h3>
                        <div class="nk-block-des text-soft">
                            <p>Tiene un total de <?php echo $total_tipos_moneda; ?> Tipo Moneda.</p>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li><a href="#" class="btn btn-primary" data-toggle="modal"
                                            data-target="#tipo-moneda-agregar"><em
                                                class="icon ni ni-plus"></em><span>Agregar</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($total_tipos_moneda>0) {
                ?>
            <div class="nk-block">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist is-compact text-center">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col">N°</div>
                                    <div class="nk-tb-col"><span class="sub-text">Simbolo</span></div>
                                    <div class="nk-tb-col"><span class="sub-text">Cambio</span></div>
                                    <div class="nk-tb-col"><span class="sub-text">Estado</span></div>
                                    <div class="nk-tb-col"></div>
                                    <div class="nk-tb-col"></div>
                                </div>
                                <?php foreach($tipo_monedas as $tipo_moneda):?>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <?php echo $tipo_moneda->id; ?>
                                    </div>
                                    <div class="nk-tb-col">
                                        <?php echo $tipo_moneda->simbolo; ?>
                                    </div>
                                    <div class="nk-tb-col">
                                        <?php echo $tipo_moneda->cambio; ?>
                                    </div>
                                    <div class="nk-tb-col">
                                        <?php if ($tipo_moneda->estado == 1) { ?>
                                        <span class="tb-status text-success">Activo</span>
                                        <?php } else { ?>
                                        <span class="tb-status text-danger">Inactivo</span>
                                        <?php } ?>
                                    </div>
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <button type="button" class="btn btn-warning edicion_tipo_moneda" data-relacionado="<?php echo $tipo_moneda->id; ?>"><em class="icon ni ni-edit-alt-fill"></em></button>                                                
                                    </div>
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <button type="button" class="btn btn-lg btn-danger eliminar_tipo_moneda" data-relacionado="<?php echo $tipo_moneda->id; ?>">Eliminar</button>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
        ?>

            <div class="modal fade" tabindex="-2" id="tipo-moneda-agregar">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Registro de Tipo de Moneda</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>

                        <div class="modal-body">
                            <form action="#" class="form-validate is-alter">
                                
                                <div class="row gy-4">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="simbolo">Simbolo</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="simbolo" name="simbolo"
                                                    required value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="cambio">Precio Cambio</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control input-double" id="cambio" name="cambio"
                                                    required value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row gy-gs">
                                    <div class="col-6 text-right ml-auto">
                                        <button type="button"
                                            class="btn btn-lg btn-primary registrar_tipo_moneda">Registrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-2" id="tipo-moneda-edicion">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edición de Tipo de Moneda</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>

                        <div class="modal-body">
                            <form action="#" class="form-validate is-alter">
                                
                                <div class="row gy-4">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="simbolo">Simbolo</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="simbolo" name="simbolo"
                                                    required value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="cambio">Precio Cambio</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control input-double" id="cambio" name="cambio"
                                                    required value="">
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
                                    <div class="col-6 text-right ml-auto">                                       
                                        <button type="button"
                                            class="btn btn-lg btn-primary actualizar_tipo_moneda">Actualizar</button>
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