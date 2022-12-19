<? 
include('INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('conectarse.php');

// borra todas ls tablas del esquema a escepcion de las siguientes
$sql = "SELECT (TABLE_NAME) FROM INFORMATION_SCHEMA.TABLES where table_name not in ('asesor_departamento', 'asesor_municipio',
		'asesor_grupoetnico', 'asesor_registro', 'correspondencia', 'DEPARTAMENTO', 'direccion', 'VISTA1', 'VISTA2', 'VISTA3',
		'VISTA4', 'sysconstraints', 'tipo_usuario', 'syssegments', 'puesto', 'familiaridad')";

print $sql;
// borra las siguientes tablas del esquema por tener dependencia con las que no se habian vaciado
/*$sql = "SELECT (TABLE_NAME) FROM INFORMATION_SCHEMA.TABLES where table_name in ('asesor',
		'asesor_grupoetnico', 'asesor_registro', 'correspondencia', 'DEPARTAMENTO', 'direccion', 'tipo_usuario')";*/
$result = mssql_query($sql);
$c = 0;
while ($row = mssql_fetch_array($result))
	{
	 print $c++."borra ".$row[0]." <br>";
	 $del = "delete from ".$row[0];
	 $resdel = mssql_query($del);
/*	 $rsRows = mssql_query("select @@rowcount as rows");
	  $rows = mssql_fetch_assoc($rsRows); 
//  	envia_msg( $rows['rows']);

	//	envia_msg(mssql_rows_affected($result) );
		if ( $rows['rows'] == 1 )
		 {
		  envia_msg('A-'.$rows['rows']);
//		  cambiar_ventana('actualiza_familia.php');
			 mssql_free_result($result);
		 }
		else
		 {
// 		  $invalidos = $invalidos + 1;
  		  envia_msg('B-'.$rows['rows']);
//		  envia_msg('NO SE PUDO INGRESAR EL FAMILIAR '.$hijos);
		 }*/
	}
	


?>