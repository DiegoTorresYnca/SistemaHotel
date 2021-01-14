<?php
    $habitaciones=HabitacionesData::obtenerHabitacionesActivos();
?>

<div class="card container-fluid">
    <div class="card-body">
        <h3 class="nk-block-title page-title">Listado de Habitaciones</h3>

        <div class="nk-block-head-content mt-4 container-fluid">
            <div class="row gy-4">
                <?php foreach($habitaciones as $habitacion):?>  
                    <div class="col-lg-4">
                        <div class="card <?php if($habitacion->estado_reserva==0) echo "bg-primary"; else echo "bg-danger";?>">
                            <div class="card-body">
                                <h4 class="text-white text-center"><?php echo $habitacion->nombre_habitacion; ?></h4>
                                <div class="row">
                                    <div class="col-5">
                                        <img src="assets/images/door.png" alt="" class="container-fluid">
                                    </div>
                                    <div class="col-7 text-white">
                                        <ul>
                                            <li><?php echo $habitacion->detalles; ?></li>                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>