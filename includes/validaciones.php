<?	
	$i=1;
	echo '<script type="text/javascript">'; //funcion para las validaciones 
	echo 'function validar(form)';
	echo '{';							
			while($i<=count($campo_validacion))
			{				
				if ($tipo_campo[$i]=="1" || $tipo_campo[$i]=="5" || $tipo_campo[$i]=="7" || $tipo_campo[$i]=="9")
				{					
						echo 'if (form.'.$campo_validacion[$i].'.value == "")';
						echo '{ ';
								echo 'alert("'.$mensaje_validacion[$i].'");'; 
								echo 'form.'.$campo_validacion[$i].'.focus();'; 
								echo 'return;';
						echo '}';
				}
				else
				if ($tipo_campo[$i]=="2")
				{
						echo 'if (form.'.$campo_validacion[$i].'.value == "0")';
						echo '{ ';
							echo 'alert("'.$mensaje_validacion[$i].'");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}																	
				if ($tipo_campo[$i]=="7")
				{						
						echo 'if (!isNumber(form.'.$campo_validacion[$i].'.value))';
						echo '{ ';
							echo 'alert("En este campo solo puede ingresar números");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="10")
				{
						echo 'if (form.'.$campo_validacion[$i].'_hora.value == "0")';
						echo '{ ';
							echo 'alert("Seleccione la hora");'; 
							echo 'form.'.$campo_validacion[$i].'_hora.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="10")
				{
						echo 'if (form.'.$campo_validacion[$i].'_minutos.value == "0.5")';
						echo '{ ';
							echo 'alert("Seleccione los minutos");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}	
				if ($tipo_campo[$i]=="11")
				{
						echo 'if (form.'.$campo_validacion[$i].'_id.value == "")';
						echo '{ ';
							echo 'alert("Debe seleccionar el nombre de una persona");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}	
				if ($tipo_campo[$i]=="11")
				{
						echo 'if (form.'.$campo_validacion[$i].'_id.value == "0")';
						echo '{ ';
							echo 'alert("Debe seleccionar el nombre de una persona");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}	
				if ($tipo_campo[$i]=="12")
				{
						echo 'if (form.'.$campo_validacion[$i].'_id.value == "")';
						echo '{ ';
							echo 'alert("Debe seleccionar el vehiculo");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="12")
				{
						echo 'if (form.'.$campo_validacion[$i].'_id.value == "0")';
						echo '{ ';
							echo 'alert("Debe seleccionar el vehiculo");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}		
			$i++;
			}
		echo 'if (confirm("¿Esta acción guarda y cierra este formulario, desea continuar?")) form.submit();';
	echo '}';		
	echo '</script>';	
?>
<script LANGUAGE="JavaScript">
var defaultEmptyOK = false

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}

function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c)) return false;
        } else { 
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
</script>