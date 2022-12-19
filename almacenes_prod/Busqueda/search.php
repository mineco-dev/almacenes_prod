<?PHP
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");

$categoria = $_GET['categoria'];
$subcategoria = $_GET['subcategoria'];
$producto = $_GET['producto'];

//print($subcategoria);
?>
<html>
<head>
<style type="text/css">
    .tres a {
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



.grey a:hover{
  background: #39a0e5;
}

    </style>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
    alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
    form.txt_buscar.focus(); 
    return;
  }  
function Refrescar(form)
{
    form.reset();
    form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="../css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="../css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html"; charset="windows-1252">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">

</style>
</head>

<body>

<div align="left">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"></td>
              <td width="72%"><div align="center" class="legal1">Tarjeta de Kardex por Producto</div></td>
              
              <td width="15%"><div align="center"><img src="../mineco.JPG" width="107" height="113"></div></td>
            </tr>
            <tr>
              
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
  
    
    <form name="modificar_usuario" method="POST" action="modificar_assegiz.php">
<table  cellpadding="2" cellspacing="1" border="0" width="100%" id="table17">     
      <tr>
        <td colspan="2"></thead>
    <tr align="center"  class="principalmain">
          <td colspan="2"><strong>Fecha</strong></td>
          <td width="7%"><strong>Tipo Mov</strong></td>
      <td width="6%"><strong>No. Desp</strong></td>
      <td width="6%"><strong>No. Ingre</strong></td>
      <td width="6%"><strong>Entrada</strong></td>
      <td width="6%"><strong>Salida</strong></td>
           <td width="6%"><strong>Saldo</strong></td>
        <!--  <td width="5%"><strong>Promedio</strong></td>
          <td width="6%"><strong>Factura</strong></td>
          <td width="7%"><strong>Mov</strong></td>
          <td width="6%"><strong>Ext</strong></td> -->
          <td width="6%"><strong>Ver Documento</strong></td>
      <td width="32%"><strong>Dependencia</strong></td>
      
    
      
         
</tr>
<?PHP
/*$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
t.nombre as solicitante,
        t.pregunta,t.idsolicitud,t.telefono,p.pais                      
from
    tbl_solicitud t, tbl_pais p
    where 
year(t.fechahora) >= '$cboAnioi' and month(t.fechahora) >= '$cboMesi' and day(t.fechahora) >= '$cboDiai'
and year(t.fechahora) <= '$cboAniof' and month(t.fechahora) <= '$cboMesf' and day(t.fechahora) <= '$cboDiaf'
and t.idpais = p.idpais 
order by t.fechahora desc";*/



/*
$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
                        CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
                        t.nombre as solicitante,
                        t.pregunta,t.idsolicitud,t.telefono,p.pais
                        
 from
    tbl_solicitud t, tbl_pais p
    where 
    fechahora >= '$fecha1h' and fechahora <= '$fecha2h' and t.idpais = p.idpais 
 order by fechahora desc";*/


 conectardb($almacen);
 
 $query = "use almacen_nuevo_qa 
select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
CONVERT(nvarchar(10), k.fecha, 108) as hora,
 m.tipo_movimiento,
 k.no_despacho, 
k.no_requisicion,  
k.no_ingreso, 
k.entrada,
k.salida, 
k.saldo, 
k.costo_promedio, 
k.costo_factura, 
costo_movimiento,
 costo_total, 
 d.nombre,
 codigo_kardex
 from tb_kardex k
inner join cat_tipo_movimiento m
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
inner join direccion d
on k.id_dependencia = d.iddireccion
    where 
     k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo = 1
order by codigo_kardex asc";
 //print($query);

?>
<?PHP

    
    
                $do=mssql_query($query);
                $i = 0;                                 
                $tmp = 0;
        
 if( $do === false) {
    die( print_r( mysql_error(), true) );
    }
                                
                while($row = mssql_fetch_array($do))
                {   
                    $err = 0;
                    
                        $i++;
                    include("../css/format_table.php");
                    
                    echo '<tr class='.$clase.'><td colspan="2">'
                                                 
                        ?>
                        <?php echo $row['fecha'];?></td>
                        <td><?php echo $row['tipo_movimiento'];?></td>
                        <td><?php echo $row['no_despacho'];?></td>
                        <td><?php echo $row['no_ingreso'];?></td>
                        <td><?php echo number_format($row['entrada']);?></td> 
                        <td><?php echo number_format($row['salida']);?></td>
                        <td><?php echo number_format($row['saldo']);?></td>
                        <!-- <td><?php echo $row['costo_promedio'];?></td>
                        <td><?php echo $row['costo_factura'];?></td>
                        <td><?php echo $row['costo_movimiento'];?></td>
                        <td><?php echo $row['costo_total'];?></td> -->
                        <td><center><div class="tres grey"><a href="verdocu.php?despacho=<?php echo $row['no_requisicion'];?>&ingreso=<?php echo $row['no_ingreso'];?>">Ver</a></div></center></td>
                        <td><?php echo $row['nombre'];?></td>
                            
                        
                            
                            </tr>

<?php } ?>

        <td width="5%"></td>
      <td width="2%"></tbody><?PHP
        
      ?>
      
  </table>
  </form>
 

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
            <div align="left"></div>
        
           
</body>
</html>