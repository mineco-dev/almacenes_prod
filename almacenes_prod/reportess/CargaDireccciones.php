<?PHP


	require('../conexion.php');
	

	$sql = "SELECT iddireccion, nombre FROM [dbo].[direccion] WHERE activo = 1";
	header('Content-Type: text/html; charset=ISO-8859-1');
	$result = mssql_query($sql);
	
	if($result)
	{
		while( $row = mssql_fetch_array($result) )
		{
			echo "<option value = '". $row['iddireccion']."'>". $row['nombre']."</option>";
		}	
		mssql_free_result($result);
	}
	else
	{
		echo "No hay datos";
	}
?>