<?php
    $promociones=PromocionesData::obtenerPromocionesUsuarioFinal();
?>
<div class="card container-fluid">
    <div class="card-body">
        <div class="nk-block-head-content pb-3">
            <h3 class="nk-block-title page-title">Promociones del mes</h3>
        </div>
        <div class="row">
            <?php foreach($promociones as $promocion):?>
            <div class="col-lg-5 mx-auto mt-3">
                <div class="card text-white bg-secondary">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $promocion->descripcion; ?></h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Categoria <?php echo $promocion->nombre_categoria; ?></h5>
                        <p class="card-text">
                            Requiere <?php echo $promocion->dias_minimo; ?> dias minimo. </br>
                            Costo <?php echo $promocion->simbolo; ?> <?php echo $promocion->costo; ?>
                        </p>
                        
                        <div id="carouselExFade<?php echo $promocion->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php 
                                    $id_categoria=$promocion->id_categoria;
                                    $habitaciones=HabitacionesData::obtenerHabitacionesCategoria($id_categoria);
                                    $i = 0;
                                    foreach($habitaciones as $habitacion):
                                ?>
                                <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                                    <img src="files_habitaciones/<?php echo $habitacion->url_imagen; ?>"
                                        class="d-block w-100 h-350" alt="carousel">
                                </div>
                                <?php  $i++; endforeach; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExFade<?php echo $promocion->id; ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExFade<?php echo $promocion->id; ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>                        
                    </div>
                    <div class="card-footer border-top text-white text-right">Finaliza
                        <?php echo date_format(date_create($promocion->fecha_vencimiento),'d-m-Y'); ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>