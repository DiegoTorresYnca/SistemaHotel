<?php
$reservas = ReporteReservaData::obtenerReporteReservas();
$total_reservas = count($reservas);
?>
<form action="" id="hoteles" method="post" name="hoteles">
  <input type="hidden" id="proceso" name="proceso" value="">
  <input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="">
  <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION["user_id"]; ?>">

  <div class="card container-fluid">
    <div class="card-body">
      <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
          <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Listado de Reservas</h3>
            <div class="nk-block-des text-soft">
              <p>Tiene un total de <?php echo $total_reservas; ?> reservas.</p>
            </div>
          </div>        
        </div>
      </div>
      <div class="nk-block-head-content">
        <div class="nk-block-head-content mt-4">
            <table id="tbReporte" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="30">#</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Referido</th>
                        <th>Usuario</th>
                        <th>Fecha de Ingreso</th>
                        <th>Fecha de Salida</th>
                        <th>Habitacion</th>
                        <th>Estado Pago</th>
                        <th>Monto</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
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