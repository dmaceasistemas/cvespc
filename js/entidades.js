function consulta(fuente,div)
	{
		eval("var contenedor_"+div+"=document.getElementById('"+div+"');");
		eval("var objeto_"+div+"=objetoAjax();");
		//eval("objeto_"+div+".setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8')");
		eval('objeto_'+div+'.open("GET", "'+fuente+'");');
		eval('objeto_'+div+'.onreadystatechange=function(){ if (objeto_'+div+'.readyState!=4) { contenedor_'+div+'.innerHTML = "<option>Cargando...</option>"; } if (objeto_'+div+'.readyState==4) { contenedor_'+div+'.innerHTML = objeto_'+div+'.responseText; }} ');
		eval('objeto_'+div+'.send(null)');
	}

function act_municipio(estado)
	{	
		consulta('sca_entidades_ajax.php?mun=1&ide='+estado,'div_muni');
		act_parroquia(0);
		act_cp(0);
	}
function act_parroquia(municipio)
	{	
		consulta('sca_entidades_ajax.php?par=1&idm='+municipio,'div_parro');
		act_cp(0);
	}
function act_cp(parroquia)
	{	
		consulta('sca_entidades_ajax.php?cp=1&idp='+parroquia,'div_cp');
	}