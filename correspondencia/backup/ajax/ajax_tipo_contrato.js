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
        var nombre=document.tipo_contrato.nombre.value;
        var id_tco=document.tipo_contrato.id_tco.value;
	    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
    
	    if ( eliminar ) {
		  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_tipo_contrato.php", true);
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
          var var_send="op1=delete"+"&id_tco="+id_tco;         
          ajax.send(var_send);

          nuevoDatos();
          
          cargaContenido("tipo_afp","1");	  
	    }
	  return; 
}       
function guardarDatos(){
 			var id_cto=document.tipo_contrato.id_tco.value;
		c1=document.tipo_contrato.nombre.value;
	
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_tipo_contrato.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_tco="+id_cto+"&op1=insert&c1="+c1;
		ajax.send(var_send);
		
		 if(document.tipo_contrato.id_tco.value==''){
			nuevoDatos();
		}
		
		cargaContenido("tipo_contrato","1");
}
function nuevoDatos(){
 	   document.tipo_contrato.id_tco.value=""
       document.tipo_contrato.nombre.value="";
       document.tipo_contrato.nombre.focus();
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
	 var lista_tipo_contrato=document.getElementById('tipos_contratos');
	 var id_tco=lista_tipo_contrato.value;

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
						          		document.tipo_contrato.id_tco.value=id_tco;
										document.tipo_contrato.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
						        		document.tipo_contrato.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_tco="+id_tco+"&modulo=tipo_contrato";
         ajax.send(var_send);
  return; 
}
</script>