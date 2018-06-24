<?php
include_once ("sca_precarga.php");
/*Modulo de Inclusion de Visitantes Basico*/
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
$id_visitante_t2="";

include_once("sca_sno_funcion_c.php");

@$regreso=$_GET['regreso'];
if ($regreso==1)
	{
	$ls_cedper=$_GET['cedula'];
	$ls_nomper=$_GET['nombre'];
	$ls_apeper=$_GET['apellido'];
	$ls_telmovper=$_GET['telefono_movil'];
	$cod_ent2=$_GET['cod_ent'];
	//$id_visitante_t2=$_GET['id_visitante_t'];
	$observacion=$_GET['observacion'];
	}
?>
<form id="form1" name="nuevo_emisor" method="post" action="sca_case.php" enctype="multipart/form-data" autocomplete="off">
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td colspan="2" class="celdas"><div align="center"><strong>Inclusi&oacute;n de Visitante B&aacute;sico</strong></div></td>
</tr>
<tr>
	<td class="celdas"><div align="right">C.I.</div></td>
	<td width="174"><input name="cedula" type="text" size="20" value="<?php echo @$ls_cedper?>"/> </td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombres</div></td>
	<td><input name="nombre" type="text" size="20" maxlength="100" value="<?php echo @$ls_nomper?>"/></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Apellidos</div></td>
	<td><input name="apellido" type="text" size="20" maxlength="100" value="<?php echo @$ls_apeper?>"/></td>
</tr><?php /*
<tr>
	<td class="celdas"><div align="right">Tel&eacute;fono Habitaci&oacute;n</div></td>
	<td><input name="telefono_hab" type="text" size="20" maxlength="100" value="<?php echo @$ls_telhabper?>"/></td>
</tr>*/	?>
<tr>
	<td class="celdas"><div align="right">Tel&eacute;fono M&oacute;vil</div></td>
	<td><input name="telefono_movil" type="text" size="20" maxlength="100" value="<?php echo  @$ls_telmovper?>"/></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Entidad</div></td>
	<td><select name="cod_ent">
	<option value="0">seleccione...</option>
<?php
//	$cod_ent2="";
	for ($i=1;$i<=25;$i++)
	{
		if ($i<10)
		{
			$i= "0$i";
		}
	$sql_c= "select cod_ent, entidad from empcp where cod_ent = '$i'  limit 0,1"; 
	$sql_c=sql_c($sql_c);
	while ($campo = mysql_fetch_array ($sql_c))
		{
		$cod_ent=$campo['cod_ent'];
		$entidad=$campo ['entidad'];
		if ($cod_ent==$cod_ent2)
			{
?>
		<option value="<?php echo $cod_ent;?>" selected="selected"><?php echo $entidad;?></option>
<?php
			}
		else
			{
?>		
			<option value="<?php echo $cod_ent;?>"><?php echo $entidad;?></option>
<?php
			}
		}
	}
?>
	</select></td>
