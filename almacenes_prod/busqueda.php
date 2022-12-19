<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
header("Content-Type: text/html; charset=iso-8859-1"); 


if (isset($_REQUEST["tipo"]))
{
	//session_register("tipo");
	$_SESSION["tipo"]=$_REQUEST["tipo"];
	//session_register("posi");
	$_SESSION["posi"]=$_REQUEST["posi"];
	$tipo=$_REQUEST["tipo"];
	$posi=$_REQUEST["posi"];
}
else
{
	$tipo=$_SESSION["tipo"];
	$posi=$_SESSION["posi"];
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	 <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


<style>
        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
          padding-top: 50px;
          padding-bottom: 20px;
          overflow-y: scroll;
        }
        ul.dropdown-menu li {
            margin-left: 20px;
        }
        .vuetable th.sortable:hover {
            color: #2185d0;
            cursor: pointer;
        }
        .vuetable-actions {
            width: 11%;
            padding: 12px 0px;
            text-align: center;
        }
        .vuetable-actions > button {
          padding: 3px 6px;
          margin-right: 4px;
        }
        .vuetable-pagination {
            margin: 0;
        }
        .vuetable-pagination .btn {
            margin: 2px;
        }
        .vuetable-pagination-info {
            float: left;
            margin-top: auto;
            margin-bottom: auto;
        }
        ul.pagination {
          margin: 0px;
        }
        .vuetable-pagination-component {
          float: right;
        }
        .vuetable-pagination-component li a {
            cursor: pointer;
        }
        [v-cloak] {
            display: none;
        }
        .highlight {
            background-color: yellow;
        }
        .vuetable-detail-row {
            height: 200px;
        }
        .detail-row {
            margin-left: 40px;
        }
        .expand-transition {
            transition: all .5s ease;
        }
        .expand-enter, .expand-leave {
            height: 0;
            opacity: 0;
        }

        /* Loading Animation: */
        .vuetable-wrapper {
            opacity: 1;
            position: relative;
            filter: alpha(opacity=100); /* IE8 and earlier */
        }
        .vuetable-wrapper.loading {
          opacity:0.4;
           transition: opacity .3s ease-in-out;
           -moz-transition: opacity .3s ease-in-out;
           -webkit-transition: opacity .3s ease-in-out;
        }
        .vuetable-wrapper.loading:after {
          position: absolute;
          content: '';
          top: 40%;
          left: 50%;
          margin: -30px 0 0 -30px;
          border-radius: 100%;
          -webkit-animation-fill-mode: both;
                  animation-fill-mode: both;
          border: 4px solid #000;
          height: 60px;
          width: 60px;
          background: transparent !important;
          display: inline-block;
          -webkit-animation: pulse 1s 0s ease-in-out infinite;
                  animation: pulse 1s 0s ease-in-out infinite;
        }
        @keyframes pulse {
          0% {
            -webkit-transform: scale(0.6);
                    transform: scale(0.6); }
          50% {
            -webkit-transform: scale(1);
                    transform: scale(1);
                 border-width: 12px; }
          100% {
            -webkit-transform: scale(0.6);
                    transform: scale(0.6); }
        }
       </style>

