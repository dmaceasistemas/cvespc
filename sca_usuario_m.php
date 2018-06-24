<?php 
	include("sca_precarga.php"); //Inclusion del Modulo Precarga.php
	/*Modulo de Modificacion de Usuario*/
	conectar();
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<?php

	$id_usuario="";
	$nombre="";
	$apellido="";
	$sql_c="select * from usuarios where id_usuario='$sca_id_u_activo'";
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array($sql_c))
			{
			$id_usuario=$campo['id_usuario'];			
			$nombre=$campo['nombre'];
			$apellido=$campo['apellido'];
			}
		}
?>

<form method="post" action="sca_case.php">
<table border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" class="celdas"><div align="center"><strong>Datos del Usuario</strong></div></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right"> Usuario </div></td>
    <td width="174"><?php echo $sca_id_u_activo; ?></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right">Nombre</div></td>
    <td><input name="nombre" type="text" value="<?php echo $nombre; ?>"/></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right">Apellido</div></td>
    <td><input name="apellido" type="text" value="<?php echo $apellido; ?>"/></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input name="guardar" type="submit" value="Actualizar"/>
    </div></td>
  </tr>
</table>
<input name="seleccion" type="hidden" value="13"/>
<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/>
</form>
<?php
}
else  
	{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
	}
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td class="celdas"><div align="center"><a href="<?php echo 'sca_principal.php' ?>">Regresar</a></div></td>
  </tr>
</table>
<?php 
	include("sca_postcarga.php"); 
?>
