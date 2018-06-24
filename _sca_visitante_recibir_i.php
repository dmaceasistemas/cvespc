<?php
include_once ("sca_precarga.php");
/*Modulo de Inclusion de los Tipos de Visitantes*/
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
//Tabla Visitante
@$cedula=$_GET['cedula'];
@$nombre=$_GET['nombre'];
@$apellido=$_GET['apellido'];
@$telefono_movil=$_GET['telefono_movil'];
@$cod_ent=$_GET['cod_ent'];
/*@$cod_mun=$_GET['cod_mun'];
@$cod_parr=$_GET['cod_parr'];
@$cod_cp=$_GET['cod_cp'];
@$direccion=$_GET['direccion'];*/
@$id_visitante_t=$_GET['id_visitante_t'];

//Parte II Tablas detalles Visitantes
@$cod_procedencia=$_GET['cod_procedencia'];
@$procedencia=$_GET['procedencia'];
@$id_asunto=$_GET['id_asunto'];
@$cod_emisor=$_GET['cod_emisor'];
@$emisor=$_GET['emisor'];

/*Autorizacion datos*/
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
@$mydb=$_GET['mydb'];

@$observacion=$_GET['observacion'];

if ($id_visitante_t==0)
	$id_visitante_t="";
if ($id_asunto==0)
	$id_asunto="";
$arreglo_empty_v= Array ($cedula, $nombre, $apellido, $telefono_movil, $cod_ent, $id_visitante_t, $procedencia, $id_asunto,$emisor, $autorizacion_nombre); /*Nombre de la Variables en el Formulario*/
$arreglo_empty_n= Array ('Cedula', 'Nombre', 'Apellido', 'Telefono Movil', 'Entidad', 'Tipo de Visitante', 'Procedencia', 'Motivo de Visita', 'Destino', 'Autorizacion (Nombre)'); /*Nombre de la Variables en el Formulario*/
$dato=vacio($arreglo_empty_v, $arreglo_empty_n);
/*
for ($i=0; $i<count($arreglo_empty_n);$i++)
	{
	$campo_empty_v=$arreglo_empty_v[$i];
	if (empty($campo_empty_v))
		{
		if (empty($dato))
			$dato="El campo $arreglo_empty_n[$i]";
		else
			$dato="$dato, $arreglo_empty_n[$i]";
		}
	}
if (!(empty($dato)))
	$dato="$dato no deben estar en blanco";
*/
$variables="cedula=$cedula&nombre=$nombre&apellido=$apellido&telefono_movil=$telefono_movil&cod_ent=$cod_ent&id_visitante_t=$id_visitante_t&cod_procedencia=$cod_procedencia&id_asunto=$id_asunto&cod_emisor=$cod_emisor&emisor=$emisor&procedencia=$procedencia&autorizacion_nombre=$autorizacion_nombre&codper=$codper&cedper=$cedper&nomper=$nomper&apeper=$apeper&codemp=$codemp&minorguniadm=$minorguniadm&ofiuniadm=$ofiuniadm&uniuniadm=$uniuniadm&depuniadm=$depuniadm&prouniadm=$prouniadm&desuniadm=$desuniadm&mydb=$mydb&regreso=1&observacion=$observacion";
if (!(empty($dato)))
	{
	$mensaje=2;
	echo "<meta http-equiv='refresh' content='0;URL=sca_visitante_i.php?mensaje=$mensaje&dato=$dato&$variables'/>";
	}



//@$seleccion=$_POST['seleccion'];
@$url_origen=$_POST['url_origen'];
?>
<form id="form1" name="form1" method="post" action=" sca_case.php">
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
	<td class="celdas"><div align="right"><strong>Nro de Carnet</strong></div></td>
	<td><input name="id_carnet" type="text" size="11" maxlength="11"/></td>
	<td><div align="center"><input name="guardar" type="submit" value="Registrar Visitante"/></div></td>
</tr>
</table>
	<input name="cedula" type="hidden" value="<?php echo $cedula?>"/> 
	<input name="nombre" type="hidden" value="<?php echo $nombre?>"/> 
	<input name="apellido" type="hidden" value="<?php echo $apellido?>"/> 
	<input name="telefono_movil" type="hidden" value="<?php echo $telefono_movil?>"/> 
	<input name="cod_ent" type="hidden" value="<?php echo $cod_ent?>"/> 
<?php /*	<input name="cod_mun" type="hidden" value="<?php echo $cod_mun?>"/> 
	<input name="cod_parr" type="hidden" value="<?php echo $cod_parr?>"/> 
	<input name="cod_cp" type="hidden" value="<?php echo $cod_cp?>"/> 
	<input name="direccion" type="hidden" value="<?php echo $direccion?>"/> 
*/ ?>	<input name="id_visitante_t" type="hidden" value="<?php echo $id_visitante_t?>"/> 
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
	<input name="ofiuniadm" type="hidden" value="<?php echo $ofiuniadm?>"/> 
	<input name="uniuniadm" type="hidden" value="<?php echo $uniuniadm?>"/> 
	<input name="depuniadm" type="hidden" value="<?php echo $depuniadm?>"/> 
	<input name="prouniadm" type="hidden" value="<?php echo $prouniadm?>"/>
	<input name="desuniadm" type="hidden" value="<?php echo $desuniadm?>"/>  
	<input name="mydb" type="hidden" value="<?php echo $mydb?>"/>  

	<input name="observacion" type="hidden" value="<?php echo $observacion?>"/> 
	<input name="seleccion" type="hidden" value="7"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
</form>
<?php
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
	<td class="celdas"><div align="right">Destino</div></td>
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
</table>



<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td class="celdas"><div align="center"><a href="<?php echo "sca_visitante_i.php?$variables" ?>">Regresar</a></div></td>
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