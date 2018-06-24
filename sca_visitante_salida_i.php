<?php
include ("sca_precarga.php");
/*Modulo de Consulta de salida de Personal*/
//conectar();
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>

<center><b>Registro de Salida de Visitantes</b></center></br>

<?php
	@$id_carnet=$_GET['id_carnet'];
?>
<form name="form1" method="post" action="sca_case.php" autocomplete="off">
<table border="0" cellpadding="2" cellspacing="0" align="center">
      <tr>
        <td height="22" width="110" class="celdas"><div align="right">Nro de Carnet</div></td>
        <td>
	<input name="seleccion" type="hidden" value="26"/> 
	<input name="id_carnet" type="text" size="11" maxlength="11" value=<?php echo "$id_carnet"?>>
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/>
        </div></td>
 	<td><div align="center"><input name="Buscar" type="submit" value="Buscar"/></td></div>
</td>
      </tr>
  </table>
</form>

<?php
if (!(empty($id_carnet)))
	{
?>

<?php
	$sql_c = "select a.id_visitante_h, a.cedula, a.cod_procedencia, a.procedencia, a.cod_emisor, a.emisor, a.fecha_e, a.fecha_s, a.id_asunto, a.observacion, a.id_carnet, b.nombre, b.apellido, b.id_visitante_t, c.asunto, d.tipo from visitantes_h a, visitantes b, asuntos c, visitantes_t d where a.fecha_s='0000-00-00 00:00:00' and a.cedula=b.cedula and a.id_asunto=c.id_asunto and b.id_visitante_t=d.id_visitante_t and a.id_carnet='$id_carnet'"; 
	//$sql_c = "select * from visitantes_h where fecha_s='0000-00-00 00:00:00'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
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
<?php /*	<td class="celdas"><div align="center">fecha_s</div></td>	*/?>
	<td class="celdas"><div align="center">Asunto</div></td>
	<td class="celdas"><div align="center">Observacion</div></td>
	<td class="celdas"><div align="center">Nro de Carnet</div></td>	

<?php /*	<td class="celdas"><div align="center">Telefono Movil</div></td>	*/?>
<?php /*	<td class="celdas" colspan="2"><div align="center">&nbsp;</div></td>	*/?>
</tr>
<?php
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

			$fecha_e=$campo['fecha_e'];
			$fecha_s=$campo['fecha_s'];
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
<?php /*		<td><div align="center"><?php echo $fecha_s?>&nbsp;</div></td>	*/?>
			<td><div align="center"><?php echo $asunto?>&nbsp;</div></td>
			<td><div align="center"><?php echo $observacion?>&nbsp;</div></td>
			<td><div align="center"><?php echo $id_carnet?>&nbsp;</div></td>
		</tr>
<?php
			}
?>
</table>

<br/>
<form name="form1" method="post" action="sca_case.php" autocomplete="off">
<table border="0" cellpadding="2" cellspacing="0" align="center">
      <tr>
  	<td><div align="center"><input name="salida" type="submit" value="Registrar Salida"/></div>
	<input name="seleccion" type="hidden" value="8"/> 
	<input name="fecha_s" type="hidden" value="<?php echo $fecha_larga ?>"/>
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/>
	<input name="id_carnet" type="hidden" value="<?php echo $id_carnet?>"/>
</td>
      </tr>
  </table>
</form>
<?php
		}
	}
}
else  
	{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
	}
?>

<?php
include ("sca_postcarga.php");
?>