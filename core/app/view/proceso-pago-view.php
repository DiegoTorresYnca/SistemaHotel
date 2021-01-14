<?php
$agregados = AgregadosData::obtenerAgregados(); 
$reservas = ReporteReservaData::obtenerReservasPendientePago();

$estados_pagos=EstadoPagoData::obtenerPagosCombo();
?>
<div class="card container-fluid">
    <div class="card-body">
        <h3 class="nk-block-title page-title mb-3">Proceso de Pago</h3>
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">Usuario</label>
                    <div class="form-control-wrap">
                        <select name="" id="" class="form-select">
                            <?php foreach($reservas as $reserva):?>
                            <option value="<?php echo $reserva->id_reserva; ?>"><?php echo $reserva->nombre_habitacion; ?>
                                <?php echo $reserva->cliente; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-1">
                    <button class="btn btn-primary mt-4">Buscar</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label" for="agregado">Agregados</label>
                    <div class="form-control-wrap">
                        <select class="form-select" id="agregado" name="agregado" multiple="true">

                            <?php foreach($agregados as $agregado):?>
                            <option value="<?php echo $agregado->id; ?>"><?php echo $agregado->descripcion; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">

                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col">N°</div>
                            <div class="nk-tb-col"><span class="sub-text">Descripcion</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Tipo de Pago</span></div>
                            <div class="nk-tb-col"><span class="sub-text">Monto</span></div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">SubTotal</label>
                    <div class="form-control-wrap">
                        <input type="text" class="form-control cursor-pointer" readonly>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">Tipo Pago</label>
                    <div class="form-control-wrap">
                        <select name="" id="" class="form-select">
                            <?php foreach($estados_pagos as $estado_pago):?>
                            <option value="<?php echo $estado_pago->id; ?>"><?php echo $estado_pago->descripcion; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>            
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">Monto a cancelar</label>
                    <input type="text" class="form-control">
                </div>             
            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="">N° de Operación</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-lg-9"></div>
            <div class="col-lg-3">
                <button class="btn btn-success">Procesar Pago</button>
            </div>
            
        </div>
    </div>
</div>