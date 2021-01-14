<?php
$estado_pagos = EstadoPagoData::obtenerEstadoPagos();

$total_estado_pagos=count($estado_pagos);

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
                        <h3 class="nk-block-title page-title">Listado de Estado de Pagos</h3>
                        <div class="nk-block-des text-soft">
                            <p>Tiene un total de <?php echo $total_estado_pagos; ?> Tipo Moneda.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($total_estado_pagos>0) {
            ?>
            <div class="nk-block">
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist is-compact text-center">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col">N°</div>
                                    <div class="nk-tb-col"><span class="sub-text">Descripcion</span></div>
                                    <div class="nk-tb-col"><span class="sub-text">Estado</span></div>
                                    <div class="nk-tb-col"></div>
                                </div>
                                <?php foreach($estado_pagos as $estado_pago):?>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <?php echo $estado_pago->id; ?>
                                    </div>
                                    <div class="nk-tb-col">
                                        <?php echo $estado_pago->descripcion; ?>
                                    </div>
                                    <div class="nk-tb-col">
                                        <?php if ($estado_pago->estado == 1) { ?>
                                        <span class="tb-status text-success">Activo</span>
                                        <?php } else { ?>
                                        <span class="tb-status text-danger">Inactivo</span>
                                        <?php } ?>
                                    </div>
                                    <div class="nk-tb-col nk-tb-col-check">
                                        <button type="button" class="btn btn-warning edicion_estado_pago"
                                            data-relacionado="<?php echo $estado_pago->id; ?>"><em
                                                class="icon ni ni-edit-alt-fill"></em></button>                                                
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

            <div class="modal fade" tabindex="-2" id="estado-pago-edicion">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edición de Estado de Pago</h5>
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
                                                <input type="text" class="form-control" id="nombre" name="nombre" required value="" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="color">Color</label>
                                            <div class="form-control-wrap">
                                                <input type="color" class="form-control" id="color" name="color" required value="" maxlength="7">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row gy-gs">
                                    <div class="col-6 text-right ml-auto">                                       
                                        <button type="button"
                                            class="btn btn-lg btn-primary actualizar_estado_pago">Actualizar</button>
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