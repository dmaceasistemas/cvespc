<?php 
	include("sca_precarga.php"); //Inclusion del Modulo Precarga.php
	/*Modulo de Administrador de Usuario*/
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<?php
$bgcolor_n2="";	$bgcolor="";	$id_menu="";	$color="";
/*Inicio Segunda Fila*/
/*if (!(empty($sca_id_tipo_u_menu)))
	{*/
?>
<br /><br />
<table border="0" align="center" cellpadding="20" cellspacing="0">
  <tr <?php echo $bgcolor_n2?>>
    <td>
<?php
$sql_c = "select * from menus where id_tipo_u= '$sca_id_tipo_u_menu' and no_publicado ='0' and id_menu_p='$id_menu_p' and id_menu_p<>'0' ORDER BY orden ASC"; 
$sql_c=sql_c($sql_c);
while ($campo = mysql_fetch_array ($sql_c))
	{
	$id_menu=$campo['id_menu'];
	$nombre=$campo['nombre'];
	$url=$campo['url'];
	$imagen=$campo['imagen'];
?>
	<td <?php echo $bgcolor?>><center><?php echo " "?><a href='<?php echo "$url?id_menu=$id_menu$color"?>'>
<?php
if (!(empty($imagen)))
	{
?>
	<img src="imagenes/<?php echo $imagen?>" border="0" height='<?php echo "$height_imagen"?>'><br />
<?php
	}
?>
	<?php echo $nombre?></a></center></td>
<?php 		
	}
?></td>
</tr>
</table>

<?php
	
/*Fin Segunda Fila*/
?>

<br /><br /><br />
<?php

} //Cierrre del Inicio del If
else
{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
}
?>

<?php
	include ("sca_postcarga.php");
?>
