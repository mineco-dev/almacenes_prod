<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$dia_numero= date("d");
$dia_letras = date('D');


//dd($almacen);

conectardb($almacen);											
$qry_tipo_empresa="SELECT * FROM dbo.fecha";										
$res_qry_tipo_empresa=$query($qry_tipo_empresa);	



while($row_tipo_empresa=$fetch_array($res_qry_tipo_empresa))
{
	$contador = $row_tipo_empresa["id_fecha"];
					// $valida =$row_tipo_empresa["dia"];
	$valida =13;

}

$free_result($res_qry_tipo_empresa);	







if($dia_numero >= 1  && $dia_letras != "Sun" && $dia_letras != "Sat")
{

	$contador= $contador +1;
	
	if($contador <= 13)

	{


		if( $dia_numero != $valida)
		{
			
			// conectardb($almacen);
			 $qry_actualiza="update fecha set id_fecha ='$contador', dia= $dia_numero where id_fecha >= 0 ";
			
			$result = $query($qry_actualiza);

			
		}
desconectardb($almacen);
		?>


		<!DOCTYPE html>
		<html>
		<head>

			<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
			<script language="javascript" src="calendar/calendar.js"></script>

			<script type="text/javascript">
			var peticion = false;
			var  testPasado = false;
			try {
				peticion = new XMLHttpRequest();
			} catch (trymicrosoft) {
				try {
					peticion = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (othermicrosoft) {
					try {
						peticion = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (failed) {
						peticion = false;
					} 
				}
			}

			if (!peticion)
				alert("ERROR AL INICIALIZAR!");

			function cargarCombo (url, comboAnterior, element_id) {
		    //Obtenemos el contenido del div
		    //donde se cargaran los resultados
		    var element =  document.getElementById(element_id);
		    //Obtenemos el valor seleccionado del combo anterior
		    var valordepende = document.getElementById(comboAnterior)
		    var x = valordepende.value
		    //construimos la url definitiva
		    //pasando como parametro el valor seleccionado
		    var fragment_url = url+'?Id='+x;
		    element.innerHTML = '<img src="../images/loading.gif" />';
		    //abrimos la url
		    peticion.open("GET", fragment_url);
		    peticion.onreadystatechange = function() {
		    	if (peticion.readyState == 4) {
		//escribimos la respuesta
		element.innerHTML = peticion.responseText;
		}
		}
		peticion.send(null);
		}

</script>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="../almacenes_prod/bootstrap/css/bootstrap.css">
<script src="../almacenes_prod/bootstrap/js/bootstrap.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</head>
<body oncontextmenu="return false">
	<form name="frm_select_persona" id="frm_select_persona" action="requisicion.php" method="post">
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<div id="TabbedPanels1" class="TabbedPanels container">
						<ul class="TabbedPanelsTabGroup">
							<li class="TabbedPanelsTab" tabindex="0"><strong>Solicitante</strong></li>

						</ul>
						<div class="TabbedPanelsContentGroup panel-group">
							<div class="TabbedPanelsContent">
								<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">

									<tr>
										<td colspan="4">&nbsp;</td>
									</tr>

									<tr>
										<td valign="top"><div align="center"></div></td>
										<td style="text-align: center;" class="empresa">Empresa</td>
										<td colspan="2" >
											<?php
											conectardb($almacen);											
											$qry_tipo_empresa="SELECT * FROM cat_empresa WHERE activo=1";										
											$res_qry_tipo_empresa=$query($qry_tipo_empresa);
											
											echo('<select name="cbo_tipo_empresa" style="width:300px;">');
											$nombre=":: Seleccione ::";
											//echo'<option value="0">'.$nombre.'</option>';
											while($row_tipo_empresa=$fetch_array($res_qry_tipo_empresa))
											{
												print($row_tipo_empresa);	
												echo'<option value="'.$row_tipo_empresa["codigo_empresa"].'">'.$row_tipo_empresa["empresa"].'</option>';

											}
											echo('</select>');				
											$free_result($res_qry_tipo_empresa);									 
											?>
										</td>
									</tr>  
									<tr>
										<td valign="top">&nbsp;</td>
										<td>&nbsp;</td>

										<td colspan="2">&nbsp;</td>
									</tr>  
									<tr>
										<td colspan="4"><div align="center">
											<input name="btn1" type="button" class="boton grey" onClick="validar(this.form)" value="Aceptar">
											
										</div>		</td>
									</tr>     

								</table>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<p>&nbsp;</p>

		</form>
	</body>
	<script type="text/javascript">

// swal({
//   title: 'Are you sure?',
//   text: "You won't be able to revert this!",
//   type: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes, delete it!'
// }).then((result) => {
//   if (result.value) {
//     swal(
//       'Deleted!',
//       'Your file has been deleted.',
//       'success'
//     )
//   }
// })

	function valor(objeto)
	{
		try {
			if ((objeto.value+0) == 0)
				return false;
			else
				return true;
		} catch(e) 
		{
			return false;
		}
	}

	function validar(form)
	{
//////////////////////// Encabezado ///////////////////////////////////////////////////
if ((form['cbo_tipo_empresa'].value) == "0"){alert('Seleccione el tipo de documento que respalda el ingreso'); form['cbo_tipo_docto'].focus();  return};	



	//if ((form['nombre[0][1]'].value+0) == 0){alert('Debe seleccionar un solicitante'); return};
	//if (form['actuacion'].selectedIndex == 0){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Detalle //////////////////////////////////////////////////////////	
	//	ban = 0; for (i=1;i<100;i++) { if (validarEntero(form['ingresado['+i+']']!="")) ban = 1; } if (ban == 0) {alert('No se acepta el ingreso de letras y comas en Cantidad recibida'); return};	

/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	

if (confirm('�Asegurese de seleccionar correctamente su empresa de lo contrario podrian alterar algun dato de otra dependencia?')) form.submit();

}
</script>
</html>

<?php
}

else

{

echo '
<html>
<head>

 <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
 

 <meta http-equiv="Content-Type" content="text/html" charset="utf-8_spanish_ci" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

 <link rel=\'stylesheet prefetch\' href=\'https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900\'>
 <link rel="stylesheet" href="stylecambiopwd/css/style.css">
</head>

<body>

  <div class="pen-title">
    <h1>De acuerdo al Manual de procedimiento ME-G-IGE-AD-ALM-01 OPERACION DE ALMACÉN</h1>
    <h5>Únicamente los primeros ocho días hábiles del mes se podrán realizar requisiciones en el sistema de almacén</h5>
  </div>

  <div class ="container img-responsive">
	
  </div>
 
  <script src=\'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js\'></script>
  <script >
(function() {
  var button, buttonStyles, materialIcons;

  materialIcons = \'<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">\';

  buttonStyles = \' <link rel="stylesheet" href="stylecambiopwd/css/style.css">\';

 

  document.body.innerHTML += materialIcons + buttonStyles + button;

}).call(this);
  </script>

  <script src="stylecambiopwd/js/index.js"></script>

</body>
</html>
';



	//echo "<br><br> <br><br><br><br><br><br><br><br><br><br><br>";
	//echo "<div align='center'> De acuerdo al Manual de procedimineto ME-G-IGE-AD-ALM-01 OPERACION DE ALMACEN, unicamente los primeros ocho dias habiles del mes se podran realizar requisiciones en el sistema de almacen,</div>";
	//echo "favor de comunicarse con la Direccion Administrativa para mas informacion.";


	if($dia_numero >=1 && $dia_numero <=13  && $dia_letras != "Sun" && $dia_letras != "Sat")
	{
		echo("asdf");
		$qry_actualiza="update dbo.fecha set id_fecha =0, dia=0 where id_fecha >=0";
		$query($qry_actualiza);	

		// $qry_actualiza="update dbo.tb_requisicion_enc set codigo_estatus =9 where codigo_estatus =3";
		// $query($qry_actualiza);	
		
		
		// $qry_actualiza="update dbo.tb_inventario set cantidad_comprometida=0 where codigo_bodega=8";
		// $query($qry_actualiza);	


	}

}




}

else

{


	echo "El sistema se encuentra fuera de servicio, por encontrarse en fin de semana";
	

}



?>