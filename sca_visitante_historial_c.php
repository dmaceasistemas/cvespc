<?php
//Modulos SCA Historial de Visitantes
include ("sca_precarga.php");
include ("metacalendario.php"); //Inclusi�n del Meta del Calendario solo se usa en el caso de usar fechas
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Historial de Visitas</b></center><br/>
<?php
//$id_visitante_t2="";
//$id_asunto2="";
$ls_criterio="";
@$id_carnet=$_REQUEST['id_carnet'];
if (!(empty($id_carnet)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_carnet='$id_carnet'";
	else
		$ls_criterio=" and a.id_carnet='$id_carnet'";
	}

@$cedula=$_REQUEST['cedula'];
if (!(empty($cedula)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.cedula='$cedula'";
	else
		$ls_criterio=" and a.cedula='$cedula'";
	}

@$id_visitante_t=$_REQUEST['id_visitante_t'];
if (!(empty($id_visitante_t)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and b.id_visitante_t='$id_visitante_t'";
	else
		$ls_criterio=" and b.id_visitante_t='$id_visitante_t'";
	}

@$id_asunto=$_REQUEST['id_asunto'];
if (!(empty($id_asunto)))
	{
	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.id_asunto='$id_asunto'";
	else
		$ls_criterio=" and a.id_asunto='$id_asunto'";
	}

@$desde=$_REQUEST['desde'];
@$hasta=$_REQUEST['hasta'];
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
	$hasta_c="$hasta_c 99:99:99";	if (!(empty($ls_criterio)))
		$ls_criterio="$ls_criterio and a.fecha_e<='$hasta_c'";
	else
		$ls_criterio=" and a.fecha_e<='$hasta_c'";
	}
//$sql_where="&id_carnet=$id_carnet&cedula=$cedula&id_visitante_t=$id_visitante_t2&id_asunto=$id_asunto2&desde=$desde&hasta=$hasta&buscar=Buscar";
?>

<form name="form1" method="post" action="sca_visitante_historial_c.php" autocomplete="off">
<table border="1" cellpadding="2" cellspacing="0" align="center">
	<tr>
		<td height="22" class="celdas"><div align="center">Reporte</div></td>
		<td height="22" class="celdas"><div align="center">Nro de Carnet</div></td>
		<td height="22" class="celdas"><div align="center">Cedula</div></td>
		<td height="22" class="celdas"><div align="center">Tipo de Visitante</div></td>
		<td height="22" class="celdas"><div align="center">Asunto</div></td>
		<td height="22" class="celdas"><div align="center">Desde</div></td>
		<td height="22" class="celdas"><div align="center">Hasta</div></td>
		<td height="22" class="celdas">&nbsp;</td>
	</tr>
	<tr>
		<td><div align="center"><a href="javascript: ue_search();">Cargar</a></div></td>
		<td><div align="center"><input name="id_carnet" type="text" size="3" maxlength="11" value="<?php echo $id_carnet?>"></div></td>
		<td><div align="center"><input name="cedula" type="text" size="8" maxlength="11" value="<?php echo $cedula?>"></div></td>
		<td><div align="center"><select name="id_visitante_t">
<?php
		$sql_c = "select id_visitante_t, tipo from visitantes_t"; 

		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$id_visitante_t2=$campo ['id_visitante_t'];
				$tipo=$campo ['tipo'];
				if ($id_visitante_t==$id_visitante_t2)
					{
					echo "<option value=$id_visitante_t2 selected='selected'>$tipo</option>";
					}
				else
					{
					echo "<option value=$id_visitante_t2>$tipo</option>";
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
				$id_asunto2=$campo ['id_asunto'];
				$asunto=$campo ['asunto'];
				if ($id_asunto==$id_asunto2)
					{
					echo "<option value=$id_asunto2 selected='selected'>$asunto</option>";
					}
				else
					{
					echo "<option value=$id_asunto2>$asunto</option>";
					}
				}
			}
?>
		</select></div></td>
		<td><div align="center"><input name="desde" type="text" id="campo_fecha" size="10" maxlength="10"  value="<?php echo $desde ?>"/></div></td>
		<script type="text/javascript">
			Calendar.setup({
			inputField : "campo_fecha", // id del campo de texto
			ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto
			button : "lanzador" // el id del boton que lanzar el calendario
			});
		</script>
		<td><div align="center"><input name="hasta" type="text" id="campo_fecha2" size="10" maxlength="10"  value="<?php echo $hasta ?>"/></div></td>
		<script type="text/javascript">
			Calendar.setup({
			inputField : "campo_fecha2", // id del campo de texto
			ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto
			button : "lanzador" // el id del boton que lanzar el calendario
			});
		</script>
		<td><div align="center">
			<input name="buscar" type="submit" value="Buscar"/>
			<input name="_pagi_pg" type="hidden" value="<?php echo $_GET['_pagi_pg']?>"/> 
		</div></td>
	</tr>
  </table>
</form>

<?php
$_pagi_sql = "select a.id_visitante_h, a.cedula, a.cod_procedencia, a.procedencia, a.cod_emisor, a.emisor, a.fecha_e, a.fecha_s, a.id_asunto, a.observacion, a.id_carnet, b.nombre, b.apellido, b.id_visitante_t, c.asunto, d.tipo, e.autorizacion_nombre from visitantes_h a, visitantes b, asuntos c, visitantes_t d, visitantes_a e where a.cedula=b.cedula and a.id_asunto=c.id_asunto and b.id_visitante_t=d.id_visitante_t and a.id_visitante_h=e.id_visitante_h $ls_criterio and a.fecha_s<>'0000-00-00 00:00:00' order by a.fecha_s DESC"; 

//cantidad de resultados por p�gina (opcional, por defecto 20)
$_pagi_cuantos = 40;
$_pagi_nav_num_enlaces = 10;
$_pagi_propagar = array("id_carnet", "cedula", "id_visitante_t", "id_asunto", "desde", "hasta");//No importa si son POST o GET


//Incluimos el script de paginaci�n. �ste ya ejecuta la consulta autom�ticamente
include("lib/Paginator_v1.6.3/sca_paginator.inc.php");


//Leemos y escribimos los registros de la p�gina actual
if (!(@mysql_num_rows ($_pagi_result) == 0))
	{
	echo"<p<center>Resultados ".$_pagi_info."</center></p>";

	//Resultados 1 - 20 de 79 Registros
	echo "$_pagi_navegacion";
?>
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
	<td class="celdas"><div align="center">Fecha de Salida</div></td>	
	<td class="celdas"><div align="center">Asunto</div></td>
	<td class="celdas"><div align="center">Nombre (Autorizacion Ingreso)</div></td>
	<td class="celdas"><div align="center">Observacion</div></td>
	<td class="celdas"><div align="center">Nro de Carnet</div></td>	
<?php
	while($campo = mysql_fetch_array($_pagi_result))
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

//		$procedencia=sql_mincul_corr($campo['cod_procedencia']);
//		$emisor=sql_mincul_corr($campo['cod_emisor']);
		$fecha_e=mostrar_fecha_larga($campo['fecha_e']);
		$fecha_s=mostrar_fecha_larga($campo['fecha_s']);
		$asunto=$campo['asunto'];
		$observacion=$campo ['observacion'];
		$id_carnet=$campo ['id_carnet']; 
		$autorizacion_nombre=$campo['autorizacion_nombre'];

		$nombre=$campo ['nombre'];
		$apellido=$campo ['apellido'];
//		$telefono_movil=$campo ['telefono_movil'];
		$tipo=$campo ['tipo'];
		
		//Reporte Contenido Inicio
		$html_c=$html_c."<tr>";
		$html_c=$html_c."<td style='width: 8%'>$cedula</td>";
		$html_c=$html_c."<td style='width: 10%'>$apellido&nbsp;</td>";
		$html_c=$html_c."<td style='width: 10%'>$nombre&nbsp;</td>";
		$html_c=$html_c."<td style='width: 10%'>$tipo&nbsp;</td>";
		$html_c=$html_c."<td style='width: 11%'>$procedencia&nbsp;</td>";
		$html_c=$html_c."<td style='width: 11%'>$emisor&nbsp;</td>";
		$html_c=$html_c."<td style='width: 7%'>$fecha_e&nbsp;</td>";
		$html_c=$html_c."<td style='width: 7%'>$fecha_s&nbsp;</td>";
		$html_c=$html_c."<td style='width: 10%'>$asunto&nbsp;</td>";
		$html_c=$html_c."<td style='width: 10%'>$observacion&nbsp;</td>";
		$html_c=$html_c."<td style='width: 6%'>$id_carnet&nbsp;</td>";
		$html_c=$html_c."</tr>";
		//Reporte Contenido Fin
?>
	<tr>
		<td><div align="center"><?php echo $cedula?>&nbsp;</div></td>
		<td><div align="center"><?php echo $apellido?>&nbsp;</div></td>
		<td><div align="center"><?php echo $nombre?>&nbsp;</div></td>
		<td><div align="center"><?php echo $tipo?>&nbsp;</div></td>
		<td><div align="center"><?php echo $procedencia?>&nbsp;</div></td>
		<td><div align="center"><?php echo $emisor?>&nbsp;</div></td>
		<td><div align="center"><?php echo $fecha_e?>&nbsp;</div></td>
		<td><div align="center"><?php echo $fecha_s?>&nbsp;</div></td>
		<td><div align="center"><?php echo $asunto?>&nbsp;</div></td>
		<td><div align="center"><?php echo $autorizacion_nombre?>&nbsp;</div></td>
		<td><div align="center"><?php echo $observacion?>&nbsp;</div></td>
		<td><div align="center"><?php echo $id_carnet?>&nbsp;</div></td>
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

<form name="reporte" method="post" action="sca_visitante_historial_r.php">
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