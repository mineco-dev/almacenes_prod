<?	
	$grupo_id=1;
	include("restringir.php");
	$dianum=(int)date("d");
	$mesnum=(int)date("m");		
  	require_once('connection/helpdesk.php');				

	//busca publicaciones realizadas por mes
	$consulta = "Select * from publicacion  where ((month(fecha)='$mesnum') and (year(fecha)='2010')) and activo=1";
	
		//busca publicaciones realizadas hoy
	//$consulta = "Select * from publicacion  where ((month(fecha)='$mesnum' and day(fecha)='$dianum') or (month(fecha_modifica)='$mesnum' and day(fecha_modifica)='$dianum')) and activo=1";
	$i=0;		// variable para control del color de las filas
	$j=1;       // variable para control del arreglo		
	$hay_publicaciones=false;
	$result=mssql_query($consulta);				
	while($row=mssql_fetch_array($result))
	{					
       	$publicacion[$j]=$row["codigo_archivo"];
		$j++;		
	}
	$j--;
	if (isset($publicacion))  //si el query devuelve algun resultado
	{			
		if (!isset($_SESSION['notificado'])) // y no se ha notificado
		{						
			$hay_publicaciones=true; //notificara
			while ($j>0)
			{
				session_register('notificado');
				$_SESSION["notificado"]["$j"] = $publicacion[$j];
				$j--;
			}
		}
		else
		{			
			$size_notificado=count($_SESSION['notificado']);  //cantidad de anuncios ya notificados
			$size_publicacion=count($publicacion);	// cantidad de anuncios del dia					
			$k=1;				
			while ($k<=$size_publicacion)
			{
				$l=1;
				$ya_publicado=false;
				while ($l<=$size_notificado)
				{
					if ($_SESSION["notificado"]["$l"] == $publicacion[$k]) 
					{
						$l=$size_notificado+1;
						$ya_publicado=true;
					}
					else $l++;					
				}
				if ($ya_publicado==false)
				{
					$hay_publicaciones=true;
					$size_notificado=$size_notificado+1;
					$_SESSION["notificado"]["$size_notificado"] = $publicacion[$k];					
				}
				$k++;
			}
		}							
	}	
?>
<!-- este codigo se debe colocar en index.php

<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=300, height=200, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>

<?
	//if ($active_popup==1) 
//	{	
		//echo '<body onload=Abrir_ventana("reciente.php")>';
	//}
	//else 
//	{
		//echo "<body>";
//	}
?>	
-->


