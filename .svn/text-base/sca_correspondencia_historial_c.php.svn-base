<?php
include ("sca_precarga.php");
include ("metacalendario.php"); //Inclusión del Meta del Calendario solo se usa en el caso de usar fechas
//Modulo de Consulta de Historial de Correspondencia
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Historial de Correspondencia</b></center><br/>
<?php
//$id_correspondencia_t2="";
//$id_anexo_t2="";
$ls_criterio="";

@$id_correspondencia_t=$_REQUEST['id_correspondencia_t'];
if (!(empty($id_correspondencia_t)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_correspondencia_t='$id_correspondencia_t'";
	else
		$ls_criterio=" and a.id_correspondencia_t='$id_correspondencia_t'";
	}

@$id_anexo_t=$_REQUEST['id_anexo_t'];
if (!(empty($id_anexo_t)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_anexo_t='$id_anexo_t'";
	else
		$ls_criterio=" and a.id_anexo_t='$id_anexo_t'";
	}

@$desde=$_REQUEST['desde'];
@$hasta=$_REQUEST['hasta'];
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

@$desde_id_correspondencia=$_REQUEST['desde_id_correspondencia'];
@$hasta_id_correspondencia=$_REQUEST['hasta_id_correspondencia'];

if (!(empty($desde_id_correspondencia)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_correspondencia>='$desde_id_correspondencia'";
	else
		$ls_criterio=" and a.id_correspondencia>='$desde_id_correspondencia'";
	}
if (!(empty($hasta_id_correspondencia)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_correspondencia<='$hasta_id_correspondencia'";
	else
		$ls_criterio=" and a.id_correspondencia<='$hasta_id_correspondencia'";
	}
?>

<form name="form1" method="post" action="sca_correspondencia_historial_c.php" autocomplete="off">
<table border="1" cellpadding="2" cellspacing="0" align="center">
	<tr>
		<td height="22" class="celdas"><div align="center">Reporte</div></td>
		<td height="22" class="celdas"><div align="center">Desde Id</div></td>
		<td height="22" class="celdas"><div align="center">Hasta Id</div></td>
		<td height="22" class="celdas"><div align="center">Tipo</div></td>
		<td height="22" class="celdas"><div align="center">Anexo</div></td>
		<td height="22" class="celdas"><div align="center">Desde</div></td>
		<td height="22" class="celdas"><div align="center">Hasta</div></td>
		<td height="22" class="celdas">&nbsp;</td>
	</tr>
	<tr>
		<td><div align="center"><a href="javascript: ue_search();">Cargar</a></div></td>
		<td><div align="center"><input name="desde_id_correspondencia" type="text" size="11" maxlength="11" value="<?php echo $desde_id_correspondencia?>"></div></td>
		<td><div align="center"><input name="hasta_id_correspondencia" type="text" size="11" maxlength="11" value="<?php echo $hasta_id_correspondencia?>"></div></td>
		<td><div align="center"><select name="id_correspondencia_t">
<?php

	$sql_c = "select id_correspondencia_t, correspondencia_t  from correspondencias_t"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_correspondencia_t2=$campo['id_correspondencia_t'];
			$correspondencia_t=$campo['correspondencia_t'];
			if ($id_correspondencia_t==$id_correspondencia_t2)
				{
				echo "<option value=$id_correspondencia_t2 selected='selected'>$correspondencia_t</option>";
				}
			else
				{
				echo "<option value=$id_correspondencia_t2>$correspondencia_t</option>";
				}
			}
		}
?>
	</select></div></td>
	<td><div align="center"><select name="id_anexo_t">
<?php

	$sql_c = "select id_anexo_t, anexo_t  from anexos_t"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_anexo_t2=$campo['id_anexo_t'];
			$anexo_t=$campo['anexo_t'];
			if ($id_anexo_t==$id_anexo_t2)
				{
				echo "<option value=$id_anexo_t2 selected='selected'>$anexo_t</option>";
				}
			else
				{
				echo "<option value=$id_anexo_t2>$anexo_t</option>";
				}
			}
		}
