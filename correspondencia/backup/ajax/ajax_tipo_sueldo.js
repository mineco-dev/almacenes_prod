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
function eliminarDatos(){
	        var nombre=document.tipo_sueldo.nombre.value;
	        var id_tsu=document.tipo_sueldo.id_tsu.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_tipo_sueldo.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_tsu="+id_tsu;
			
			ajax.send(var_send);
		    cargaContenido("tipo_sueldo","1");
		    nuevoDatos();
	    }
}        
function guardarDatos(){
 			var id_tsu=document.tipo_sueldo.id_tsu.value;
		c1=document.tipo_sueldo.nombre.value;
	
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_tipo_sueldo.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_tsu="+id_tsu+"&op1=insert&c1="+c1;
		ajax.send(var_send);
		cargaContenido("tipo_sueldo","1");
		 nuevoDatos();
}
function nuevoDatos(){
 	   document.tipo_sueldo.id_tsu.value=""
       document.tipo_sueldo.nombre.value="";
       document.tipo_sueldo.nombre.focus();
}

function cargaContenido(consulta,fila){
 		  var ajax=nuevoAjax();
          var capaContenedora = document.getElementById(fila);
          ajax.open ("POST","/modulos/selected.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
		                        document.getElementById(fila).innerHTML=ajax.responseText;
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="consulta="+consulta;
         ajax.send(var_send);
  return;
}

function leerDatos(){
	 var lista_tipo_sueldo=document.getElementById('tipos_sueldos');
	 var id_tsu=lista_tipo_sueldo.value;

	  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_xml.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
				                   	capaContenedora.innerHTML="";
		                       		var vari=ajax.responseXML;       		
						          		document.tipo_sueldo.id_tsu.value=id_tsu;
										document.tipo_sueldo.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
						        		document.tipo_sueldo.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_tsu="+id_tsu+"&modulo=tipo_sueldo";
         ajax.send(var_send);
  return;    
}
</script>