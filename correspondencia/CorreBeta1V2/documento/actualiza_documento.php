<?
 	session_start();
include('../../conectarse.php');
$_SESSION['nivel']=2;

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}

	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}

	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	
?>
<script language="javascript">
	function Verifica()
	 {
		if (form1.txtDescripcion.value == "" || form1.tuserfile.value == "")
			{
				alert('Por favor complete los campos para subir los documentos.');
				return false
			}
		}
</script>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<!--link href="HojaEstilo.css" rel="stylesheet" type="text/css"-->
<!--link href="../css/styles.css" rel="stylesheet" type="text/css"-->
<link href="../style/estilos.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--



body,td,th {
	font-size: 11px;
	color: #000000;
}
.Estilo5 {color: #000000}
a:visited {
	color: #666666;
}
a:active {
	color: #666666;
}
a:link {
	color: #000000;
}
a:hover {
	color: #FF0000;
}
-->
</style></head>

<body>

<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%"  class="Estilo4">
		<strong><? print 'Usuario: '.$_SESSION['user']; ?></strong>
		</td>
		<td align="right"  width="70%" class="Estilo7">
		<a href="datos_personales_act.php?paramas=<? echo $_GET['paramas']; ?>"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar  ]</a>
		</td>
	</tr>
</table>

<?	
//include('conectarse.php');
//envia_msg('aqui si uploadform');
$_GET['paramas'];
// print $_GET['paramas'];

$a = $_GET['paramas'];
//envia_msg($a);

?>

<form name="form1" method="post" action="guarda_actualiza_documento.php<? print "?emple=$a";?>" onSubmit="return Verifica()" enctype="multipart/form-data">

  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="5">
    <tr bgcolor="#000000">
           <td bgcolor="#0033FF" colspan="2"><div align="center"><span class="Estilo4">Adjuntar Documentos</span></div></td>
    </tr>
    <tr class="Estilo1 Estilo7 Estilo22">
      <td><strong>Archivo a Subir </strong></td>
      <td class="Estilo22"><input name="userfile" type="file" class="Estilo22"></td>
    </tr>
	
    <tr class="Estilo1 Estilo7 Estilo22">
	<td>
	<strong>Tipo Documento</strong>
	</td>
	<td>
	<select name="id_tipo_doc" id="id_tipo_doc" class="Estilo7" size="1">
        <?
	$dbms->sql="select id_tipo_doc,documento from tipo_documento  where id_tipo_doc <> 1 order by 2"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["id_tipo_doc"]."\">".$Fields["documento"]."</option>"; 
	}
	

	$nom = $_GET['nombre'];
	//envia_msg('aqui va el nombre');
		//envia_msg($nom);
		
		$nom2 = $_GET['nombre2'];
	//envia_msg('aqui va el nombre2');
		//envia_msg($nom2);
		
		$ape = $_GET['apellido'];
	//envia_msg('aqui va el apellido');
		//envia_msg($ape);
		
		$ape2 = $_GET['apellido2'];
	//envia_msg('aqui va el apellido2');
		//envia_msg($ape2);
	
?>
      </select>
	<a href="tipo_documento.php?paramas=<? echo $a; ?>&nom=<? echo $nom ?>&nom2=<? echo $nom2; ?>&ape=<? echo $ape; ?>&ape2=<? echo $ape2; ?>" title="documento"><strong>Nuevo</strong></a>
	</td>
	</tr>
	
    <tr class="Estilo1 Estilo7 Estilo22">
      <td><strong>Descripcion</strong></td>
      <td><!--textarea name="txtDescripcion" cols="45" rows="10" id="txtDescripcion"></textarea-->
	  <input name="txtDescripcion" type="text" class="Estilo7" id="txtDescripcion" size="60" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	 

    <input type="submit" name="Submit" value="Subir" class="Estilo22">

	  
	  </td>
			<? 
/*			envia_msg($_POST['docu'].' este es el docu post');
			envia_msg($usuario);
			envia_msg($_SESSION['usuario']);*/
			?>
          <!--input name="docu" type="hidden" id="Proyecto" value="<? //echo $_POST['docu'];?>"></td-->
    
    </tr>
  </table>
</form>
<b> </b>

<form>
 <table width="100%" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="13" bgcolor="#0033FF"><div align="center"><span class="Estilo4">Documentos Personales</span></div></td>
    </tr>

	<tr><td colspan="13" align="center"  class="Estilo1 Estilo7 Estilo22"><strong><? echo $_SESSION['nombre_empleado'];?></strong></td></tr>
</table>





<table width="100%" border="0" align="center" cellspacing="1" class="Estilo1">
<tr class="Estilo1 Estilo7 Estilo22">
	<!--td class="Estilo7" align='center'>No.</td-->
	<td width="39%" align="center" bgcolor="#C9CDED" class="Estilo4"><span class="Estilo5">Descripcion</span></td>
	<!--td align="center" class="Estilo7 Estilo5">Extension</td-->
	<td width="29%" align="center" bgcolor="#99CCFFF" class="Estilo4 Estilo5">Nombre</td>	
	<td width="19%" align="center" bgcolor="#C9CDED" class="Estilo4 Estilo7"><span class="Estilo5">Tipo</span></td>
	<td width="13%" align="center" bgcolor="#99CCFFF" class="Estilo4"><span class="Estilo5">Fecha</span></td>
</tr>

<? 
				
$sql3 =	"select a.descripcion, a.extension, a.nombre, a.fecha, a.path, 
				b.documento
				from doc_adj_rrhh a, tipo_documento b   
				where (b.id_tipo_doc = a.id_tipo_doc) and 
				(a.id_tipo_doc <> 1) and 
				a.idasesor = ".$_GET['paramas']; 
				
				
				$result = mssql_query($sql3); 
				while ($row = mssql_fetch_array ($result)) 
				{
?>


<tr class="Estilo7" >
<td bgcolor="#C9CDED" >
 <a href="../../upload_rrhh/documentos/<? echo $row['path']; ?>" target="_blank">
<!--input name="descripcion" value="<?  //echo $row['descripcion']; ?>"-->
<?  echo $row['descripcion']; ?>
</a>
</td>

<!--td-->
 <!--a href="../../upload/<? echo $row['path']; ?>" target="_blank"-->
<!--input name="descripcion" value="<?  //echo  $row['extension']; ?>"-->
<?  //echo  $row['extension']; ?>
<!--/a>
</td-->

<td bgcolor="#99CCFF">
 <a href="../../upload_rrhh/documentos/<? echo $row['path']; ?>" target="_blank">
<!--input name="descripcion" value="<? // echo $row['nombre']; ?>"-->
<?  echo $row['nombre']; ?>
</a>
</td>

<td bgcolor="#C9CDED">
 <a href="../../upload_rrhh/documentos/<? echo $row['path']; ?>" target="_blank">
<!--input name="descripcion" value="<?  //echo $row['fecha']; ?>"-->
<?  echo $row['documento']; ?>
 </a>
</td>


<td bgcolor="#99CCFF">
 <a href="../../upload_rrhh/documentos/<? echo $row['path']; ?>" target="_blank">
<?  echo $row['fecha']; ?>
 </a>
</td>

</tr>
<? } ?>
</table>
</form>




</body>
</html>








