<?php
	//require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
conectardb($almacen);
$empresa = ($_POST['cbo_tipo_empresa']);




// session_unregister("egreso");
// //session_register("ingreso");
$_SESSION["ingreso"]=true;
?>

<?php
//require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;

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
	<!--
	.Estilo2 {font-size: x-small}
	-->
	</style>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci" />

	<!-- <link rel="stylesheet" href="../almacenes_prod/bootstrap/css/bootstrap.css">
    <script src="../almacenes_prod/bootstrap/js/bootstrap.js"></script>-->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> 

	<!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>


	



</head>
<body>
<!-- 
name=\"hiddenField\"
name=\"hiddenField["+contLin4+"]\" -->
<div class="container table-responsive">
	<table width = "100%" class="table table-striped" id="tabla4" >
		<thead>
			<tr>
				<th width="1%" >#</th>
				<th width="10%" >Codigo</th>
				<th width="440px" >Articulo</th>
				<th width="12%" >Categoria</th>
				<th width="12%">SubCategoria</th>
				<th width="10%" style="display:none;">Cantidad Stock</th>
				<th width="10%" >Cantidad Solicitada</th>
				<th width="50px">Eliminar</th>
				<th width="1px" ></th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>	
</div> 

<br>
<input name="bt_add"  class="boton grey" type="button"  onclick="addRow()" value="Agregar l&iacute;nea">
<input  id="bt_del" class="boton grey" type="button" value="Eliminar">



</body>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#bt_del').click(function(){
		console.log(id_fila_selected);
		eliminar(id_fila_selected);
	});	
		
});

var cont=0;
var total = 0;
var valor = 0;
var id_fila_selected=[];


	//var contLin4 = 1;

	function SumaTotal(){
		$('#tabla4 tbody tr').find('td:eq(8)').each(function(){
			valor = $(this).html();
			total += parseInt(valor)
		});
		alert(total);
	};

	function addRow(){
		cont++;
		
		
		var fila = "<tr class=\"selected\" id=\"fila"+cont+"\" >";
		fila += "<td id=\"cantidad\">"+cont+"</td>"
		fila += "<td ><a href=\"javascript:void(0)\" onClick=\"buscar=window.open(\'producto.php?tipo=bien&posi="+cont+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input  id=\"bien["+cont+"][1]\" type=\"text\" value=\"\"  alt=\"Doble clic para consultar el catalogo\" style=\"width:100%\" class=\"form-control\"></a></td>"
		fila += "<td><input style=\"border:none;background:#fff\" id=\"bien["+cont+"][7]\" type=\"text\" size=\"70%\"  disabled></td>"
		fila += "<td><input  id=\"bien["+cont+"][5]\" type=\"text\"  style=\"width:100%;border:none;background:#fff\" disabled></td>"
		fila += "<td><input id=\"bien["+cont+"][6]\" type=\"text\"  style=\"width:100%;border:none;background:#fff\" disabled></td>"
		fila += "<td style= 'display:none'><input id=\"bien["+cont+"][8]\" type=\"text\"   name=\"cantidad_stock["+cont+"]\" style=\"display:none;width:100%;border:none;background:#fff\" disabled></td>"
		fila += "<td><input   id=\"cantidad_solicitada["+cont+"]\" type=\"text\" name=\"cantidad_solicitada["+cont+"]\" size=\"12\" style=\"width:100%\" class=\"form-control\" required></td>"
		fila += "<td id=\"fila"+cont+"\"  ><input id=\"check"+cont+"\" type=\"checkbox\" name=\"transporte\" >Eliminar</td>"
		fila += "<td><input id=\"bien["+cont+"][4]\" type=\"hidden\" name=\"bien["+cont+"][4]\"  style=\"display:none;\"  size=\"0\"/></td>"
		fila += "</tr>";
		$('#tabla4').append(fila);
		reordenar();
	};

		function removeItemFromArr(arr,item){
			var i = arr.indexOf(item);
			if (i != -1) {
				arr.splice(i,1)
			}
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
			console.log (id_fila_selected);
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
			$(this).find('td').eq(2).find('input').attr("id","bien["+num+"][7]");//Articulo
			$(this).find('td').eq(3).find('input').attr("id","bien["+num+"][5]");//categoria
			$(this).find('td').eq(4).find('input').attr("id","bien["+num+"][6]");//subcategoria
			$(this).find('td').eq(5).find('input').attr("id","bien["+num+"][8]");//stock 
			//$(this).find('td').eq(5).find('input').attr("id","cantidad_sto["+num+"]");
			$(this).find('td').eq(6).find('input').attr("name","cantidad_solicitada["+num+"]");//cantidad solicitada
			$(this).find('td').eq(1).find('a').attr("onClick","buscar=window.open('producto.php?tipo=bien&posi="+num+"','Buscar4','width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;");
			//$(this).find('td').eq(1).setAttribute("onclick","https://www.google.com");
			$(this).find('td').eq(7).attr("id","fila"+num+"");
			$(this).find('td').eq(7).attr("onclick","seleccionarFila(id, 'check"+num+"');");
			$(this).find('td').eq(7).find('input').attr("id","check"+num+"");
			$(this).find('td').eq(8).find('input').attr("id","bien["+num+"][4]");
			$(this).find('td').eq(8).find('input').attr("name","bien["+num+"][4]");

			$(this).attr("id","fila"+num+"");
			$(this).find('td').eq(0).text(num);
			num++;
		}); 		 
};
</script>
</html>