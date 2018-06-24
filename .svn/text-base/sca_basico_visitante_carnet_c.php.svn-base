<?php
include ("sca_precarga.php");
include ("metacalendario.php"); //Inclusión del Meta del Calendario solo se usa en el caso de usar fechas
/*Modulo de Consulta de Visitantes*/
//conectar();
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Consulta de Visitantes B&aacute;sico</b></center></br>
<?php
$id_visitante_t2="";
$id_asunto2="";
$ls_criterio="";
@$id_carnet=$_POST['id_carnet'];
if (!(empty($id_carnet)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_carnet='$id_carnet'";
	else
		$ls_criterio=" and a.id_carnet='$id_carnet'";
	}

@$cedula=$_POST['cedula'];
if (!(empty($cedula)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.cedula='$cedula'";
	else
		$ls_criterio=" and a.cedula='$cedula'";
	}

@$id_visitante_t2=$_POST['id_visitante_t'];
if (!(empty($id_visitante_t2)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and b.id_visitante_t='$id_visitante_t2'";
	else
		$ls_criterio=" and b.id_visitante_t='$id_visitante_t2'";
	}

@$id_asunto2=$_POST['id_asunto'];
if (!(empty($id_asunto2)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_asunto='$id_asunto2'";
	else
		$ls_criterio=" and a.id_asunto='$id_asunto2'";
	}

@$desde=$_POST['desde'];
@$hasta=$_POST['hasta'];
if (!(empty($desde)))
	{
	$desde_c=convertir_fecha($desde);
	$desde_c="$desde_c 00:00:00";
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.fecha_e>='$desde_c'";
	else
		$ls_criterio=" and a.fecha_e>='$desde_c'";
	}

if (!(empty($hasta)))
	{
	$hasta_c=convertir_fecha($hasta);
	$hasta_c="$hasta_c 99:99:99";
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.fecha_e<='$hasta_c'";
	else
		$ls_criterio=" and a.fecha_e<='$hasta_c'";
	}
?>

<form name="form1" method="post" action="sca_visitante_c.php" autocomplete="off">
<table border="1" cellpadding="2" cellspacing="0" align="center">
	<tr>
		<td height="22" width="110" class="celdas"><div align="center">Nro de Carnet</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Cedula</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Tipo de Visitante</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Asunto</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Desde</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Hasta</div></td>
		<td height="22" width="110" class="celdas">&nbsp;</td>
	</tr>
	<tr>
		<td><input name="id_carnet" type="text" size="11" maxlength="11"></td>
		<td><input name="cedula" type="text" size="11" maxlength="11"></td>
		<td><div align="center"><select name="id_visitante_t">
<?php
		$sql_c = "select id_visitante_t, tipo from visitantes_t"; 

		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$id_visitante_t=$campo ['id_visitante_t'];
				$tipo=$campo ['tipo'];
				if ($id_visitante_t==$id_visitante_t2)
					{
					echo "<option value=$id_visitante_t selected='selected'>$tipo</option>";
					}
				else
					{
					echo "<option value=$id_visitante_t>$tipo</option>";
					}
				}
			}
?>
		</select></div></td>
		<td><div align="center"><select name="id_asunto">
<?php
		$sql_c = "select id_asunto, asunto from asuntos"; 
		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$id_asunto=$campo ['id_asunto'];
				$asunto=$campo ['asunto'];
				if ($id_asunto==$id_asunto2)
					{
					echo "<option value=$id_asunto selected='selected'>$asunto</option>";
					}
				else
					{
					echo "<option value=$id_asunto>$asunto</option>";
					}
				}
			}
?>
		</select></div></td>
		<td><div align="center"><input name="desde" type="text" id="campo_fecha" size="9" maxlength="10" readonly="" value="<?php echo $desde ?>"/></div></td>
		<script type="text/javascript">
			Calendar.setup({
			inputField : "campo_fecha", // id del campo de texto
			ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto
			button : "lanzador" // el id del boton que lanzar el calendario
			});
		</script>
		<td><div align="center"><input name="hasta" type="text" id="campo_fecha2" size="9" maxlength="10" readonly="" value="<?php echo $hasta ?>"/></div></td>
		<script type="text/javascript">
			Calendar.setup({
			inputField : "campo_fecha2", // id del campo de texto
			ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto
			button : "lanzador" // el id del boton que lanzar el calendario
			});
		</script>
		<td><div align="center"><input name="buscar" type="submit" value="Buscar"/></div></td>
	</tr>
  </table>
</form>