<script LANGUAGE="JavaScript">
function Validar(form)
{
	if (form.txt_buscar.value == "")
	{ 
		alert("Escriba el nombre o apellido del empleado para realizar la búsqueda"); 
		form.txt_buscar.focus(); 
		return;
	}  
	form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
</script>




<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

</head>

<body>
	
    



		<form name="form1" method="post" action="">
			<div  class="container">
			        <h2 class="sub-header">B&uacute;squeda de Productos</h2>
			        <hr>
			        <div class="row">
			            <div class="col-md-8 form-inline">
			                <div class="form-inline form-group">
			                    
			                  	<strong>
			                  		      [<a href="busqueda.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="busqueda.php?in=B">B</a>] [<a href="busqueda.php?in=C">C</a>] [<a href="busqueda.php?in=D">D</a>] [<a href="busqueda.php?in=E">E</a>] [<a href="busqueda.php?in=F">F</a>] [<a href="busqueda.php?in=G">G</a>] [<a href="busqueda.php?in=H">H</a>] [<a href="busqueda.php?in=I">I</a>] [<a href="busqueda.php?in=J">J</a>] [<a href="busqueda.php?in=K">K</a>] [<a href="busqueda.php?in=L">L</a>] [<a href="busqueda.php?in=M">M</a>] [<a href="busqueda.php?in=N">N</a>] [<a href="busqueda.php?in=O">O</a>] [<a href="busqueda.php?in=P">P</a>] [<a href="busqueda.php?in=Q">Q</a>] [<a href="busqueda.php?in=R">R</a>] [<a href="busqueda.php?in=S">S</a>] [<a href="busqueda.php?in=T">T</a>] [<a href="busqueda.php?in=U">U</a>] [<a href="busqueda.php?in=V">V</a>] [<a href="busqueda.php?in=W">W</a>] [<a href="busqueda.php?in=X">X</a>] [<a href="busqueda.php?in=Y">Y</a>] [<a href="busqueda.php?in=Z">Z</a>] <a href="busqueda.php?in=all">[TODO]</a><BR></strong>
											<label>Buscar:</label>
											<input class ="form-control" style="width:25%;" name="txt_buscar" type="text" id="txt_buscar2" size="30">
											<input  class="btn btn-primary"name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
											
			                </div>
			            </div>
			        </div>

			<hr>


				<table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th style="width:10%;">Ver Kardex</th>
								<th style="width:15%;">Codigo Producto</th>
								<th>Descripcion</th>
							</tr>
						</thead>
						<tbody>

				<?PHP
					if ($_REQUEST["txt_buscar"]!="")
					{
						$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
						$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
						p.codigo_subcategoria, p.codigo_categoria, 
						p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
						FROM            cat_medida 
						INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
						INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
						AND p.codigo_producto = tb_inventario.codigo_producto
						WHERE  (p.producto like '%$busqueda%' or p.uso like '%$busqueda%')";

					}
					else	
						if (isset($_REQUEST["in"]))	
						{
							$inicial=$_REQUEST["in"];
							echo "Listado de categoria inicia con $inicial";
							if ($inicial!="all")
								$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
								p.codigo_subcategoria, p.codigo_categoria, 
								p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
								FROM            cat_medida 
								INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
								INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
								AND p.codigo_producto = tb_inventario.codigo_producto
								WHERE (p.producto like '$inicial%')";

							else
								$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
								p.codigo_subcategoria, p.codigo_categoria, 
								p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
								FROM            cat_medida 
								INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
								INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
								AND p.codigo_producto = tb_inventario.codigo_producto
								
								order by p.producto";

						}
						else
						{
							$consulta = "SELECT  p.rowid ,(p.producto +' - '+ p.marca +' EN '+ cat_medida.unidad_medida) as producto,
								p.codigo_subcategoria, p.codigo_categoria, 
								p.activo, p.codigo_producto, p.uso, tb_inventario.existencia
								FROM            cat_medida 
								INNER JOIN cat_producto p  ON cat_medida.codigo_medida = p.codigo_medida 
								INNER JOIN tb_inventario ON p.codigo_categoria = tb_inventario.codigo_categoria AND p.codigo_subcategoria = tb_inventario.codigo_subcategoria 
								AND p.codigo_producto = tb_inventario.codigo_producto
								";

						}
						conectardb($almacen);
						$result=$query($consulta);
						$i = 0;				
						while($row=$fetch_array($result))
						{
							$completo=$row["codigo_producto"];
						

							echo '<tr >';
							//echo "<td class='boton'><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar esta categoria\"></a></center></td>";					
							echo '<td >	<a href="Busqueda/search.php?categoria='.$row["codigo_categoria"].'&subcategoria='.$row["codigo_subcategoria"].'&producto='.$row["codigo_producto"].'" class="btn btn-primary btn-xl">
          									<span class=\glyphicon glyphicon-share\"></span> Kardex
        								</a>
        						  </td>';
							echo '<td>'.$row["codigo_categoria"] .'  '. $row["codigo_subcategoria"] .'  '.$row["codigo_producto"].'</td>
								  <td>'.$row["producto"].'</td><td style="display:none;">'.$row["codigo_categoria"].'</td>
								  <td>'.$row["codigo_categoria"].'</td>
								  <td>'.$row["codigo_subcategoria"].'</td>
								  <td>'.$row["codigo_producto"].'</td>
								  <td style="display:none;" >'.$row["rowid"].'</td></tr>';	

					// echo '<tr class='.$clase.'>';
					// echo "<td><a href=\"javascript:void(0)\" onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][1]').value = '$completo'; 
					// window.opener.document.getElementById('$tipo"."[".$posi."][4]').value = '".$row["rowid"]."';
			  //    	window.opener.document.getElementById('$tipo"."[".$posi."][7]').value = '".$row["producto"]."';
					// window.opener.document.getElementById('$tipo"."[".$posi."][2]').value = '".$row["codigo_categoria"]."';
					// window.opener.document.getElementById('$tipo"."[".$posi."][3]').value = '".$row["codigo_subcategoria"]."';
					// window.opener.document.getElementById('$tipo"."[".$posi."][5]').value = '".$row["codigo_categoria"]."';
					// window.close();
					// window.opener.focus(); 
					// return false;\"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar esta categoria\"></a></center></td>";					
					// echo '<td>'.$row["codigo_producto"].'</td><td>'.$row["producto"].'</td></tr>';										
							$i++;
						}				
						$free_result($result);				
						?>
						</tbody>
					</table>
				</form>
				<p>&nbsp;</p>
			</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.2/vue-resource.min.js"></script>

			<script type="text/javascript">


			

			function valor_celda(celda){

				alert(celda.innerHTML);
				window.opener.document.getElementById("nombre[0][1]").value = celda.innerHTML ;
				window.close();
				window.opener.focus();
			}

			window.onload = function(){

				$(".boton").click(function(){



					var valores= new Array();



            // Obtenemos todos los valores contenidos en los <td> de la fila

            // seleccionada

            $(this).parents("tr").find("td").each(function(){

                //valores+=$(this).html()+"\n";
                
                valores.push($(this).html())
               

            });

            var posi = '<?php echo $posi; ?>';
            var tipo = '<?php echo $tipo; ?>'

 alert(valores[4]);
 alert(valores[5]);
 alert(valores[6]);

        });



// var tags_td = new Array();
// var tags_td=document.getElementsByTagName('td');
// for (i=0; i<tags_td.length; i++) {
//             if (tags_td[i].addEventListener) {   // IE9 y el resto
//                 tags_td[i].addEventListener ("click", function () {valor_celda(this)}, false);
//             } 
//             else {
//                 if (tags_td[i].attachEvent) {    // IE9 -
// //                    tags_td[i].attachEvent ('onclick',  function () {valor_celda(this)}, false);
//    tags_td[i].setAttribute('onclick', 'valor_celda(this)');                 

//                 }
//             }
// }
};


</script>
</body>

</html>