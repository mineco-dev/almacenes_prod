<?php
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	// session_unregister("egreso");
	// //session_register("ingreso");
	$_SESSION["ingreso"]=true;
	?>
	<head>
		
		<style type="text/css">
		body{
			background-color:#CCCCCC !important;
		}
		.bs-example{
			margin: 20px;
		}

		#content{
			position: absolute;
			min-height: 50%;
			width: 80%;
			top: 20%;
			left: 5%;
		}

		.selected{
			cursor: pointer;
		}

		.seleccionada{

		}

		.glyphicon {
			position: absolute;
			padding: 10px;
			pointer-events: none;
			font-size: 20px;
			text-align: center;
		}
		


		</style>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	</head>

	<body>
<div class=" table-responsive">
			<table width = "100%" class="table table-striped" id="tabla4" >
				<thead>
					<tr>
						<th width="11" >#</th>
						<th width="20px" >Codigo</th>
						<th width="187" >Categoria</th>
						<th width="152" >Sub-Categoria</th>
						<th width="130">Renglon</th>
						<th width="301">Producto</th>
						<th width="86">Cantidad Ingresada</th>
						<th width="78" >Costo Unitario</th>
						<th width="82" >PrecioTotal</th>
						<th width="82" >Eliminar</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>	
		</div> 

		<!-- <table width="99%" border=1 cellspacing="0" id="tabla" class="Estilo2">
			<tr>
				<th width="11" rowspan="2" scope="col">#</th>


				<th width="115" rowspan="2" scope="col">Codigo</th>
				<th width="141" rowspan="2" scope="col">Categoria</th>
				<th width="143" rowspan="2" scope="col">Sub-Categoria</th>
				<th width="144" rowspan="2" scope="col">Renglon</th>
				<th width="381" rowspan="2" scope="col">Producto</th>
				<th width="86" rowspan="2" scope="col">Cantidad Ingresada</th>
				<th width="78" rowspan="2" scope="col">Costo unitario</th>
				<th width="82" rowspan="2" scope="col">Precio Total</th>
			</tr>
			<tr>
			</tr>
		</table> -->

		<br>

		<input name="Bot&oacute;n" class="btn boton grey" type="button" onClick="addRow()" value="Agregar l&iacute;nea">
		<input  id="bt_del" class="btn boton grey" type="button" value="Eliminar">
		


	</body>
	<script type="text/javascript">

	$(document).ready(function(){

		$('#bt_del').click(function(){
			eliminar(id_fila_selected);
		});		
	});

	var cont=0;
	var id_fila_selected=[];

	var contLin4 = 1;

		function addRow(){
			cont++;
			
			var fila = "<tr class=\"selected\" id=\"fila"+cont+"\" >";
			fila += "<td id=\"cantidad\">"+cont+"</td>"
			fila += "<td ><a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'productoIngreso.php?tipo=bien&posi="+cont+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+cont+"][1]\" type=\"text\" value=\"\" id=\"bien["+cont+"][1]\"  alt=\"Doble clic para consultar el catalogo\" size=\"5%\" class=\"form-control\"></a></td>"
			fila += "<td><input name=\"bien["+cont+"][2]\"type=\"text\" id=\"bien["+cont+"][2]\" size=\"10%\" class=\"form-control\"  ></td>"
			fila += "<td><input name=\"bien["+cont+"][3]\" type=\"text\" id=\"bien["+cont+"][3]\" size=\"20\" class=\"form-control\" ></td>"
			fila += "<td><a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'renglon.php?tipo=bien&posi="+cont+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+cont+"][5]\" type=\"text\" value=\"\" id=\"bien["+cont+"][5]\"  alt=\"Doble clic para consultar el catalogo\" size=\"15\" class=\"form-control\" ></a></td>"
			fila += "<td><input name=\"bien["+cont+"][7]\" type=\"text\" id=\"bien["+cont+"][7]\" size=\"45\" class=\"form-control\" > </td>"
			fila += "<td><input name=\"ingresado["+cont+"]\" type=\"text\" id=\"ingresado["+cont+"]\" onblur=\"suma("+cont+");\" size=\"7\" class=\"monto form-control\" ></td>"
			fila += "<td><input class=\"monto form-control\"  name=\"costo_unitario["+cont+"]\" type=\"text\" id=\"costo_unitario["+cont+"]\"  onblur=\"suma("+cont+");\" size=\"7\"></td>"
			fila += "<td><input name=\"precio_total["+cont+"]\" type=\"text\" id=\"precio_total["+cont+"]\"  size=\"7\"  class=\"form-control\" ></td>"
			fila += "<td id=\"fila"+cont+"\" onclick=\"seleccionarFila(id, 'check"+cont+"');\" ><input id=\"check"+cont+"\" type=\"checkbox\" name=\"transporte\" >Eliminar</td>"
			fila += "<td><input name=\"precio_total1["+cont+"]\" type=\"text\" id=\"precio_total1["+cont+"]\" size=\"7\" style=\"display:none\" ></td>"
			fila += "<td><input name=\"bien["+cont+"][4]\" type=\"text\" id=\"bien["+cont+"][4]\"  size=\"7\" style=\"display:none\"></td>"
			fila += "</tr>";
			$('#tabla4').append(fila);
			reordenar();
		};

		function seleccionarFila(fila, chk) {

			if (document.getElementById(fila).className == "seleccionada"){
				document.getElementById(fila).className = "original";
				document.getElementById(chk).checked = false;
				removeItemFromArr(id_fila_selected,fila);
				
			}  else {
				document.getElementById(fila).className = "seleccionada";
				document.getElementById(chk).checked = true;
				id_fila_selected.push(fila);
				

			}
		};

		function suma(fila)
		{      

			var num1 = String(document.getElementById(['ingresado['+fila+']']).value);
			var num2 = String(document.getElementById(['costo_unitario['+fila+']']).value);
			document.getElementById(['precio_total['+fila+']']).value = num1 * num2;
			document.getElementById(['precio_total1['+fila+']']).value = num1 * num2;
		}


		function seleccionar(id_fila){

			if($('#'+id_fila).hasClass('seleccionada')){
				$('#'+id_fila).removeClass('seleccionada');
			}
			else{
				$('#'+id_fila).addClass('seleccionada');
			}
		//2702id_fila_selected=id_fila;
		id_fila_selected.push(id_fila);
		};

	function eliminar(id_fila){
		// $('#fila'+id_fila).remove();
		for(var i=0; i<=id_fila.length; i++){
			$('#'+id_fila[i]).remove();
			
		}
		reordenar();
		id_fila_selected=[];
	};

	function reordenar(){	
		var num=1;
		$('#tabla4 tbody tr').each(function(){
			
			$(this).find('td').eq(1).find('input').attr("id","bien["+num+"][1]");//codigo
			$(this).find('td').eq(1).find('a').attr("onDblClick","buscar=window.open('productoIngreso.php?tipo=bien&posi="+num+"','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;");
			$(this).find('td').eq(1).find('input').attr("name","bien["+num+"][1]");//categoria

			$(this).find('td').eq(2).find('input').attr("id","bien["+num+"][2]");//categoria
			$(this).find('td').eq(2).find('input').attr("name","bien["+num+"][2]");//categoria

			$(this).find('td').eq(3).find('input').attr("id","bien["+num+"][3]");//subcategoria
			$(this).find('td').eq(3).find('input').attr("name","bien["+num+"][3]");//subcategoria

			$(this).find('td').eq(4).find('input').attr("id","bien["+num+"][5]");//renglon
			$(this).find('td').eq(4).find('input').attr("name","bien["+num+"][5]");//renglon
			$(this).find('td').eq(4).find('a').attr("onDblClick","buscar=window.open('renglon.php?tipo=bien&posi="+num+"','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;");
			

			$(this).find('td').eq(5).find('input').attr("id","bien["+num+"][7]");//producto
			$(this).find('td').eq(5).find('input').attr("name","bien["+num+"][7]");//producto

			$(this).find('td').eq(11).find('input').attr("id","bien["+num+"][4]");//
			$(this).find('td').eq(11).find('input').attr("name","bien["+num+"][4]");


			$(this).find('td').eq(6).find('input').attr("id","ingresado["+num+"]");
			$(this).find('td').eq(6).find('input').attr("name","ingresado["+num+"]");
			$(this).find('td').eq(6).find('input').attr("onblur","suma("+num+");");


			$(this).find('td').eq(7).find('input').attr("id","costo_unitario["+num+"]");
			$(this).find('td').eq(7).find('input').attr("name","costo_unitario["+num+"]");
			$(this).find('td').eq(7).find('input').attr("onblur","suma("+num+");");


			$(this).find('td').eq(8).find('input').attr("id","precio_total["+num+"]");
			$(this).find('td').eq(8).find('input').attr("name","precio_total["+num+"]");


			$(this).find('td').eq(9).attr("onclick","seleccionarFila(id, 'check"+num+"');");
			$(this).find('td').eq(9).attr("id","fila"+num+"");
			$(this).find('td').eq(9).find('input').attr("id","check"+num+"");


			$(this).find('td').eq(10).find('input').attr("id","precio_total1["+num+"]");
			$(this).find('td').eq(10).find('input').attr("name","precio_total1["+num+"]");

			
			$(this).attr("id","fila"+num+"");
			$(this).find('td').eq(0).text(num);
			num++;
		});
};






	</script>
	</html>