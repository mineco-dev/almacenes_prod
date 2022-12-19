<?

function sql_insert(tabla, campos, valores)
{	
	$query = "insert into $tabla ($campos) values($valores)";
	
	return true;
}

function sql_update(tabla, campos, condicion)
{
	return true;
}

function sql_delete(tabla, condicion)
{
	return true;
}
function sql_max(tabla, campo)
{
	return true;
}
function sql_query(consulta)
{
	return true;
}



?>