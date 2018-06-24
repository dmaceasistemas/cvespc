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
<center><b>Consulta de Visitantes B&aacute;sico Carnet</b></center><br/>
<?php
	@$id_carnet=$_POST['id_carnet'];
	$cod_ent2="";
	$id_visitante_t2="";
	$id_asunto2="";
	@$regreso=$_GET['regreso'];
	if ($regreso==1)
		{
		$id_carnet=$_GET['id_carnet'];
		$id_visitante_t2=$_GET['id_visitante_t'];
		$cod_procedencia=$_GET['cod_procedencia'];
		$id_asunto2=$_GET['id_asunto'];
		$cod_emisor=$_GET['cod_emisor'];

		$autorizacion_nombre=$_GET['autorizacion_nombre'];
		$codper=$_GET['codper'];
		$cedper=$_GET['cedper'];
		$nomper=$_GET['nomper'];
		$apeper=$_GET['apeper'];
		$codemp=$_GET['codemp'];
		$minorguniadm=$_GET['minorguniadm'];
		$ofiuniadm=$_GET['ofiuniadm'];
		$uniuniadm=$_GET['uniuniadm'];
		$depuniadm=$_GET['depuniadm'];
		$prouniadm=$_GET['prouniadm'];
		$desuniadm=$_GET['desuniadm'];

		$emisor=$_GET['emisor'];
		$procedencia=$_GET['procedencia'];
		$observacion=$_GET['observacion'];
		}


?>
<form name="form1" method="post" action="sca_basico_visitante_carnet_i.php" autocomplete="off">
<?php /*
<div align="center">
    <input name="operacion" type="hidden" id="operacion">
</div>
  <table width="300" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="300" height="20" colspan="2" class="celdas"><div align="center">Nro de Carnet</div></td>
    </tr>
  </table>
<br/>
*/?>
    <table width="300" border="0" cellpadding="2" cellspacing="0" align="center">
      <tr>
        <td height="22" width="110" class="celdas"><div align="right">Nro de Carnet</div></td>
        <td>
	<input name="id_carnet" type="text" id="id_carnet" size="11" maxlength="11" value=<?php echo "$id_carnet"?>>
        </div></td>
 	<td><div align="center"><input name="guardar" type="submit" value="Cargar"/></div></td>
      </tr>
  </table>
</form>


<?php
if (!(empty($id_carnet)))
	{
?>

<?php
	$sql_c="select a.id_visitante_h, a.fecha_e, a.fecha_s, a.observacion, a.id_carnet, b.cedula, b.nombre, b.apellido, b.telefono_movil, b.cod_ent from visitantes_h a, visitantes b where a.fecha_s='0000-00-00 00:00:00' and a.cedula=b.cedula and a.cod_procedencia='' and  a.procedencia='' and a.cod_emisor='' and a.emisor='' and a.id_carnet='$id_carnet'";
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_visitante_h=$campo['id_visitante_h'];
			$cedula=$campo['cedula'];
			$fecha_e=$campo['fecha_e'];
			$observacion=$campo ['observacion'];
			$id_carnet=$campo ['id_carnet']; 
			$nombre=$campo ['nombre'];
			$apellido=$campo ['apellido'];
			$telefono_movil=$campo ['telefono_movil'];
			$cod_ent2=$campo['cod_ent'];
			}
?>
<form id="form1" name="nuevo_emisor" method="post" action="sca_case.php" enctype="multipart/form-data" autocomplete="off">
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td colspan="2" class="celdas"><div align="center"><strong>Inclusi&oacute;n de Visitante</strong></div></td>
</tr>
<tr>
	<td class="celdas"><div align="right">C.I.</div></td>
	<td width="174"><?php echo @$cedula?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombres</div></td>
	<td><?php echo @$nombre?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Apellidos</div></td>
	<td><?php echo @$apellido?></td>
</tr><?php /*
<tr>
	<td class="celdas"><div align="right">Tel&eacute;fono Habitaci&oacute;n</div></td>
	<td><input name="telefono_hab" type="text" size="20" maxlength="100" value="<?php echo @$ls_telhabper?>"/></td>
</tr>*/	?>
<tr>
	<td class="celdas"><div align="right">Tel&eacute;fono M&oacute;vil</div></td>
	<td><?php echo @$telefono_movil?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Entidad</div></td>
<?php
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
			echo "<td>$entidad</td>";
			}
		}
	}
?>

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
*/
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

	<input name="codper" type="hidden" id="codper"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codper']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$codper.'"';?>/>

	<input name="cedper" type="hidden" id="cedper"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['cedper']).'"';?> 
	<?php if(@$_GET['regreso']==1) echo 'value="'.$cedper.'"';?>/>

	<input name="nomper" type="hidden" id="nomper"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['nomper']).'"';?> 
	<?php if(@$_GET['regreso']==1) echo 'value="'.$nomper.'"';?>/>

	<input name="apeper" type="hidden" id="apeper"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['apeper']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$apeper.'"';?>/>

	<input name="codemp" type="hidden" id="codemp"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['codemp']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$codemp.'"';?>/>

	<input name="minorguniadm" type="hidden" id="minorguniadm"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['minorguniadm']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$minorguniadm.'"';?>/>
	
	<input name="ofiuniadm" type="hidden" id="ofiuniadm"	
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['ofiuniadm']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$ofiuniadm.'"';?>/>

	<input name="uniuniadm" type="hidden" id="uniuniadm"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['uniuniadm']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$uniuniadm.'"';?>/>

	<input name="depuniadm" type="hidden" id="depuniadm"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['depuniadm']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$depuniadm.'"';?>/>

	<input name="prouniadm" type="hidden" id="prouniadm"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['prouniadm']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$prouniadm.'"';?>/>

	<input name="desuniadm" type="hidden" id="desuniadm"
	<?php if(@$_GET['ide']!="") echo 'value="'.codigoPadre($query['desuniadm']).'"';?>
	<?php if(@$_GET['regreso']==1) echo 'value="'.$desuniadm.'"';?>/>
	</td>
</tr>
<tr>
	<td class="celdas"><div align="right">Observaci&oacute;n</div></td>
	<td><textarea name="observacion" cols="50"><?php echo "$observacion";?></textarea></td>
</tr>
<tr>
	<input name="seleccion" type="hidden" value="30"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/>
	<input name="id_visitante_h" type="hidden" value="<?php echo $id_visitante_h?>"/>
	<input name="id_carnet" type="hidden" value="<?php echo $id_carnet?>"/>
	<tr><td colspan="2"><div align="center"><input name="guardar" type="submit" value="Siguiente"/></div></td></tr>
</tr>
</table>
</form>
<?php
		}
?>
</table>
<?php
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