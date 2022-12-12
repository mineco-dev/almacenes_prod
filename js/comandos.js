/*
    Comandos para validad las requisiones de los productos
*/

$(document).ready(function () { 
    jQuery('body').on('keyup', 'input.CantidadRoja', function () {
        $(this).addClass("cantidad")
        $(this).removeClass("CantidadRoja");
    });

    
})


function ValidarAutorizacion(formulario,url,path){
   
    let pathLocation = $(path).val();
    $(formulario).submit(function(e) {
        e.preventDefault();
        let datos = $(formulario).serialize();
        // console.log(datos);
        $.ajax(
            {
                type: "POST",
                url: url,
                data: datos,
                success: function (r) {
                    if (r == 1) {
                        swal("", "Requisición Autorizada","success");
                        window.location.href = pathLocation;
                    } else {
                        swal("", "Requisición Rechazada","warning");
                        window.location.href = pathLocation;
                    }
                }
            }) 

    })
}

function obtenerDespacho(tabla){
    $.ajax({
        url: '../ver/modelo/dataHeaderDespacho.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (respuesta) {
            var encabezado = $(tabla +" > tbody:last");
            $.each(respuesta.data, function(index, elemento)
            {
                encabezado.append(
                        '<tr ><td colspan=2 class="correlativoDespacho">Número: <span>' + elemento.NUMERO + '<span> </td></tr>'
                      + '<tr><td>Solicitante:</td><td>' + elemento.SOLICITANTE + '</td></tr>'
                      + '<tr><td>Fecha:</td><td>' + elemento.FECHA +'</td></tr>'
                    + '<tr><td>Departamento:</td><td>' + elemento.DEPARTAMENTO + '</td></tr>'
                    + '<tr><td>Observaciones:</td><td>' + elemento.OBSERVACIONES + '</td></tr>'
                    + '<tr><td>Recibe:</td><td>' + elemento.RECIBE + '</td></tr>'
                );
            });
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }

    });
}

function obtenerPersonas(div,modal){
    let variable = "modal="+modal;
    $.ajax({
        
        url: '../ver/modelo/searchPersona.php',
        type: 'POST',
        data: variable,
        success: function (respuesta) {
            let Personas = $(div);
            Personas.html(respuesta);
        },
        error: function () {
            console.log("No se ha podido obtener la información");
        }

    });
}

function CierraPopup(modal) {
    console.log(modal);
    $(modal).modal('hide'); //ocultamos el modal
    $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
    $('.modal-backdrop').remove(); //eliminamos el backdrop del modal
}