?>
	</select></div></td>
		<td><div align="center"><input name="desde" type="text" id="campo_fecha" size="10" maxlength="10" value="<?php echo $desde ?>"/></div></td>
		<script type="text/javascript">
			Calendar.setup({
			inputField : "campo_fecha", // id del campo de texto
			ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto
			button : "lanzador" // el id del boton que lanzar el calendario
			});
		</script>
		<td><div align="center"><input name="hasta" type="text" id="campo_fecha2" size="10" maxlength="10" value="<?php echo $hasta ?>"/></div></td>
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

<?php
	$_pagi_sql = "select a.id_correspondencia, a.cod_procedencia, a.procedencia, a.destino_nombre, a.destino_cargo, a.cod_emisor, a.emisor, a.emisor_nombre, a.emisor_cargo, a.fecha_r, a.receptor_nombre, a.fecha_e, b.correspondencia_t, c.anexo_t from correspondencias a, correspondencias_t b, anexos_t c where a.id_correspondencia_t=b.id_correspondencia_t and a.id_anexo_t=c.id_anexo_t and a.receptor_nombre!='' $ls_criterio order by a.fecha_r DESC";

	//$sql_c=sql_c($sql_c);
	$_pagi_cuantos = 16;
	$_pagi_nav_num_enlaces = 10;
	$_pagi_propagar = array("desde_id_correspondencia", "hasta_id_correspondencia", "id_correspondencia_t", "id_anexo_t", "desde", "hasta");//No importa si son POST o GET
	include("lib/Paginator_v1.6.3/sca_paginator.inc.php");

	if (!(@mysql_num_rows ($_pagi_result) == 0))
		{
		echo"<p<center>Resultados ".$_pagi_info."</center></p>";
		echo "$_pagi_navegacion";
?>
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
			<td class="celdas"><div align="center">Nombre del Receptor en Destino</div></td>
			<td class="celdas"><div align="center">Fecha de Entrega en Destino</div></td>
		</tr>
<?php
		while ($campo = mysql_fetch_array ($_pagi_result))
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
			$receptor_nombre=$campo['receptor_nombre'];
			$fecha_e=mostrar_fecha_larga($campo['fecha_e']);

			//Reporte Contenido Inicio
			$html_c=$html_c."<tr>";
			$html_c=$html_c."<td style='width: 5%'>$id_correspondencia</td>";
			$html_c=$html_c."<td style='width: 5%'>$correspondencia_t&nbsp;</td>";
			$html_c=$html_c."<td style='width: 10%'>$anexo_t&nbsp;</td>";
			$html_c=$html_c."<td style='width: 11%'>$procedencia&nbsp;</td>";
			$html_c=$html_c."<td style='width: 8%'>$destino_nombre&nbsp;</td>";
			$html_c=$html_c."<td style='width: 8%'>$destino_cargo&nbsp;</td>";
			$html_c=$html_c."<td style='width: 11%'>$emisor&nbsp;</td>";
			$html_c=$html_c."<td style='width: 10%'>$emisor_nombre&nbsp;</td>";
			$html_c=$html_c."<td style='width: 8%'>$emisor_cargo&nbsp;</td>";
			$html_c=$html_c."<td style='width: 8%'>$fecha_r&nbsp;</td>";
			$html_c=$html_c."<td style='width: 8%'>$receptor_nombre&nbsp;</td>";
			$html_c=$html_c."<td style='width: 8%'>$fecha_e&nbsp;</td>";
			$html_c=$html_c."</tr>";
			//Reporte Contenido Fin

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
			<td><div align="center"><?php echo $receptor_nombre?>&nbsp;</div></td>
			<td><div align="center"><?php echo $fecha_e?>&nbsp;</div></td>
		</tr>
<?php
			}
?>
		</table>
<?php
		echo "$_pagi_navegacion";
		}
?>

<?php 
$fecha_reporte=mostrar_fecha_larga($fecha_larga);
?>

<form name="reporte" method="post" action="sca_correspondencia_historial_r.php">
<input name="html_c" type="hidden" value="<?php echo $html_c?>"/>
<input name="fecha_reporte" type="hidden" value="<?php echo $fecha_reporte?>"/>
</form>

<script language="JavaScript">

function ue_search()
{
	f=document.reporte;
  	f.submit();
}
</script>

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