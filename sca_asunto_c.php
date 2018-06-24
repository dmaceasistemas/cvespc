<?php
include ("sca_precarga.php");
/*Modulo de Consulta de Asuntos*/
conectar();
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Consulta de Asuntos</b></center><br/>
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td class="celdas"><div align="center">Id Asunto</div></td>
	<td class="celdas"><div align="center">Asunto</div></td>
	<td class="celdas" colspan="2"><div align="center">&nbsp;</div></td>
</tr>

<?php
	$sql_c = "select id_asunto, asunto from asuntos where id_asunto<>'0'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_asunto=$campo ['id_asunto'];
			$asunto=$campo ['asunto'];
?>
		<tr>
			<td><div align="center"><?php echo $id_asunto?></div></td>
			<td><div align="center"><?php echo $asunto?></div></td>
			<td><div align="center"><a href="sca_asunto_m.php?id_asunto=<?php echo "$id_asunto"?>"><img src="./imagenes/m_editar.png" alt="Modificar" title="Modificar" height="16" width="16" border="0"></a></div></td>
			<td><div align="center"><a href="sca_case.php?seleccion=6&id_asunto=<?php echo "$id_asunto"?>"><img src="./imagenes/m_eliminar.png" alt="Eliminar" title="Eliminar" height="16" width="16" border="0" onclick="return confirmLink(this, 'Seguro que desea eliminar el registro')"></a></div></td>
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