<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
<?php /*	<td class="celdas"><div align="center">Id visitante_h</div></td>	*/?>
	<td class="celdas"><div align="center">Cedula</div></td>
	<td class="celdas"><div align="center">Apellidos</div></td>
	<td class="celdas"><div align="center">Nombres</div></td>
	<td class="celdas"><div align="center">Tipo de Visitante</div></td>
	<td class="celdas"><div align="center">Procedencia</div></td>
	<td class="celdas"><div align="center">Destino</div></td>
	<td class="celdas"><div align="center">Fecha de Entrada</div></td>
<?php /*	<td class="celdas"><div align="center">fecha_s</div></td>	*/?>
	<td class="celdas"><div align="center">Asunto</div></td>
	<td class="celdas"><div align="center">Observacion</div></td>
	<td class="celdas"><div align="center">Nro de Carnet</div></td>	

<?php /*	<td class="celdas"><div align="center">Telefono Movil</div></td>	*/?>

<?php /*	<td class="celdas" colspan="2"><div align="center">&nbsp;</div></td>	*/?>
</tr>

<?php
	$sql_c = "select a.id_visitante_h, a.cedula, a.cod_procedencia, a.procedencia, a.cod_emisor, a.emisor, a.fecha_e, a.fecha_s, a.id_asunto, a.observacion, a.id_carnet, b.nombre, b.apellido, b.id_visitante_t, c.asunto, d.tipo from visitantes_h a, visitantes b, asuntos c, visitantes_t d where a.fecha_s='0000-00-00 00:00:00' and a.cedula=b.cedula and a.id_asunto=c.id_asunto and b.id_visitante_t=d.id_visitante_t $ls_criterio order by a.fecha_e DESC "; 
	//$sql_c = "select * from visitantes_h where fecha_s='0000-00-00 00:00:00'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_visitante_h=$campo['id_visitante_h'];
			$cedula=$campo['cedula'];
			
			if (empty($campo['cod_procedencia']))
				$procedencia=$campo['procedencia'];
			else
				$procedencia=sql_mincul_corr($campo['cod_procedencia']);

			if (empty($campo['cod_emisor']))
				$emisor=$campo['emisor'];
			else
				$emisor=sql_mincul_corr($campo['cod_emisor']);
		
			$fecha_e=mostrar_fecha_larga($campo['fecha_e']);	
			$fecha_s=mostrar_fecha_larga($campo['fecha_s']);
			$asunto=$campo['asunto'];
			$observacion=$campo ['observacion'];
			$id_carnet=$campo ['id_carnet']; 

			$nombre=$campo ['nombre'];
			$apellido=$campo ['apellido'];
//			$telefono_movil=$campo ['telefono_movil'];
			$tipo=$campo ['tipo'];
?>
		<tr>
<?php	/*		<td><div align="center"><?php echo $id_visitante_h?></div></td>	*/?>
			<td><div align="center"><?php echo $cedula?>&nbsp;</div></td>
			<td><div align="center"><?php echo $apellido?>&nbsp;</div></td>
			<td><div align="center"><?php echo $nombre?>&nbsp;</div></td>
			<td><div align="center"><?php echo $tipo?>&nbsp;</div></td>
			<td><div align="center"><?php echo $procedencia?>&nbsp;</div></td>
			<td><div align="center"><?php echo $emisor?>&nbsp;</div></td>
			<td><div align="center"><?php echo $fecha_e?>&nbsp;</div></td>
<?php /*			<td><div align="center"><?php echo $fecha_s?>&nbsp;</div></td>	*/?>
			<td><div align="center"><?php echo $asunto?>&nbsp;</div></td>
			<td><div align="center"><?php echo $observacion?>&nbsp;</div></td>
			<td><div align="center"><?php echo $id_carnet?>&nbsp;</div></td>

<?php /*			<td><div align="center"><?php echo $telefono_movil?></div></td>	*/?>
<?php /*	
			<td><div align="center"><a href="sca_asunto_m.php?id_asunto=<?php echo "$id_asunto"?>"><img src="./imagenes/m_editar.png" alt="Modificar" title="Modificar" height="16" width="16" border="0"></a></div></td>
			<td><div align="center"><a href="sca_case.php?seleccion=6&id_asunto=<?php echo "$id_asunto"?>"><img src="./imagenes/m_eliminar.png" alt="Eliminar" title="Eliminar" height="16" width="16" border="0" onclick="return confirmLink(this, 'Seguro que desea eliminar el registro')"></a></div></td>	*/?>
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