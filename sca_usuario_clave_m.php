<?php 
	include("sca_precarga.php"); //Inclusion del Modulo Precarga.php
	/*Modulo de Usuario de Cambio de Clave*/
	conectar();
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>

<form method="post" action="sca_case.php">
<table border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" class="celdas"><div align="center"><strong>Cambio de Clave</strong></div></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right"> Usuario </div></td>
    <td width="174"><input name="id_usuario" type="text" disabled="disabled" value="<?php echo $sca_id_u_activo; ?>"/></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right">Clave Actual</div></td>
    <td><input name="clave_a" type="password" /></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right">Clave Nueva</div></td>
    <td><input name="clave_n1" type="password"/></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right"> Confirmar Clave</div></td>
    <td><input name="clave_n2" type="password"/></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input name="guardar" type="submit" value="Cambiar"/>
    </div></td>
  </tr>
</table>
<input name="seleccion" type="hidden" value="14"/>
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
