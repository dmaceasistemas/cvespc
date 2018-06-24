<?php
include ("sca_precarga.php");
include ("metacalendario.php"); //Inclusión del Meta del Calendario solo se usa en el caso de usar fechas
/*Modulo de Consulta de Correspondencia*/
//conectar();
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Correspondencia</b></center><br/>
<?php
$id_correspondencia_t2="";
$id_anexo_t2="";
$ls_criterio="";

@$id_correspondencia_t2=$_POST['id_correspondencia_t'];
if (!(empty($id_correspondencia_t2)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_correspondencia_t='$id_correspondencia_t2'";
	else
		$ls_criterio=" and a.id_correspondencia_t='$id_correspondencia_t2'";
	}

@$id_anexo_t2=$_POST['id_anexo_t'];
if (!(empty($id_anexo_t2)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_anexo_t='$id_anexo_t2'";
	else
		$ls_criterio=" and a.id_anexo_t='$id_anexo_t2'";
	}

@$desde=$_POST['desde'];
@$hasta=$_POST['hasta'];
if (!(empty($desde)))
	{
	$desde_c=convertir_fecha($desde);
	$desde_c="$desde_c 00:00:00";
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.fecha_r>='$desde_c'";
	else
		$ls_criterio=" and a.fecha_r>='$desde_c'";
	}

if (!(empty($hasta)))
	{
	$hasta_c=convertir_fecha($hasta);
	$hasta_c="$hasta_c 99:99:99";
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.fecha_r<='$hasta_c'";
	else
		$ls_criterio=" and a.fecha_r<='$hasta_c'";
	}
?>

<form name="form1" method="post" action="" autocomplete="off">
<table border="1" cellpadding="2" cellspacing="0" align="center">
	<tr>
		<td height="22" width="110" class="celdas"><div align="center">Tipo</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Anexo</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Desde</div></td>
		<td height="22" width="110" class="celdas"><div align="center">Hasta</div></td>
		<td height="22" width="110" class="celdas">&nbsp;</td>
	</tr>
	<tr>
		<td><div align="center"><select name="id_correspondencia_t">
<?php

	$sql_c = "select id_correspondencia_t, correspondencia_t  from correspondencias_t"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_correspondencia_t=$campo['id_correspondencia_t'];
			$correspondencia_t=$campo['correspondencia_t'];
			if ($id_correspondencia_t==$id_correspondencia_t2)
				{
				echo "<option value=$id_correspondencia_t selected='selected'>$correspondencia_t</option>";
				}
			else
				{
				echo "<option value=$id_correspondencia_t>$correspondencia_t</option>";
				}
			}
		}
?>
	</select></td>
	<td><select name="id_anexo_t">
<?php

	$sql_c = "select id_anexo_t, anexo_t  from anexos_t"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_anexo_t=$campo['id_anexo_t'];
			$anexo_t=$campo['anexo_t'];
			if ($id_anexo_t==$id_anexo_t2)
				{
				echo "<option value=$id_anexo_t selected='selected'>$anexo_t</option>";
				}
			else
				{
				echo "<option value=$id_anexo_t>$anexo_t</option>";
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
	<td class="celdas"><div align="center">Id</div></td>
	<td class="celdas"><div align="center">Tipo</div></td>
	<td class="celdas"><div align="center">Anexo</div></td>
	<td class="celdas"><div align="center">Destino Receptor</div></td>
	<td class="celdas"><div align="center">Destino Nombre</div></td>
	<td class="celdas"><div align="center">Destino Cargo</div></td>
	<td class="celdas"><div align="center">Emisor Procedencia</div></td>
	<td class="celdas"><div align="center">Emisor Nombre</div></td>
	<td class="celdas"><div align="center">Emisor Cargo</div></td>
	<td class="celdas"><div align="center">Fecha Recepcion</div></td>
	<td class="celdas" colspan="2"><div align="center">&nbsp;</div></td>
</tr>

<?php
//	$ls_criterio="";
	$sql_c = "select a.id_correspondencia, a.cod_procedencia, a.procedencia, a.destino_nombre, a.destino_cargo, a.cod_emisor, a.emisor, a.emisor_nombre, a.emisor_cargo, a.fecha_r, b.correspondencia_t, c.anexo_t from correspondencias a, correspondencias_t b, anexos_t c where a.id_correspondencia_t=b.id_correspondencia_t and a.id_anexo_t=c.id_anexo_t and a.receptor_nombre='' $ls_criterio order by a.fecha_r DESC";

//correspondencia_t (clave  id_correspondencia_t 	) id_anexo_t (anexo_t)

//	$sql_c = "select a.id_visitante_h, a.cedula, a.cod_procedencia, a.cod_emisor, a.fecha_e, a.fecha_s, a.id_asunto, a.observacion, a.id_carnet, b.nombre, b.apellido, b.id_visitante_t, c.asunto, d.tipo from visitantes_h a, visitantes b, asuntos c, visitantes_t d where a.fecha_s='0000-00-00 00:00:00' and a.cedula=b.cedula and a.id_asunto=c.id_asunto and b.id_visitante_t=d.id_visitante_t $ls_criterio order by a.fecha_e DESC "; 
	//$sql_c = "select * from visitantes_h where fecha_s='0000-00-00 00:00:00'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
//			$procedencia=sql_mincul_corr($campo['cod_procedencia']);
//			$emisor=sql_mincul_corr($campo['cod_emisor']);
			if (empty($campo['cod_procedencia']))
				$procedencia=$campo['procedencia'];
			else
				$procedencia=sql_mincul_corr($campo['cod_procedencia']);

			if (empty($campo['cod_emisor']))
				$emisor=$campo['emisor'];
			else
				$emisor=sql_mincul_corr($campo['cod_emisor']);


			$id_correspondencia=$campo['id_correspondencia'];
			$correspondencia_t=$campo['correspondencia_t'];
			$anexo_t=$campo['anexo_t'];
//			$destino_receptor=$campo['destino_receptor'];
			$destino_nombre=$campo['destino_nombre'];
			$destino_cargo=$campo['destino_cargo'];
//			$emisor_procedencia=$campo['emisor_procedencia'];
			$emisor_nombre=$campo['emisor_nombre'];
			$emisor_cargo=$campo['emisor_cargo'];
			$fecha_r=mostrar_fecha_larga($campo['fecha_r']);
?>
		<tr>
			<td><div align="center"><?php echo $id_correspondencia?></div></td>
			<td><div align="center"><?php echo $correspondencia_t?>&nbsp;</div></td>
			<td><div align="center"><?php echo $anexo_t?>&nbsp;</div></td>
			<td><div align="center"><?php echo $procedencia?>&nbsp;</div></td>
			<td><div align="center"><?php echo $destino_nombre?>&nbsp;</div></td>
			<td><div align="center"><?php echo $destino_cargo?>&nbsp;</div></td>
			<td><div align="center"><?php echo $emisor?>&nbsp;</div></td>
			<td><div align="center"><?php echo $emisor_nombre?>&nbsp;</div></td>
			<td><div align="center"><?php echo $emisor_cargo?>&nbsp;</div></td>
			<td><div align="center"><?php echo $fecha_r?>&nbsp;</div></td>
			<td><div align="center"><a href="sca_correspondencia_m.php?id_correspondencia=<?php echo "$id_correspondencia"?>"><img src="./imagenes/m_editar.png" alt="Modificar" title="Modificar" height="16" width="16" border="0"></a></div></td>
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