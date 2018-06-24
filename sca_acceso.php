<?php
include ("sca_precarga.php");
?>

<?php
if (!(empty($sca_id_u_activo)))
	{
	$url_index2='http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) .'/sca_principal.php';//Captacion del URL del Servidor
	$_SESSION['dato']="Usuario Conectado";
	$_SESSION['mensaje']=1;
	echo "<meta http-equiv='refresh' content='0;URL=$url_index2'/>";//Meta para ir a la pagina del Incluir
	}
else
	{
?>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div align="center"><b>Sistema de Control de Acceso y Correspondencia</b><br>
        <br></div></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="sca_case.php">
<table border="0" align="center" cellpadding="1" cellspacing="2">
<!--  <tr>
    <td colspan="2"><div align="center">Acceso</div></td>
  </tr>-->
  <tr>
    <td class="celdas"><div align="center">Usuario</div></td>
    <td><input name="id_usuario" type="text" id="id_usuario" /></td>
  </tr>
  <tr>
    <td width="90" class="celdas"><div align="center">Contrase&ntilde;a</div></td>
    <td><input name="clave" type="password"/></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="Submit" value="Entrar" />
	  <input name="url_origen" type="hidden" value="<?php echo $url_origen ?>"/>
      <input name="seleccion" type="hidden" value="9" />
    </div></td>
    </tr>
</table>
</form>
</td>
  </tr>
</table>
<?php
	}
?>

<?php
include ("sca_postcarga.php");
?>
