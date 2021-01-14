<?php
$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;

$reservas = ReservasData::obtenerReservasDashboard('Todas');
$reservas_pagadas = ReservasData::obtenerReservasDashboard('Pagadas');
$reservas_pendientes = ReservasData::obtenerReservasDashboard('Pendientes');

$notificaciones = NotificacionesData::obtenerNotificaciones($_SESSION["user_id"]);

$total_dia_caja=CajasData::totalCajaDia();

?>
<div class="">
    <div class="">
        <div class="row g-gs">
            <div class="col-lg-6">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Mi Caja</h6>
                                <p>Cierre del dia.</p>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left"
                                    title="Venta del dia en cierre de caja"></em>
                            </div>
                        </div>
                        <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                            <div class="nk-sale-data-group flex-md-nowrap g-4">
                                <?php
                                    if($total_dia_caja>0){
                                ?>
                                <div class="nk-sale-data">
                                    <span class="amount">S/ <?php foreach($total_dia_caja as $caja)
                                        {                                            
                                            echo number_format($caja->Total,2,'.',' ');
                                        }; ?>
                                    <span class="change up text-success"><em
                                                class="icon ni ni-arrow-long-up"></em></span></span>
                                    <span class="sub-title">Total del dia en cierre.</span>
                                </div>
                                <?php
                                    }else{
                                ?>
                                <div class="nk-sale-data">
                                    <span class="amount">S/ <?php foreach($total_dia_caja as $caja)
                                        {                                            
                                            echo number_format($caja->Total,2,'.',' ');
                                        }; ?><span class="change down text-danger"><em
                                                class="icon ni ni-arrow-long-down"></em></span></span>
                                    <span class="sub-title">Total del dia en cierre.</span>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-0">
                            <div class="card-title">
                                <h6 class="subtitle">Total Withdraw</h6>
                            </div>
                            <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left"
                                    title="Total Withdraw"></em>
                            </div>
                        </div>
                        <div class="card-amount">
                            <span class="amount"> 49,595.34 <span class="currency currency-usd">USD</span>
                            </span>
                            <span class="change down text-danger"><em
                                    class="icon ni ni-arrow-long-down"></em>1.93%</span>
                        </div>
                        <div class="invest-data">
                            <div class="invest-data-amount g-2">
                                <div class="invest-data-history">
                                    <div class="title">This Month</div>
                                    <div class="amount">2,940.59 <span class="currency currency-usd">USD</span></div>
                                </div>
                                <div class="invest-data-history">
                                    <div class="title">This Week</div>
                                    <div class="amount">1,259.28 <span class="currency currency-usd">USD</span></div>
                                </div>
                            </div>
                            <div class="invest-data-ck">
                                <canvas class="iv-data-chart" id="totalWithdraw"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-8">
                <div class="card card-bordered card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title"><span class="mr-2">Reservas</span></h6>
                            </div>
                            <div class="card-tools">
                                <ul class="card-tools-nav estados_reservas">
                                    <li data-filtro="pagadas"><a href="#"><span>Pagadas</span></a></li>
                                    <li data-filtro="pendientes"><a href="#"><span>Pendientes de Pago</span></a></li>
                                    <li data-filtro="todas" class="active"><a href="#"><span>Todas</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="reservas" class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>No.</span></div>
                                <div class="nk-tb-col tb-col-sm"><span>Cliente</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Habitacion</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Fecha de Ingreso</span></div>
                                <div class="nk-tb-col"><span>Importe</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-inline">Estado</span></div>
                                <div class="nk-tb-col"><span>&nbsp;</span></div>
                            </div>
                            <?php foreach($reservas as $reserva):?>
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#">#<?php echo $reserva->id_reserva; ?></a></span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">
                                        <div class="user-avatar user-avatar-sm bg-purple">
                                            <span><?php echo $reserva->iniciales_cliente; ?></span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead"><?php echo $reserva->nombre_cliente; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub"><?php echo $reserva->nombre_habitacion; ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub"><?php echo $reserva->fecha_ingreso; ?></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="badge badge-dot badge-dot-xs badge-success" style="color: <?php echo $reserva->color_pago; ?>;"><?php echo $reserva->estado_pago; ?></span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-action">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                            data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li><a href="#">View</a></li>
                                                <li><a href="#">Invoice</a></li>
                                                <li><a href="#">Print</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="reservas_pagadas" class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>No.</span></div>
                                <div class="nk-tb-col tb-col-sm"><span>Cliente</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Habitacion</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Fecha de Ingreso</span></div>
                                <div class="nk-tb-col"><span>Importe</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-inline">Estado</span></div>
                                <div class="nk-tb-col"><span>&nbsp;</span></div>
                            </div>
                            <?php foreach($reservas_pagadas as $reserva):?>
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#">#<?php echo $reserva->id_reserva; ?></a></span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">
                                        <div class="user-avatar user-avatar-sm bg-purple">
                                            <span><?php echo $reserva->iniciales_cliente; ?></span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead"><?php echo $reserva->nombre_cliente; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub"><?php echo $reserva->nombre_habitacion; ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub"><?php echo $reserva->fecha_ingreso; ?></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="badge badge-dot badge-dot-xs badge-success" style="color: <?php echo $reserva->color_pago; ?>;"><?php echo $reserva->estado_pago; ?></span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-action">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                            data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li><a href="#">View</a></li>
                                                <li><a href="#">Invoice</a></li>
                                                <li><a href="#">Print</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>                    

                    <div id="reservas_pendientes" class="card-inner p-0 border-top">
                        <div class="nk-tb-list nk-tb-orders">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col"><span>No.</span></div>
                                <div class="nk-tb-col tb-col-sm"><span>Cliente</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Habitacion</span></div>
                                <div class="nk-tb-col tb-col-md"><span>Fecha de Ingreso</span></div>
                                <div class="nk-tb-col"><span>Importe</span></div>
                                <div class="nk-tb-col"><span class="d-none d-sm-inline">Estado</span></div>
                                <div class="nk-tb-col"><span>&nbsp;</span></div>
                            </div>
                            <?php foreach($reservas_pendientes as $reserva):?>
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <span class="tb-lead"><a href="#">#<?php echo $reserva->id_reserva; ?></a></span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">
                                        <div class="user-avatar user-avatar-sm bg-purple">
                                            <span><?php echo $reserva->iniciales_cliente; ?></span>
                                        </div>
                                        <div class="user-name">
                                            <span class="tb-lead"><?php echo $reserva->nombre_cliente; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub"><?php echo $reserva->nombre_habitacion; ?></span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub"><?php echo $reserva->fecha_ingreso; ?></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="badge badge-dot badge-dot-xs badge-success" style="color: <?php echo $reserva->color_pago; ?>;"><?php echo $reserva->estado_pago; ?></span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-action">
                                    <div class="dropdown">
                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                            data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                            <ul class="link-list-plain">
                                                <li><a href="#">View</a></li>
                                                <li><a href="#">Invoice</a></li>
                                                <li><a href="#">Print</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-bordered card-full">
                    <div class="card-inner border-bottom">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Notificaciones</h6>
                            </div>
                        </div>
                    </div>
                    <ul class="nk-activity">
                        <?php
                        $n = 0;
                        foreach($notificaciones as $notificacion) {
                            $n++;

                            if ($n <= 10) {
                                $notificacion_resumen = $notificacion->resumen;
                                $notificacion_fecha = $notificacion->fecha;
                        ?>
                        <li class="nk-activity-item">
                            <div class="nk-notification-icon">
                                <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                            </div>
                            <div class="nk-activity-data">
                                <div class="label"><?php echo $notificacion_resumen; ?></div>
                                <span class="time"><?php echo $notificacion_fecha; ?></span>
                            </div>
                        </li>
                        <?php
                            }
                        }
                        ?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>