</tr>
<?php
/*
<tr>
<td class="celdas"><div align="right">Municipio</div></td>
    <td><div id="div_muni">
    <select name="municipio">
        <option value="0" selected="selected">seleccione...</option>
    </select>
    </div></td>
</tr>
<tr>
<td class="celdas"><div align="right">Parroquia</div></td>
    <td><div id="div_parro">
    <select name="parroquia" onChange="act_parroquia(this.value)">
        <option value="0">seleccione...</option>
    </select>
    </div></td>
</tr>
<tr>
<td class="celdas"><div align="right">Centro Poblado</div></td>
    <td><div id="div_cp">
    <select name="cod_cp" onChange="act_cp(this.value)">
        <option value="0">seleccione...</option>
    </select>
    </div></td>
</tr> 
<tr>
	<td class="celdas"><div align="right">Direcci&oacute;n</div></td>
	<td><textarea name="direccion" cols="50"><?php echo @$ls_dirper?></textarea></td>
</tr>

?>
<tr>
        <td class="celdas"><div align="right">Tipo de Visitante</div></td>
        <td><select name="id_visitante_t">
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
	</select></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Procedencia&nbsp;</div></td>
	<td width="350">
	<input name="procedencia" type="text" class="texto_descripcion" id="procedencia" size="35"<?php if(@$_GET['ide']!="") echo 'value="'.nombrePadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$procedencia.'"';?>/>
	<a href="javascript: lanzarSubmenu('arbol/p_arbol_emisores.php?id_accion=12&amp;int=1')" > <img src="arbol/img/xhtml_go.png" width="16" height="16" border="0" />
	<input name="cod_procedencia" type="hidden" id="codigo_procedencia"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$cod_procedencia.'"';?>/></a>
	</td>
</tr>


<tr><td class="celdas" colspan="2"><div align="center"><b>Datos Destino</b></div></td></tr>
<tr>
        <td class="celdas"><div align="right">Motivo Visita</div></td>
        <td><select name="id_asunto">
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
	</select></td>
</tr>

<tr>
	<td class="celdas"><div align="right">Destino&nbsp;</div></td>
	<td width="350">
	<input name="emisor" type="text" class="texto_descripcion" id="emisor" size="35"<?php if(@$_GET['ide']!="") echo 'value="'.nombrePadre($query['codigo']).'"';?>  <?php if(@$_GET['regreso']==1) echo 'value="'.$emisor.'"';?>/>
	<a href="javascript: lanzarSubmenu('arbol/p_arbol_emisores.php?id_accion=12&amp;des=1', 400, 400)" > <img src="arbol/img/xhtml_go.png" width="16" height="16" border="0" />
	<input name="cod_emisor" type="hidden" id="codigo_emisor"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codigo']).'"';?> <?php if(@$_GET['regreso']==1) echo 'value="'.$cod_emisor.'"';?> /></a>
	</td>
</tr>

<tr><td class="celdas" colspan="2"><div align="center"><b>Autorización de Ingreso</b></div></td></tr>
<tr>
	<td class="celdas"><div align="right">Nombre&nbsp;</div></td>
	<td><input name="autorizacion_nombre" type="text" size="35" maxlength="100" <?php if(@$_GET['ide']!="") echo 'value="'.nombrePadre($query['autorizacion_nombre']).'"';?><?php if(@$_GET['regreso']==1) echo 'value="'.$autorizacion_nombre.'"';?>/>
	<a href="javascript: lanzarSubmenu('sca_sno_personal_unidad_administrativa_c.php', 750, 600)" > <img src="imagenes/buscar.gif" width="16" height="16" border="0" /></a>

	<input name="codper" type="hidden" id="codper"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codper']).'"';?> />
	<input name="cedper" type="hidden" id="cedper"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['cedper']).'"';?> />
	<input name="codemp" type="hidden" id="codemp"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codemp']).'"';?> />
	<input name="minorguniadm" type="hidden" id="minorguniadm"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['minorguniadm']).'"';?> />
	<input name="ofiuniadm" type="hidden" id="ofiuniadm"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['ofiuniadm']).'"';?> />
	<input name="uniuniadm" type="hidden" id="uniuniadm"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['uniuniadm']).'"';?> />
	<input name="depuniadm" type="hidden" id="depuniadm"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['depuniadm']).'"';?> />
	<input name="prouniadm" type="hidden" id="prouniadm"<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['prouniadm']).'"';?> />
	</td>
</tr>
*/
?>
<tr>
	<td class="celdas"><div align="right">Observaci&oacute;n</div></td>
	<td><textarea name="observacion" cols="50"><?php if(@$_GET['regreso']==1) echo "$observacion";?></textarea></td>
</tr>
<tr>
	<input name="seleccion" type="hidden" value="28"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	<tr><td colspan="2"><div align="center"><input name="guardar" type="submit" value="Siguiente"/></div></td></tr>
</tr>
</table>
</form>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td class="celdas"><div align="center"><a href="<?php echo 'sca_basico_sno_personalnomina_c.php' ?>">Regresar</a></div></td>
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