<?php
include_once ("sca_precarga.php");
/*Modulo de Inclusion de Correspondencia*/
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
@$id_anexo_t2=$_GET['id_anexo_t'];
@$id_correspondencia_t2=$_GET['id_correspondencia_t'];
@$cod_procedencia=$_GET['cod_procedencia'];
@$procedencia=$_GET['procedencia'];
@$destino_nombre=$_GET['destino_nombre'];
@$destino_cargo=$_GET['destino_cargo'];
@$cod_emisor=$_GET['cod_emisor'];
@$emisor=$_GET['emisor'];
@$emisor_nombre=$_GET['emisor_nombre'];
@$emisor_cargo=$_GET['emisor_cargo'];
@$regreso=$_GET['regreso'];


?>
<form id="form1" name="nuevo_emisor" method="post" action=" sca_case.php" enctype="multipart/form-data" autocomplete="off">
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td colspan="2" class="celdas"><div align="center"><strong>Inclusi&oacute;n de Correspondencia</strong></div></td>
</tr>
<tr>
        <td  width="100" class="celdas"><div align="right">Tipo</div></td>
        <td><select name="id_correspondencia_t">
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
</tr>
<tr>
        <td class="celdas"><div align="right">Anexo</div></td>
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
	</select></td>
</tr>

<tr><td class="celdas" colspan="2"><div align="center"><b>Destino</b></div></td></tr>
<tr>
	<td class="celdas"><div align="right">Receptor</div></td>
	<td width="350">
	<input name="procedencia" type="text" class="texto_descripcion" id="procedencia" size="35"<?php if(@$_GET['ide']!="") echo 'value="'.nombrePadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$procedencia.'"';?>/>
	<a href="javascript: lanzarSubmenu('arbol/p_arbol_emisores.php?id_accion=12&amp;des=2')" > <img src="arbol/img/xhtml_go.png" width="16" height="16" border="0" />
	<input name="cod_procedencia" type="hidden" id="cod_procedencia"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$cod_procedencia.'"';?>/></a>
	</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombre</div></td>
	<td width="174"><input name="destino_nombre" type="text" value="<?php echo $destino_nombre?>" size="35" /> </td>
</tr>
<tr>
	<td class="celdas"><div align="right">Cargo</div></td>
	<td width="174"><input name="destino_cargo" type="text" value="<?php echo $destino_cargo?>" size="35" /> </td>
</tr>

<tr><td class="celdas" colspan="2"><div align="center"><b>Emisor</b></div></td></tr>
<tr>
	<td class="celdas"><div align="right">Emisor&nbsp;</div></td>
	<td width="350">
	<input name="emisor" type="text" class="texto_descripcion" id="emisor" size="35"<?php if(@$_GET['ide']!="") echo 'value="'.nombrePadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$emisor.'"';?>/>
	<a href="javascript: lanzarSubmenu('arbol/p_arbol_emisores.php?id_accion=12&amp;corr_emi=1', 400, 400)" > <img src="arbol/img/xhtml_go.png" width="16" height="16" border="0" />
	<input name="cod_emisor" type="hidden" id="cod_emisor"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$cod_emisor.'"';?>/></a>
	</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombre</div></td>
	<td width="174"><input name="emisor_nombre" type="text" value="<?php echo $emisor_nombre?>" size="35" /> </td>
</tr>
<tr>
	<td class="celdas"><div align="right">Cargo</div></td>
	<td width="174"><input name="emisor_cargo" type="text" value="<?php echo $emisor_cargo?>" size="35" /> </td>
</tr>

<tr>
	<input name="seleccion" type="hidden" value="21"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	<tr><td colspan="2"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div></td></tr>
</tr>
</table>
</form>

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