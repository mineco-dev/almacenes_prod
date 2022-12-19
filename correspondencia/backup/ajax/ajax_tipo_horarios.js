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
	        var nombre=document.tipo_horario.nombre.value;
	        var id_cah=document.tipo_horario.id_cah.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
	    if ( eliminar ) {
		  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_tipo_horarios.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
			                    capaContenedora.innerHTML="";
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          var var_send="op1=delete"+"&id_cah="+id_cah;
          ajax.send(var_send);
          cargaContenido("tipo_afp","1");
		  nuevoDatos();
	    }
	  return; 
}        
function guardarDatos(){
 			var id_cah=document.tipo_horario.id_cah.value;
		c1=document.tipo_horario.nombre.value;
		c2=document.tipo_horario.horario.value;
		
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_tipo_horarios.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_cah="+id_cah+"&op1=insert&c1="+c1+"&c2="+c2;
		ajax.send(var_send);
		
		if(document.tipo_horario.id_cah.value==''){
			nuevoDatos();
		}
		
		cargaContenido("tipo_horario","1");
		 
}
function nuevoDatos(){
 	   document.tipo_horario.id_cah.value=""
       document.tipo_horario.nombre.value="";
       document.tipo_horario.horario.value="";
       document.tipo_horario.nombre.focus();
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
	 var lista_tipo_horario=document.getElementById('tipos_horarios');
	 var id_cah=lista_tipo_horario.value;
     
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
						          		document.tipo_horario.id_cah.value=id_cah;
										document.tipo_horario.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
										document.tipo_horario.horario.value = vari.getElementsByTagName('horario').item(0).firstChild.data; 
						        		document.tipo_horario.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_cah="+id_cah+"&modulo=tipo_horario";
         ajax.send(var_send);
  return; 
}
</script>