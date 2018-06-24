<?php 
	include("sca_precarga.php"); //Inclusion del Modulo Precarga.php
?>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><strong>Sistema de Control de Acceso</strong></div></td>
  </tr>
</table>
<br/>

<?php
if (!(empty($sca_id_u_activo)))
	{
	//echo "<center>El usuario activo es: $sem_id_u_activo</center>";
	echo "<center>El usuario activo es: $sca_nombre_u $sca_apellido_u</center><br>";
?>
<table align="center">
<tr>
 <td align="right"><p><img src="imagenes/cambiar_clave.png" <?php echo $height_imagen?>/></p> </td>
 <td><a href="sca_usuario_clave_m.php"><div align="center">Cambiar Clave</a></div></td>
</tr>

<tr>
 <td align="right"><p><img src="imagenes/usuario.png" <?php echo $height_imagen?>/></p> </td>
 <td><a href="sca_usuario_m.php"><div align="center">Usuario</a></div></td>
</tr>
</table>
<?php
	}
else  
	{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
	}
?>
<br/>
<?php
	include ("sca_postcarga.php");
?>
