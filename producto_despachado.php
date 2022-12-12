<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
if (isset($_REQUEST["id"]))
{	
		$rowid=$_REQUEST["id"];
		conectardb($almacen);
		//$latabla="cat_producto";
		//$campo_condicion="codigo_requisicion_enc";
		$qry_producto="select d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante, 
e.fecha_requisicion, dep.descripcion_depen, e.observaciones, e.codigo_estatus, es.estatus, d.codigo_empresa,
d.codigo_requisicion_enc, b.bodega, d.codigo_bodega, e.codigo_solicitante,
 d.cantidad_autorizada from tb_requisicion_det d
inner join tb_requisicion_enc e on
e.codigo_requisicion_enc = d.codigo_requisicion_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria 
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join tb_dependencias dep
on dep.codigo_depen = e.codigo_dependencia
inner join cat_estatus es on
e.codigo_estatus = es.codigo_estatus
where d.codigo_requisicion_enc = '$rowid'";
		//$qry_producto="select * from $latabla where $campo_condicion='$rowid'";
		$res_qry_producto=$query($qry_producto);
		while($row=$fetch_array($res_qry_producto))
		{				
			$codigo=$row["codigo_requisicion_enc"];
			$producto=$row["producto"];
			$codsolicitante=$row["codigo_solicitante"];
			$solicitante=$row["solicitante"];
			$categoria=$row["categoria"];
			$estatus=$row["codigo_estatus"];
			$observaciones=$row["observaciones"];
			$bodega=$row["bodega"];	
			$dependencia=$row["descripcion_depen"];
			$fecha=$row["fecha_requisicion"];	
			$codigo_producto=$row["codigo_producto"];		
		}
}

//session_register("hoja_despacho");
	       $_SESSION["hoja_despacho"]=$codigo;
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_solicitante.value == "")
  { 
  	alert("Debio haber ingresado un nombre"); 
	form.txt_solicitante.focus(); 
	return;
  }
 
  
  function numerico(valor)
{ 
	   campo=valor.toString();
	   var nuLongitud = campo.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(campo.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
}
    form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_producto.focus(); 
}
function validarBotonRadio() {
  var s = "no";
  with (document.form){
    for ( var i = 0; i < txt_aprobar.length; i++ ) {
      if ( txt_aprobar.checked ) {
      s= "si";
      window.alert("Ha seleccionado: \n" + txt_aprobar.value);
      break;
      }
    }
    if ( s == "no" ){
      window.alert("Debe seleccionar aprobado o rechazado" ) ;
    }
  }
}
</script>
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<LINK REL="stylesheet" TYPE="text/css" HREF="estilo.css">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>




<body>
<div align="left">
  <table width="100%"  border="0">
    <tr>
     
      <td width="93%" height="22"><div align="center"><span class="titulocategoria">Despacho de Productos</span></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><img src="../images/linea.gif" width="100%" height="6"></div></td>
    </tr>
  </table>
  <form name="form" method="post" action="">
    <table width="90%" border="0" align="center" bordercolor="#ECE9D8">
      <tr>
        <td><center>
            <table width="80%" border="0" align="center" cellspacing="5">
            
              <tr>
                <td width="26%" height="25"><span class="titulomenu">Solicitante</span></td>
                <td colspan="2"><input name="txt_solicitante" type="text" id="txt_categoria2" value="<?PHP echo $solicitante; ?>" size="53" disabled><input name="txt_solicitante" type="hidden" id="txt_categoria2" value="<?PHP echo $solicitante; ?>" size="53"><input name="txt_cod_solicitante" type="hidden" id="txt_cod_solicitante" value="<?PHP echo $codsolicitante; ?>" size="10"></td>
              </tr>
               <tr>
                <td width="26%" height="25"><span class="titulomenu">Dependencia</span></td>
                <td colspan="2"><input name="txt_dependencia" type="text" id="txt_dependencia" value="<?PHP echo $dependencia; ?>" size="53" disabled><input name="txt_dependencia" type="hidden" id="txt_dependencia" value="<?PHP echo $dependencia; ?>" size="53"></td>
              </tr>
               <tr>
                <td width="26%" height="25"><span class="titulomenu">Fecha</span></td>
                <td colspan="2"><input name="txt_fecha" type="text" id="txt_fecha" value="<?PHP echo $fecha; ?>" size="53" disabled><input name="txt_fecha" type="hidden" id="txt_fecha" value="<?PHP echo $fecha; ?>" size="53"></td>
              <tr>
                <td height="26%" height="25"><span class="titulomenu">Observaciones</span></td>
               <td colspan="2"> <textarea name="txt_observaciones" cols="70" id="txt_uso" disabled><?PHP echo $observaciones; ?></textarea>
               <textarea name="txt_observaciones" style="display:none;" cols="70" id="txt_uso"><?PHP echo $observaciones; ?></textarea></td>
             </tr>
             <tr>
             <p align="left"><a target="_blank" href="rpt_despacho.php"><img src="../images/iconos/ico_print.gif" alt="Clic para Imprimir este documento" width="30" height="30" /></a>
            
             </tr>
            
              <tr>

              
                <?PHP
     $consulta = mssql_query ($qry_producto)
         or die ("Fallo en la consulta");
   // Mostrar resultados de la consulta
      $nfilas = mssql_num_rows ($consulta);
      if ($nfilas > 0)
      {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>No.</TH>\n");
		 print ("<TH>Producto</TH>\n");
         print ("<TH>Categoria</TH>\n");
         print ("<TH>Subcategoria</TH>\n");
		
		 print ("<TH>Estado</TH>\n");
		 print ("<TH>Cantidad Despachada</TH>\n");
         print ("<TH>Bodega</TH>\n");
		 print ("</TR>\n");
           $cnt = 1;
         for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");
            print ("<TD>" . $resultado['codigo_requisicion_enc'] . "</TD>\n");
			print ("<TD>" . $resultado['producto'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_categoria'] . "</TD>\n");
            print ("<TD>" . $resultado['codigo_subcategoria'] . "</TD>\n");
			
			print ("<TD>" . $resultado['estatus'] . "</TD>\n");
			print ("<TD>" . $resultado['cantidad_autorizada'] . "</TD>\n");
            print ("<TD>" . $resultado['bodega'] . "</TD>\n");
		  $cnt++;
		 }

         print ("</TABLE>\n");
		 echo "<ul> </ul>";
      }
      else
         print ("No hay noticias disponibles");
    ?>
             
         
               <br>
               <br>
               <input name="txt_id" type="hidden" id="txt_id2" value="<?PHP echo $rowid; ?>">                
         </table>           
            <br>
            <br>
            
                </center>
   </table>
   
    <!-- /forum rules and admin links -->
  </form>
  <p align="center"><br />
  </p>
</div>
<div align="center"></div>
</body>

</html>
