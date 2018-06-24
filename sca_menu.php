<?php /*Inicio Primera Fila*/?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<?php
@$id_menu_p=$_GET['id_menu'];
conectar ();
$height_imagen="";
//$height_imagen="height='64'";
$sql_c = "select * from menus where no_publicado ='0' and id_tipo_u='$sca_id_tipo_u_menu' and id_menu_p='0' ORDER BY orden ASC"; 
$sql_c=sql_c($sql_c);
while ($campo = mysql_fetch_array ($sql_c))
	{
	$id_menu=$campo['id_menu'];
	$nombre_menu=$campo['nombre'];
	$url_menu=$campo['url'];
	$imagen_menu=$campo['imagen'];
?>
<td align='center'><a href='<?php echo "$url_menu?id_menu=$id_menu"?>'>
<?php
if (!(empty($imagen_menu)))
	{
?>
	<img src="imagenes/<?php echo $imagen_menu ?>" <?php echo "$height_imagen"?> border="0"/>
<?php
	}
?>
</a><?php /*</td>
<td>*/?><br/><a href='<?php echo "$url_menu?id_menu=$id_menu"?>'><?php echo $nombre_menu?></a></td>
<?php 	
	}
//Ideal para el logeo y deslogeo de los usuarios
if (!(empty($sca_id_u_activo)))
	{
//	echo "<td align='right'><a href='#'><img src='imagenes/user.png' height='sca_usu_m.php' border='0'/></a></td>";
//	echo "<td><a href='sca_usu_m.php'>$sca_nombre_u $sca_apellido_u</td></a>";
	//echo "<td>  | <a href='sca_case.php?seleccion=x'>$sca_nombre_u $sca_apellido_u</a></td>";
	echo "<td align='center'><a href='sca_case.php?seleccion=x'><img src='imagenes/cerrar.png' $height_imagen 'sca_case.php?seleccion=x' border='0'/></a>";
	echo "<br/><a href='sca_case.php?seleccion=x'>Cerrar Sesi&oacute;n</a></td>";
	}
else
	{
	$url_actual = end(explode('/', $url_origen));
	if ($url_actual!="sca_acceso.php")
		{
?>
		<td align='right'><a href='<?php echo "sca_acceso.php"?>' border="0"/>Identificarse</a>
<?php
		}
	}
?>
</tr>
</table>
<?php /*Fin Primera Fila*/?>
<?php linea();?>