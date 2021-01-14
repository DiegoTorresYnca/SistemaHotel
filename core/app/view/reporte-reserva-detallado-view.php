<?php
$estado_pagos = EstadoPagoData::obtenerEstadoPagoActivos(); 
$usuarios = UsuariosData::obtenerUsuariosActivos(); 
$categorias = CategoriasData::obtenerCategoriasActivos(); 
$habitaciones = HabitacionesData::obtenerHabitacionesActivos(); 
?>
<form action="" id="hoteles" method="post" name="hoteles">
    <input type="hidden" id="proceso" name="proceso" value="">
    <input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="">

    <div class="card container-fluid">
        <div class="card-body">
            <div class="nk-block-head-content pb-4">
                <h3 class="nk-block-title page-title">Reporte detallado</h3>
            </div>
            <div class="row gy-4" id="content">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="fecha_ingreso">Fecha Inicio</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control date-picker" id="fecha_ingreso" name="fecha_ingreso" required value="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="fecha_salida">Fecha Final</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control date-picker" id="fecha_salida" name="fecha_salida" required value="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="estado_pago">Estado de Pago</label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="estado_pago" name="estado_pago">
                                <option value="0">Seleccione</option>
                                <?php foreach($estado_pagos as $estado_pago):?>
                                <option value="<?php echo $estado_pago->id; ?>"><?php echo $estado_pago->descripcion; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="usuario">Usuario</label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="usuario" name="usuario">
                                <option value="0">Seleccione</option>
                                <?php foreach($usuarios as $usuario):?>
                                <option value="<?php echo $usuario->id; ?>"><?php echo $usuario->nombre; ?> <?php echo $usuario->apellido_paterno; ?> <?php echo $usuario->apellido_materno; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="categoria">Tipo de Categoria</label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="categoria" name="categoria">
                                <option value="0">Seleccione</option>
                                <?php foreach($categorias as $categoria):?>
                                <option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-label" for="habitacion">Habitacion</label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="habitacion" name="habitacion">
                                <option value="0">Seleccione</option>
                                <?php foreach($habitaciones as $habitacion):?>
                                <option value="<?php echo $habitacion->id; ?>"><?php echo $habitacion->nombre_habitacion; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <div class="mt-4">
                            <button class="btn btn-primary" id="btnFiltra">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="nk-block-head-content mt-4">
                <table id="tbReporte" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="30">#</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Referido</th>
                            <th>Usuario</th>
                            <th>Ingreso</th>
                            <th>Salida</th>
                            <th>Habitacion</th>
                            <th>Estado Pago</th>
                            <th>Monto</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="modal fade" tabindex="-2" id="reserva-ver">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Informacion de Reserva</h5>
                      <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                      </a>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" id="habitacion" name="habitacion">
                      <input type="hidden" id="tipo_categoria" name="tipo_categoria">
                      <div class="row gy-4">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Cliente</label>
                            <div class="form-control-wrap cliente"></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Referido</label>
                            <div class="form-control-wrap referido"></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Habitacion</label>
                            <div class="form-control-wrap habitacion"></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Check In</label>
                            <div class="form-control-wrap check_in"></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Hora</label>
                            <div class="form-control-wrap hora_entrada"></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Check Out</label>
                            <div class="form-control-wrap check_out"></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-label">Hora</label>
                            <div class="form-control-wrap hora_salida"></div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label class="form-label">Observación</label>
                            <div class="form-control-wrap observacion"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" id="cliente-ver">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Informacion de Cliente</h5>
                      <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                      </a>
                    </div>
                    <div class="modal-body">
                      <form action="#" class="form-validate is-alter">
                        <div class="row gy-4">
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Tipo de Documento</label>
                              <div class="form-control-wrap tipo_documento"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Numero de Documento</label>
                              <div class="form-control-wrap numero_documento"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Nombre</label>
                              <div class="form-control-wrap nombre"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Apellido Paterno</label>
                              <div class="form-control-wrap apellido_paterno"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Apellido Materno</label>
                              <div class="form-control-wrap apellido_materno"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Celular</label>
                                <div class="form-control-wrap celular"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Correo Electrónico</label>
                              <div class="form-control-wrap correo"></div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label class="form-label">Referido</label>
                              <div class="form-control-wrap referido"></div>
                            </div>
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