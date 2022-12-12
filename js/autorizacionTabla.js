$(document).ready(function() {
    let variable = $("#nRequi").val(); 
    $("#DataReport").DataTable({
      bDeferRender: true,
      searching: true,
      bLengthChange: false,
      sPaginationType: "full_numbers",

      ajax: {
        url: "modelo/tablaAutoriza.php",
        type: "POST",
        data: { valor: variable }
      },
      columns: [
        { data: "CODIGO" },
        { data: "PRODUCTO" },
        { data: "unidad_medida" },
        { data: "CODIGOPRODUCTO" },
        { data: "SOLICITADO" },
        { data: "INPUT" },
        { data: "COMPROMETIDO" },
        { data: "EXISTENCIA" }
        // { data: "CAMPO" }
      ],
      columnDefs:[
        { "width": "2%",  "targets": 0,  "className": "dt-body-center"},
        { "width": "65%", "targets": 1},
        { "width": "15%", "targets": 2,  "className": "dt-body-center"},
        { "width": "25%",  "targets": 3,  "className": "dt-body-center"},
        { "width": "2%",  "targets": 4,  "className": "dt-body-center"},
        { "width": "2%",  "targets": 5,  "className": "dt-body-center"},
        { "width": "2%",  "targets": 6,  "className": "dt-body-center"},
        { "width": "2%",  "targets": 7,  "className": "dt-body-center"}
      ],
      // fnRowCallback: function(
      //   nRow,
      //   aData,
      //   iDisplayIndex,
      //   iDisplayIndexFull
      // ) {
        

      //   if (parseInt(aData["EXISTENCIA"]) >= parseInt(aData["SOLICITADO"])) {
      //     $("td:eq(7)", nRow).addClass("circleGreen");
      //   }else{
      //     $("td:eq(7)", nRow).addClass("circleRed");
      //     $("td:eq(4)", nRow).find('input').addClass("CantidadRoja")
      //     $("td:eq(4)", nRow)
      //       .find("input")
      //       .removeAttr("Readonly");
      //     $("td:eq(4)", nRow).find("input").attr("value",0);
      //   }
      //   return nRow;
      // },
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
