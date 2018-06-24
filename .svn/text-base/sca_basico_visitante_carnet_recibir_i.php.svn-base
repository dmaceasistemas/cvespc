<?php
include_once ("sca_precarga.php");
/*Modulo de Inclusion de los Tipos de Visitantes*/
?>

<?php 
if(!(empty($sca_id_u_activo)))
	{
	//Tabla Visitante
	@$id_visitante_t=$_GET['id_visitante_t'];
	
	//Tabla visitante_h
	@$id_visitante_h=$_GET['id_visitante_h'];
	@$cod_procedencia=$_GET['cod_procedencia'];
	@$procedencia=$_GET['procedencia'];
	@$id_asunto=$_GET['id_asunto'];
	@$cod_emisor=$_GET['cod_emisor'];
	@$emisor=$_GET['emisor'];
			
	/*Autorizacion datos*/
	@$id_carnet=$_GET['id_carnet'];
	@$autorizacion_nombre=$_GET['autorizacion_nombre'];
	@$codper=$_GET['codper'];
	@$cedper=$_GET['cedper'];
	@$nomper=$_GET['nomper'];
	@$apeper=$_GET['apeper'];
	@$codemp=$_GET['codemp'];
	@$minorguniadm=$_GET['minorguniadm'];
	@$ofiuniadm=$_GET['ofiuniadm'];
	@$uniuniadm=$_GET['uniuniadm'];
	@$depuniadm=$_GET['depuniadm'];
	@$prouniadm=$_GET['prouniadm'];
	@$desuniadm=$_GET['desuniadm'];
	@$observacion=$_GET['observacion'];

//http://localhost/ng/pruebas/sca/sca_basico_visitante_carnet_recibir_i.php?id_visitante_t=2&cod_procedencia=&id_asunto=1&cod_emisor=0002&emisor=Inst.%20Adscritas%20al%20MPPC&procedencia=A&autorizacion_nombre=Juan&regreso=1&observacion=Prueba&id_carnet=654

	if ($id_visitante_t==0)
		$id_visitante_t="";
	if ($id_asunto==0)
		$id_asunto="";
	$arreglo_empty_v= Array ($id_visitante_t, $procedencia, $id_asunto, $emisor, $autorizacion_nombre); /*Nombre de la Variables en el Formulario*/
	$arreglo_empty_n= Array ('Tipo de Visitante', 'Procedencia', 'Motivo de Visita', 'Destino', 'Autorizacion (Nombre)'); /*Nombre de la Variables en el Formulario*/
	$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
	
	$variables="id_visitante_t=$id_visitante_t&cod_procedencia=$cod_procedencia&id_asunto=$id_asunto&cod_emisor=$cod_emisor&emisor=$emisor&procedencia=$procedencia&autorizacion_nombre=$autorizacion_nombre&codper=$codper&cedper=$cedper&nomper=$nomper&apeper=$apeper&codemp=$codemp&minorguniadm=$minorguniadm&ofiuniadm=$ofiuniadm&uniuniadm=$uniuniadm&depuniadm=$depuniadm&prouniadm=$prouniadm&desuniadm=$desuniadm&regreso=1&observacion=$observacion&id_carnet=$id_carnet";
	if (!(empty($dato)))
		{
		$mensaje=2;
		echo "<meta http-equiv='refresh' content='0;URL=sca_basico_visitante_carnet_i.php?mensaje=$mensaje&dato=$dato&$variables'/>";
		}
	echo $dato;
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
			//$observacion=$campo ['observacion'];
			//$id_carnet=$campo ['id_carnet']; 
			$nombre=$campo ['nombre'];
			$apellido=$campo ['apellido'];
			$telefono_movil=$campo ['telefono_movil'];
			$cod_ent=$campo['cod_ent'];
			}
		}

// Inicio Entidad
	if (!(empty ($cod_ent))) 
	{
	$sql_c = "select entidad from empcp where cod_ent = '$cod_ent'  limit 0,1"; 
	$sql_c=sql_c($sql_c);
	while ($campo = mysql_fetch_array ($sql_c))
		{
		$entidad=$campo ['entidad'];
		}
	}
