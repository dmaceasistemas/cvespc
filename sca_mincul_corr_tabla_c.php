<?php
include_once("sca_precarga.php");
//Modulo para examinar la existencia de la tabla 
?>
<center><b>Configuración DB de SISYC</b></center>
</br>
<form id="form1" name="nuevo_emisor" method="post" action=" sca_case.php"  autocomplete="off">

<table border="1" align="center" cellpadding="2" cellspacing="0">

<tr>
	<td class="celdas"><div align="center">DB</div></td>
	<td class="celdas"><div align="center">

<select name="base_mincul_corr">
<?php
conectar_mysql();
$db_list = mysql_list_dbs();
while ($row = mysql_fetch_object($db_list)) 
	{
	$mydb=$row->Database;
	$nombretabla="temisor";
	$resultado=ExistenciaTabla($nombretabla, $mydb);
	if ($resultado==1)
		{
		$sql_c="select * from bases_db where base_db='$mydb' and id_base_db_t='3'";
//		$sql_c_r=$sql_c;
//		echo $sql_c;
		$sql_c=sql_c($sql_c);
		$conteo_sql_c=@mysql_num_rows($sql_c);
		if ($conteo_sql_c==1)
			$selected="selected='selected'";
//		else
//			$selected="";
		echo "<option value='$mydb' $selected>$mydb</option>";
		$selected="";
		}
	}
?>
</select>
</td>
</tr>

<tr class="celdas">
	<input name="seleccion" type="hidden" value="25"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	<tr><td colspan="3"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div></td></tr>
</tr>
</table>
</form>

<?php
include ("sca_postcarga.php");
?>