<?php
include ("sca_precarga.php");
/*Modulo de Consulta de los Tipos de Anexos*/
conectar();
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Consulta Tipo de Anexo</b></center><br/>
<?php /*
<select name="id_ente">
<?php
$id_ente2="";
echo "<option value=---->ente</option>";
$entes_c = "select id_ente, ente from entes"; 
$entes_c= mysql_db_query ($mydb,$entes_c) or die ("Error en consulta de entes".mysql_error());
while ($campo = mysql_fetch_array ($entes_c))
	{
	$id_ente=$campo['id_ente'];
	$ente=$campo['ente'];
	if ($id_ente==$id_ente2)
		{
		echo "<option value=$id_ente selected='selected'>$ente</option>";
		}
	else
		{
		echo "<option value=$id_ente>$ente</option>";
		}
	}
?>
</select>

function select_ente()
{
	echo "<select name='id_ente'>";
	$id_ente2="";
	echo "<option value=---->ente</option>";
	$sql = "select id_ente, ente from entes"; 
	$sql= mysql_query ($sql) or die ("Error en consulta de entes".mysql_error());
	while ($campo = mysql_fetch_array ($sql))
		{
		$id_ente=$campo['id_ente'];
		$ente=$campo['ente'];
		if ($id_ente==$id_ente2)
			{
			echo "<option value=$id_ente selected='selected'>$ente</option>";
			}
		else
			{
			echo "<option value=$id_ente>$ente</option>";
			}
		}
	echo "</select>";
}
*/?>

<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td class="celdas"><div align="center">Id Tipo de Anexo</div></td>
	<td class="celdas"><div align="center">Tipo</div></td>
	<td class="celdas" colspan="2"><div align="center">&nbsp;</div></td>
</tr>

<?php
	$sql_c = "select id_anexo_t, anexo_t from anexos_t where id_anexo_t<>'0'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_anexo_t=$campo ['id_anexo_t'];
			$anexo_t=$campo ['anexo_t'];
?>
		<tr>
			<td><div align="center"><?php echo $id_anexo_t?></div></td>
			<td><div align="center"><?php echo $anexo_t?></div></td>
			<td><div align="center"><a href="sca_anexo_t_m.php?id_anexo_t=<?php echo "$id_anexo_t"?>"><img src="./imagenes/m_editar.png" alt="Modificar" title="Modificar" height="16" width="16" border="0"></a></div></td>
			<td><div align="center"><a href="sca_case.php?seleccion=20&id_anexo_t=<?php echo "$id_anexo_t"?>"><img src="./imagenes/m_eliminar.png" alt="Eliminar" title="Eliminar" height="16" width="16" border="0" onclick="return confirmLink(this, 'Seguro que desea eliminar el registro')"></a></div></td>
		</tr>
<?php
			}
		}
?>
</table>
<?php
}
else  
	{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
	}
?>

<?php
include ("sca_postcarga.php");
?>