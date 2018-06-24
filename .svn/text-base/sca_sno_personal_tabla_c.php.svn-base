<?php
include_once("sca_precarga.php");
//Modulo para examinar la existencia de la tabla 
?>
<center><b>Configuración Bases de datos Sigesp</b></center>
</br>
<form id="form1" name="nuevo_emisor" method="post" action=" sca_case.php"  autocomplete="off">

<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td class="celdas" colspan="3"><div align="center"><b>Base de Datos Sigesp Principal</b></div></td>
</tr>

<tr>
	<td class="celdas"><div align="center">&nbsp;</div></td>
	<td class="celdas"><div align="center">DB</div></td>
	<td class="celdas"><div align="center">Nombre de la Empresa</div></td>
</tr>
<?php
conectar_mysql();
$db_list = mysql_list_dbs();
while ($row = mysql_fetch_object($db_list)) 
	{
	$mydb=$row->Database;
	$nombretabla="sno_personal";
	$resultado=ExistenciaTabla($nombretabla, $mydb);
	if ($resultado==1)
		{
		$sql_bases = "SELECT codemp, nombre  FROM sigesp_empresa"; 
		$sql_bases=sql_bases_2($sql_bases,$mydb);
		if (!(@mysql_num_rows ($sql_bases) == 0))
			{
			while ($row2 = mysql_fetch_array($sql_bases))
				{
				$codemp=$row2['codemp'];
				$nombre=$row2['nombre'];
				$sql_c="select * from bases_db where base_db='$mydb' and id_base_db_t='1'";
				$sql_c=sql_c($sql_c);
				$conteo_sql_c=@mysql_num_rows($sql_c);

				if ($conteo_sql_c==1)
					$checked="checked";
				else
					$checked="";
				$conteo_sql_c="";
?>
                <tr>
                    <td><input name='base_sigesp_principal[]' type='checkbox' value="<?php echo $mydb?>" <?php echo $checked?> /></td>
                    <td><?php echo $mydb?></td>
                    <td><?php echo $nombre?></td>
                </tr>
<?php
				}
			}
		}
	}
 
?>
</table>
</br>

<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td class="celdas" colspan="3"><div align="center"><b>Base de Datos Sigesp de Consulta</b></div></td>
</tr>

<tr>
	<td class="celdas"><div align="center">&nbsp;</div></td>
	<td class="celdas"><div align="center">DB</div></td>
	<td class="celdas"><div align="center">Nombre de la Empresa</div></td>
</tr>
<?php
conectar_mysql();
$db_list = mysql_list_dbs();
while ($row = mysql_fetch_object($db_list)) 
	{
	$mydb=$row->Database;
	$nombretabla="sno_personal";
	$resultado=ExistenciaTabla($nombretabla, $mydb);
	if ($resultado==1)
		{
		$sql_bases = "SELECT codemp, nombre  FROM sigesp_empresa"; 
		$sql_bases=sql_bases_2($sql_bases,$mydb);
		if (!(@mysql_num_rows ($sql_bases) == 0))
			{
			while ($row2 = mysql_fetch_array($sql_bases))
				{
				$codemp=$row2['codemp'];
				$nombre=$row2['nombre'];
				$sql_c="select * from bases_db where base_db='$mydb' and id_base_db_t='2'";
				$sql_c=sql_c($sql_c);
				$conteo_sql_c=@mysql_num_rows($sql_c);

				if ($conteo_sql_c==1)
					$checked="checked";
				else
					$checked="";
				$conteo_sql_c="";
?>
                <tr>
                    <td><input name='base_sigesp_secundario[]' type='checkbox' value="<?php echo $mydb?>" <?php echo $checked?> /></td>
                    <td><?php echo $mydb?></td>
                    <td><?php echo $nombre?></td>
                </tr>
<?php
				}
			}
		}
	}
 
?>
<tr class="celdas">
	<input name="seleccion" type="hidden" value="24"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	<tr><td colspan="3"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div></td></tr>
</tr>
</table>
</form>


<?php
include ("sca_postcarga.php");
?>