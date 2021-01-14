<?php
 $tarifas=TarifasData::obtenerTarifasActivas();
?>
<div class="card container-fluid">
    <div class="card-body">
        <h3 class="nk-block-title page-title">Listado de Tarifas</h3>

        <div class="nk-block-head-content mt-4 container-fluid">
            <table id="tbTarifas" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="30">#</th>
                        <th>Nombre</th>
                        <th>Tipo Moneda</th>
                        <th>Prec. Minimo</th>
                        <th>Prec. Base</th>
                        <th>Categoria</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tarifas as $tarifa):?>    
                        <tr class="nk-tb-item">
                            <td><?php echo $tarifa->id; ?></td>
                            <td><?php echo $tarifa->nombre_tarifa; ?></td>
                            <td><?php echo $tarifa->simbolo; ?></td>
                            <td><?php echo $tarifa->precio_minimo; ?></td>
                            <td><?php echo $tarifa->precio_base; ?></td>
                            <td><?php echo $tarifa->nombre_categoria; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>