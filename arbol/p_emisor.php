<?php
/*error_reporting (0); 
mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('p_mincul_corr')or die(mysql_error());*/
?>

<script>
function lanzarSubmenu(ventana,an,al)
	{
		if(isNaN(an) && isNaN(al))
			{
				an = 400;
				al = 400;
			}
		ventana_secundaria = window.open(ventana,"_blank","width="+an+",height="+al+",scrollbars=YES")
		ventana_secundaria.moveTo(200,200);
	}
</script>
<form id="form1" name="nuevo_emisor" method="post" action="p_emisor.php?o">
<table width="100%" border="1">
<tr>
	<td bgcolor="#CCCCCC" colspan="2"><div align="center"><strong>Emisores</strong></div></td>
</tr>
<tr>
	<td class="texto_descripcion">Emisores&nbsp;</td>
	<td>
	<input name="emisor" type="text" class="texto_descripcion" id="emisor" size="35"<?php if(@$_GET['ide']!="") echo 'value="'.nombrePadre($query['codigo']).'"';?> />
	<a href="#" onclick="lanzarSubmenu('p_arbol_emisores.php?id_accion=12&amp;nue_emi=1')" > <img src="img/xhtml_go.png" width="16" height="16" border="0" />
	<input name="codigo_emisor" type="hidden" id="codigo_emisor"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codigo']).'"';?> /></a>
	</td>
</tr>
<tr>
	<td bgcolor="#CCCCCC" colspan="2"><div align="center">
	<input name="guardar" type="submit" value="Enviar"/>
	</div></td>
</tr>
</table>
</form>

<?php
$codigo_emisor=$_POST['codigo_emisor'];
echo "<hr>$codigo_emisor<hr>";
?>