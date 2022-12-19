<?php 
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");

//$categoria = 121;
$categoria = $_GET['categoria'];
//$subcategoria = $_GET['subcategoria'];
//$producto = $_GET['producto'];

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
 	<link href="../css/helpdesk.css" rel="stylesheet" type="text/css">
	<link href="../css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
	<link rel="stylesheet" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script
			  src="js/jquery-3.3.1.js"
			  ></script>
	<script
		src="js/jquery.dataTables.min.js">
	</script>
 	<style type="text/css">

    .tres a 
    {
            text-shadow: 0px 1px rgba(0, 0, 0, 0.2);
            text-align:center;
            text-decoration: none;
            font-family: 'Helvetica Neue', Helvetica, sans-serif;
            display:inline-block;
            color: #FFF;
            background: #7F8C8D;
            padding: 6px 30px;
            white-space: nowrap;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin: 10px 5px;
            -webkit-transition: all 0.2s ease-in-out;
            -ms-transition: all 0.2s ease-in-out;
            -moz-transition: all 0.2s ease-in-out;
            -o-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
    }
	.grey a{
    		background: #0090FF;
  			border: 1px solid #2980B9;
	}

	.grey a:hover
	{
  			background: #39a0e5;
	}

    </style>
 </head>
 <body>

<form id="generar">
    <div class="container">
        <section class="content-header">
            <h1>
                Tarjeta de Kardex por Categoria
                <small></small>
            </h1>

        </section>
        <section class="content">
        
            <!-- Your Page Content Here -->
        
            <div class='row'>
                <div class='col-md-6 col-xs-8 col-sm-8'>
                    <div>
                        <div class='box box-primary'>
                            <div class='box-body'>
                                <div class='form-group'>
                                    <label for="vehiculo">Seleccione Informe:</label>
                                    <select class="form-control" id="informe" name="informe" required>

                                    </select>
                                </div>
                            </div>
                            <div class='box-footer'>
                                    <p><input type="submit" value="Buscar" id='btn-listo'  class='btn btn-primary pull-right'></p>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div>
       
        <div class='  col-md-12 col-xs-12 col-sm-12' >
            <div >
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <table id="catalogoreportes" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" class="codigo">Fecha</th>
                                    <th width="10%" class="Fecha">Codigo</th>
                                    <th width="35%" class="Estatus">Descripcion del Producto</th>
                                    <th width="6%" class="Oficina">Entrada</th>
                                    <th width="6%" class="Estatus">Salida</th>
                                    <th width="6%" class="Oficina">Saldo</th>    
                                </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
        </section>
        <!-- /.content -->
    </div>
</form>

  

<script>
$(document).ready(function () {
	 llenarCombos("php/CatalogoCategoria.php","#informe")
})


	$("#btn-listo").click(function(){
         MostrarDatos("#generar","php/RCategoria.php");

         
 	});


 	function MostrarDatos(formulario,url){
		$(formulario).submit(function (e) {
			e.preventDefault();
			//var datos = $(formulario).serialize();
			var datos = $('select[name=informe]').val();
			console.log(datos);

		$('#catalogoreportes').DataTable({
		"destroy": true,
        "bDeferRender": true,
        "searching": true,
        "bLengthChange": true,
        "sPaginationType": "full_numbers",


        "ajax": {
            "url": "php/RCategoria.php",
            "type": "POST",
            "data": {datos}

        },
        "columns": [

            { "data": "Fecha" },
            { "data": "Codigo" },
            { "data": "Descripcion" },
            { "data": "CantidadIngresada" },
            { "data": "CantidadDespachada" },
            { "data": "Existencias" }
            
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (aData["Estado"] == "Entregado") {
                $("td:eq(2)", nRow).addClass("Entregado");
            }
            return nRow;
        },
        "oLanguage": {
            "sProcessing": "Procesando...",
            "sLengthMenu": 'Mostrar <select>' +
                '<option value="5">5</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">All</option>' +
                '</select> registros',
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Filtrar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Por favor espere - cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

		})
 	}


function llenarCombos(url,lugar) {
	$.ajax({
		url: url,
		type: 'post',
		success: function (r) {
			$(lugar).empty();
			r = JSON.parse(r);
			sedeItem = crearElemento('option', '__', '__', 'Seleccione...', '__', '__');
			sedeItem.setAttribute('value', '');
			$(lugar).append(sedeItem);
			for (i = 0; i < r.length; i++) {
				option = crearElemento('option', '__', '__',r[i][0] + '-' + r[i][1], '__', r[i][0]);
				$(lugar).append(option);
			}
		}
	});
}

function crearElemento(elemento, identificador, clase, texto, ruta, valor) {
	item = document.createElement(elemento);
	if (identificador !== '__') { item.id = identificador; }
	if (clase !== '__') { item.className = clase; }
	if (texto !== '__') { item.innerText = texto; }
	if (ruta !== '__') { item.dataset.cargarVista = ruta; }
	if (valor !== '__') { item.value = valor; }
	return item;
}


</script>
 </body>
 </html>