// Fin Entidad
/*
//Inicio Municipio
	if ((!(empty ($cod_mun))) and (!(empty ($cod_ent)))) 
	{
	$sql_c = "select municipio from empcp where cod_ent = '$cod_ent' and cod_mun='$cod_mun' limit 0,1"; 
	$sql_c=sql_c($sql_c);
	while ($campo = mysql_fetch_array ($sql_c))
		{
		$municipio=$campo ['municipio'];
		}
	}
//Fin Municipio

//Inicio Parroquia
	if ((!(empty ($cod_parr)))and (!(empty ($cod_mun)))and(!(empty ($cod_ent))))
	{
	$sql_c = "select parroquia from empcp where cod_ent = '$cod_ent' and cod_mun='$cod_mun' and cod_parr='$cod_parr' limit 0,1"; 
	$sql_c=sql_c($sql_c);
	while ($campo = mysql_fetch_array ($sql_c))
		{
		$parroquia=$campo ['parroquia'];
		}
	}
//Fin Parroquia

//Inicio Centro Poblado
	if ((!(empty ($cod_cp)))and(!(empty ($cod_parr)))and (!(empty ($cod_mun)))and(!(empty ($cod_ent))))
	{
	$sql_c = "select centro_pob from empcp where cod_ent = '$cod_ent' and cod_mun='$cod_mun' and cod_parr='$cod_parr' and cod_cp='$cod_cp' limit 0,1"; 
	$sql_c=sql_c($sql_c);
	while ($campo = mysql_fetch_array ($sql_c))
		{
		$centro_pob=$campo ['centro_pob'];
		}
	}
//Fin Centro Poblado
*/
//Inicio Tipo de Visitante
	$sql_c = "select id_visitante_t, tipo from visitantes_t where id_visitante_t='$id_visitante_t'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$tipo_visitante=$campo ['tipo'];
			}
		}
//Fin Tipo de Visitante

//Inicio Asunto
	$sql_c = "select id_asunto, asunto from asuntos where id_asunto='$id_asunto'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$asunto=$campo ['asunto'];
			}
		}
//Fin Asunto

?>
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td colspan="2" class="celdas"><div align="center"><strong>Datos del Visitante</strong></div></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nro. de Carnet</div></td>
	<td><?php echo $id_carnet?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">C.I.</div></td>
	<td><?php echo $cedula?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Nombres</div></td>
	<td><?php echo $nombre?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Apellidos</div></td>
	<td><?php echo $apellido?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Teléfono Móvil</div></td>
	<td><?php echo $telefono_movil?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Entidad</div></td>
	<td><?php echo @$entidad?></td>
</tr>
<?php /*
<tr>
	<td class="celdas">municipio</td>
	<td><?php echo @$municipio?></td>
</tr>
<tr>
	<td class="celdas">parroquia</td>
	<td><?php echo @$parroquia?></td>
</tr>
<tr>
	<td class="celdas">centro_pob</td>
	<td><?php echo @$centro_pob?></td>
</tr>
<tr>
	<td class="celdas">direccion</td>
	<td><?php echo $direccion?></td>
</tr>*/?>
<tr>
	<td class="celdas"><div align="right">Tipo Visitante</div></td>
	<td><?php echo $tipo_visitante?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Procedencia</div></td>
	<td><?php echo $procedencia?></td>
</tr>
<?php
/*
<tr>
	<td class="celdas">cod_procedencia</td>
	<td><?php echo $cod_procedencia?></td>
</tr>
*/
?>
<tr>
	<td class="celdas"><div align="right">Motivo de Visita</div></td>
	<td><?php echo $asunto?></td>
</tr>
<tr>
	<td class="celdas"><div align="right">Emisor</div></td>
	<td><?php echo $emisor?></td>
</tr>
<?php
/*
<tr>
	<td class="celdas">cod_emisor</td>
	<td><?php echo $cod_emisor?></td>
</tr>
*/
?>
<tr>
	<td class="celdas"><div align="right">Autorización (Nombre)</div></td>
	<td><?php echo $autorizacion_nombre?></td>
