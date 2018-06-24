/* Muestra el mensaje para la eliminacion de un Registro*/
function confirmLink(theLink, msg)
	{
	if (msg == '' || typeof(window.opera) != 'undefined')
	return true;
	
	var is_confirmed = confirm(msg);
	return is_confirmed;
	}

/*Muestra una ventana pop Up*/
function lanzarSubmenu(ventana,an,al)
	{
		if(isNaN(an) && isNaN(al))
			{
				an = 400;
				al = 400;
			}
		ventana_secundaria = window.open(ventana,"catalogo","width="+an+",height="+al+",scrollbars=YES")
		ventana_secundaria.moveTo(200,200);
	}