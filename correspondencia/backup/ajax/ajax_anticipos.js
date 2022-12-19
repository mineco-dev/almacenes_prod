<script language="javascript" type="text/javascript">
function nuevoAjax(){ 
	var xmlhttp=false; 
	try { 
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e) { 
		try { 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}
function modificar(var_rut, var_ano, var_mes, var_valor){

		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_anticipos.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="rut="+var_rut+"&ano="+var_ano+"&mes="+var_mes+"&valor="+var_valor;
		ajax.send(var_send);
	return;	
}

function filtro_sucursal(){
 	var error='';
 	var puntero=0;
 	
 		 var mes=document.anticipo.mes.value;
 		 var ano=document.anticipo.ano.value;
	 		 var id_suc=document.getElementById('sucursal');
	 		 
	if(ano==''){
		error='error debe ingresar un año valido\n';
		puntero=1;
	} else {
		if(ano < 1990){
		error='error debe ingresar un año valido\n';
		puntero=1;
		}
	}

	if(mes==''){
		error=error+' error debe ingresar mes valido\n';
	} else {
		if(mes <=0 || mes >=13){
		error=error+' error debe ingresar mes valido\n';
		}
	}
	
	if(error==''){
	      var ajax=nuevoAjax();
          var capaContenedora = document.getElementById('capaContenedora');
          ajax.open ("POST","/modulos/mo_filtro_anticipos.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
		                        document.getElementById('capaContenedora').innerHTML=ajax.responseText;
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="mes="+mes+"&ano="+ano+"&id_suc="+id_suc.value;
   
         ajax.send(var_send);
   } else {
    	alert(error);
    	if(puntero==1){
	    	 document.anticipo.ano.focus();
    	} else{ 
    		document.anticipo.mes.focus();
    	}
   } 	
         return;
}
</script>