</tr>
<?php
/*
<tr>
	<td class="celdas"><div align="right">cedper</div></td>
	<td><?php echo $cedper?></td>
</tr>

<tr>
	<td class="celdas">codemp</td>
	<td><?php echo $codemp?></td>
</tr>
<tr>
	<td class="celdas">minorguniadm</td>
	<td><?php echo $minorguniadm?></td>
</tr>
<tr>
	<td class="celdas">ofiuniadm</td>
	<td><?php echo $ofiuniadm?></td>
</tr>
<tr>
	<td class="celdas">uniuniadm</td>
	<td><?php echo $uniuniadm?></td>
</tr>
<tr>
	<td class="celdas">depuniadm</td>
	<td><?php echo $depuniadm?></td>
</tr>
<tr>
	<td class="celdas">prouniadm</td>
	<td><?php echo $prouniadm?></td>
</tr>

?>
<?php
	$sql_bases="SELECT desuniadm from sno_unidadadmin where codemp='$codemp' and minorguniadm='$minorguniadm' and ofiuniadm='$ofiuniadm' and uniuniadm='$uniuniadm' and depuniadm='$depuniadm' and prouniadm='$prouniadm'";
	$sql_bases=sql_bases($sql_bases);
	if (!(@mysql_num_rows ($sql_bases) == 0))
		{
		while ($row = mysql_fetch_array ($sql_bases))
			{
			@$ls_desuniadm=$row["desuniadm"];
			}
		}	
?>
<tr>
	<td class="celdas"><div align="right">desuniadm</div></td>
	<td><?php echo @$ls_desuniadm?></td>
</tr>
*/
?>

<tr>
	<td class="celdas"><div align="right">Observacion</div></td>
	<td><?php echo $observacion?></td>
</tr>
<?php
/*
<tr>
	<td class="celdas">seleccion</td>
	<td><?php echo $seleccion?></td>
</tr>
<tr>
	<td class="celdas">url_origen</td>
	<td><?php echo $url_origen?></td>
</tr>*/
?>

<form id="form1" name="form1" method="post" action=" sca_case.php">

	<input name="id_visitante_t" type="hidden" value="<?php echo $id_visitante_t?>"/> 
	<input name="id_visitante_h" type="hidden" value="<?php echo $id_visitante_h?>"/> 
	<input name="procedencia" type="hidden" value="<?php echo $procedencia?>"/> 
	<input name="cod_procedencia" type="hidden" value="<?php echo $cod_procedencia?>"/>
	<input name="id_asunto" type="hidden" value="<?php echo $id_asunto?>"/> 
	<input name="emisor" type="hidden" value="<?php echo $emisor?>"/> 
	<input name="cod_emisor" type="hidden" value="<?php echo $cod_emisor?>"/> 
	<input name="autorizacion_nombre" type="hidden" value="<?php echo $autorizacion_nombre?>"/> 
	<input name="cedper" type="hidden" value="<?php echo $cedper?>"/> 
	<input name="codper" type="hidden" value="<?php echo $codper?>"/> 
	<input name="nomper" type="hidden" value="<?php echo $nomper?>"/> 
	<input name="apeper" type="hidden" value="<?php echo $apeper?>"/> 
	<input name="codemp" type="hidden" value="<?php echo $codemp?>"/> 
	<input name="minorguniadm" type="hidden" value="<?php echo $minorguniadm?>"/> 
	<input name="ofiuniadm" type="hidden" value="<?php echo $ofiuniadm?>"/> 
	<input name="uniuniadm" type="hidden" value="<?php echo $uniuniadm?>"/> 
	<input name="depuniadm" type="hidden" value="<?php echo $depuniadm?>"/> 
	<input name="prouniadm" type="hidden" value="<?php echo $prouniadm?>"/>
	<input name="desuniadm" type="hidden" value="<?php echo $desuniadm?>"/>  
	<input name="observacion" type="hidden" value="<?php echo $observacion?>"/> 
	<input name="seleccion" type="hidden" value="31"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/>
	<input name="cedula" type="hidden" value="<?php echo $cedula?>"/> 
	
<tr><td colspan="2">
<table border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<?php /*	<td class="celdas"><div align="right"><strong>Nro de Carnet</strong></div></td>*/?>
	<td><div align="center"><input name="guardar" type="submit" value="Registrar Visitante"/></div></td>
</tr>
</table>
</form>
</tr>
</td></table>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td class="celdas"><div align="center"><a href="<?php echo "sca_basico_visitante_carnet_i.php?$variables" ?>">Regresar</a></div></td>
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