// JavaScript Document
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {

		xmlhttp = new XMLHttpRequest();


	}
	return xmlhttp;
}
		
function consulta(fuente,div)
	{
		eval("var contenedor_"+div+"=document.getElementById('"+div+"');");
		eval("var objeto_"+div+"=objetoAjax();");
		//eval("objeto_"+div+".setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8')");
		eval('objeto_'+div+'.open("GET", "'+fuente+'");');
		eval('objeto_'+div+'.onreadystatechange=function(){ if (objeto_'+div+'.readyState!=4) { contenedor_'+div+'.innerHTML = "<option>Cargando...</option>"; } if (objeto_'+div+'.readyState==4) { contenedor_'+div+'.innerHTML = objeto_'+div+'.responseText; }} ');
		eval('objeto_'+div+'.send(null)');
	}
