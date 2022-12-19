$(document).ready(function() {
    let mostrar = this.getElementById('varia').value;
   console.log(mostrar);
    let table = $("#tPersona").DataTable({
      bDeferRender: true,
      searching: true,
      bLengthChange: false,
      sPaginationType: "full_numbers",

      ajax: {
        url: "modelo/dataPersona.php",
        type: "POST"
      },
      columns: [
        { data: "CONTROL" },
        { data: "EMPLEADO" }
      ],
      columnDefs:[
        { "width": "10%",  "targets": 0, "className": "boton" },
        { "width": "100%", "targets": 1}
      ],
      fnRowCallback: function(
        nRow,
        aData,
        iDisplayIndex,
        iDisplayIndexFull
      ) {
        
        $("td:eq(0)", nRow).click(function(){
            alert($("td:eq(1)", nRow).html());
            CierraPopup(mostrar);
        })

        // if (parseInt(aData["EXISTENCIA"]) >= parseInt(aData["SOLICITADO"])) {
        //   $("td:eq(7)", nRow).addClass("circleGreen");
        // }else{
        //   $("td:eq(7)", nRow).addClass("circleRed");
        //   $("td:eq(4)", nRow).find('input').addClass("CantidadRoja")
        //   $("td:eq(4)", nRow)
        //     .find("input")
        //     .removeAttr("Readonly");
        //   $("td:eq(4)", nRow).find("input").attr("value",0);
        // }
        return nRow;
      },
      oLanguage: {
        sProcessing: "Procesando...",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo:
          "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Filtrar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Por favor espere - cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior"
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente"
        }
      }
    });

});
