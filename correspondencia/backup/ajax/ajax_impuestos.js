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
function EsMenor(fecha1,fecha2){
Data1_arr = fecha1.split('/');
Data2_arr = fecha2.split('/');

if (parseInt(Data1_arr[2],10) > parseInt(Data2_arr[2],10)) return true; //año
if (parseInt(Data1_arr[1],10) > parseInt(Data2_arr[1],10)) return true; //mes
if (parseInt(Data1_arr[0],10) > parseInt(Data2_arr[0],10)) return true; //dia
return false;
}

function eliminarDatos(){
	    var eliminar = confirm("confirma eliminar impuesto "+document.impuesto.nombre.value+" actual ?");
	    if ( eliminar ) {
		  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_impuestos.php", true);
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
          var var_send="op1=delete"+"&id_imp="+document.impuesto.id_imp.value;
          ajax.send(var_send);
          cargaContenido("impuesto","1");
		  nuevoDatos();
	    }
	  return; 
}        

function guardarDatos(){
 	setFocus=1;
	 error='';
	

		if(document.impuesto.valor.value==''){
			error=error+'Valor no debe estar en blanco\n';
		}

		if(document.impuesto.nombre.value==''){
			error=error+'Nombre tipo impuesto\n';
		}

		if(EsMenor(document.impuesto.fh_ini.value,document.impuesto.fh_fin.value)==true){
				error=error+"Fecha inicio no puede ser mayor a fecha termino";
				setFocus=2;
		}
		
		if(document.impuesto.fh_ini.value=='' || document.impuesto.fh_fin.value==''){
			error=error+'Fecha inicio y Fecha termino\n';
		}

		if(error!=''){
			alert('Debe verificar o ingresar los siguientes datos:\n\n'+error);	
				document.impuesto.fh_ini.focus();
		} else {
			id_imp=document.impuesto.id_imp.value;
			fh_ini=document.impuesto.fh_ini.value;
			fh_fin=document.impuesto.fh_fin.value;
			nombre=document.impuesto.nombre.value;
			valor=document.impuesto.valor.value;
			
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_impuestos.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
				var var_send="op1=insert&id_imp="+id_imp+"&nombre="+nombre+"&valor="+valor+"&fh_ini="+fh_ini+"&fh_fin="+fh_fin;
	
			ajax.send(var_send);
			
			if(document.impuesto.id_imp.value==''){
				nuevoDatos();
			}
			cargaContenido("impuesto","1");
		}
		return;
}

function nuevoDatos(){
   	   document.impuesto.fh_ini.value=""
       document.impuesto.fh_fin.value="";
       document.impuesto.nombre.value="";
       document.impuesto.valor.value="";
       document.impuesto.id_imp.value="";
       document.impuesto.nombre.focus();
    return;
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
		 var lista_impuesto=document.getElementById('impuestos');
	 	 document.impuesto.id_imp.value=lista_impuesto.value;

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
						         		document.impuesto.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data;
						         		document.impuesto.valor.value = vari.getElementsByTagName('valor').item(0).firstChild.data;
						         		document.impuesto.fh_ini.value = vari.getElementsByTagName('fh_ini').item(0).firstChild.data;
						         		document.impuesto.fh_fin.value = vari.getElementsByTagName('fh_fin').item(0).firstChild.data;
						         		document.impuesto.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_imp="+lista_impuesto.value+"&modulo=impuesto";
         ajax.send(var_send);
  return; 
}
</script>