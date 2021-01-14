$(document).ready(function() {
    $('ul.estados_reservas li').click(function(e) { 

        $('.estados_reservas li').not(this).removeClass('active').addClass('');
        $(this).addClass('active').removeClass('');

        $("#reservas").fadeOut();
        $("#reservas_pagadas").fadeOut();
        $("#reservas_pendientes").fadeOut();

        filtro = $(this).attr('data-filtro');

        if (filtro == "todas") {
            $("#reservas").fadeIn();
        }

        if (filtro == "pagadas") {
            $("#reservas_pagadas").fadeIn();
        }

        if (filtro == "pendientes") {
            $("#reservas_pendientes").fadeIn();
        }
    });    
}); 