var datos = $("#hoteles");

$(document).ready(function() {
    $(".input-number").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $(".input-double").keypress(function (e) {
        if(e.which == 46){
            if($(this).val().indexOf('.') != -1) {
                return false;
            }
        }

        if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
}); 

function EsEmail(email) {
    if (email.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1) {
        return true;
    } else {
        return false;
    }
}

$(".date-picker").datepicker({
    format: 'dd/mm/yyyy'
});