<?php
$usuario_actual = UsuariosData::obtenerUsuarioPerfil($_SESSION["user_id"]);

$documentos_activos = DocumentosData::obtenerDocumentosActivos(); 
/*
$url_modulo = "?" . $_SERVER['QUERY_STRING'];
$modulo = ModulosData::obtenerIdModulo($url_modulo);
$id_modulo = $modulo->id;
*/
?>
<form action="" id="hoteles" method="post" name="hoteles">
    <input type="hidden" id="proceso" name="proceso" value="">
    <input type="hidden" id="codigo_relacionado" name="codigo_relacionado" value="<?php echo $_SESSION["user_id"]; ?>">
    <input type="hidden" id="modulos_activos" name="modulos_activos" value="">
    <!-- <input type="hidden" id="id_modulo" name="id_modulo" value="<?php echo $id_modulo; ?>"> -->

    <div class="card card-bordered">
        <div class="card-aside-wrap">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Informacion Personal</h4>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li><a href="#" class="btn btn-primary edicion_usuario" data-relacionado="<?php echo $_SESSION["user_id"]; ?>"><em class="icon ni ni-edit"></em><span>Actualizar</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="nk-data data-list">
                        <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Nombre Completo</span>
                                <span class="data-value"><?php echo $usuario_actual->nombre; ?> <?php echo $usuario_actual->apellido_paterno; ?> <?php echo $usuario_actual->apellido_materno; ?></span>
                            </div>
                        </div>
                        <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Tipo de Documento</span>
                                <span class="data-value text-soft"><?php echo $usuario_actual->nombre_documento; ?></span>
                            </div>
                        </div>
                        <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Numero de Documento</span>
                                <span class="data-value"><?php echo $usuario_actual->numero_documento; ?></span>
                            </div>
                        </div>
                        <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Email</span>
                                <span class="data-value"><?php echo $usuario_actual->correo_usuario; ?></span>
                            </div>
                        </div>
                        <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Usuario</span>
                                <span class="data-value"><?php echo $usuario_actual->usuario; ?></span>
                            </div>
                        </div>
                        <div class="data-item">
                            <div class="data-col">
                                <span class="data-label">Rol</span>
                                <span class="data-value"><?php echo $usuario_actual->nombre_rol; ?></span>
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
                                    </div>
                                    <div class="form-group row gy-gs">
                                        <div class="col-6 text-left">
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

            </div>
        </div>
    </div>
</form>