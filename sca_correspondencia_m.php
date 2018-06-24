<?php
include ("sca_precarga.php");
/*Modulo de Modificacion de las Tipo de Anexos*/
conectar();
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<center><b>Actualización Correspondencia</b></center><br/>
<?php
	@$id_correspondencia=$_GET['id_correspondencia'];
	if (!(empty($id_correspondencia)))
		{
		$sql_c = "select a.id_correspondencia, a.cod_procedencia, a.procedencia, a.destino_nombre, a.destino_cargo, a.cod_emisor, a.emisor, a.emisor_nombre, a.emisor_cargo, a.fecha_r, a.receptor_nombre, b.correspondencia_t, c.anexo_t from correspondencias a, correspondencias_t b, anexos_t c where a.id_correspondencia_t=b.id_correspondencia_t and a.id_anexo_t=c.id_anexo_t and a.id_correspondencia='$id_correspondencia'";
		$sql_c=sql_c($sql_c);
		
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
//				$procedencia=sql_mincul_corr($campo['cod_procedencia']);
//				$emisor=sql_mincul_corr($campo['cod_emisor']);
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
				$fecha_r=$campo['fecha_r'];
				$receptor_nombre=$campo['receptor_nombre'];
				}
			}
		}
?>
<form id="form1" name="nuevo_emisor" method="post" action=" sca_case.php" enctype="multipart/form-data" autocomplete="off">
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td colspan="2" class="celdas"><div align="center"><strong>Inclusi&oacute;n de Correspondencia</strong></div></td>
</tr>
<tr>
        <td  width="100" class="celdas"><div align="right">Tipo</div></td>
        <td><?php echo $correspondencia_t ?>&nbsp;</td>
</tr>
<tr>
        <td class="celdas"><div align="right">Anexo</div></td>
        <td><?php echo $anexo_t ?>&nbsp;</td>
</tr>

<tr><td class="celdas" colspan="2"><div align="center"><b>Destino</b></div></td></tr>

<tr>
	<td class="celdas"><div align="right">Receptor</div></td>
	<td width="350"><?php echo $procedencia ?>&nbsp;</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombre</div></td>
	<td><?php echo $destino_nombre ?>&nbsp;</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Cargo</div></td>
	<td><?php echo $destino_cargo ?>&nbsp;</td>
</tr>

<tr><td class="celdas" colspan="2"><div align="center"><b>Emisor</b></div></td></tr>
<tr>
	<td class="celdas"><div align="right">Destino&nbsp;</div></td>
	<td width="350"><?php echo $emisor?>&nbsp;</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombre</div></td>
	<td><?php echo $emisor_nombre ?>&nbsp;</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Cargo</div></td>
	<td><?php echo $emisor_cargo ?>&nbsp;</td>
</tr>


<tr><td class="celdas" colspan="2"><div align="center"><b>Entrega en el Destino</b></div></td></tr>
<tr>
	<td class="celdas"><div align="right">Nombre de Receptor</div></td>
	<td><input name="receptor_nombre" type="text" size="50" value="<?php echo @$receptor_nombre?>"/></td>
</tr>
<?php	/*
<tr>
	<td class="celdas"><div align="right">Fecha</div></td>
	<td><input name="anexo_t" type="text"/></td>
</tr>
*/?>
	<tr><td colspan="2">
	<input name="fecha_e" type="hidden" value="<?php echo $fecha_larga?>"/> 
	<div align="center"><input name="actualizar" type="submit" value="Guardar"/></div>
	<input name="seleccion" type="hidden" value="22"/>
	<input name="id_correspondencia" type="hidden" value="<?php echo $id_correspondencia?>"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	</td></tr>
</table>
</form>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td class="celdas"><div align="center"><a href="<?php echo 'sca_correspondencia_c.php' ?>">Regresar</a></div></td>
    </tr>
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