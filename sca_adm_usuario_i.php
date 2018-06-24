<?php
include ("sca_precarga.php");
/*Modulo Usuarios Registro*/
conectar();
?>

<?php 
if(!(empty($sca_id_u_activo)))
{
?>

<?php
@$nombre=$_GET['nombre'];
@$apellido=$_GET['apellido'];
@$id_tipo_u=$_GET['id_tipo_u'];
?>
<form id="form1" name="form1" method="post" action="sca_case.php">
      <table border="1" align="center" cellpadding="2" cellspacing="0">
      <tr>
       <td colspan="2" class="celdas"><div align="center"><strong>Inclusi&oacute;n de Usuario</strong></div></td>
      </tr>
      <tr>
        <td class="celdas"><div align="right"> Id_usuario </div></td>
        <td width="174"><input name="id_usuario" type="text" size="20" maxlength="100" value="<?php echo @$id_usuario?>"/></td>
      </tr>
      <tr>
	  <td class="celdas"><div align="right">Nombre </div></td>
      <td><input name="nombre" type="text" size="20" value="<?php echo $nombre?>"/> </td>
	  </tr>  
      <tr> <td class="celdas"><div align="right">Apellido</div></td>
       <td> <input name="apellido" type="text" size="20" value="<?php echo $apellido?>"/></td>
      </tr>
	<tr>
        <td class="celdas"><div align="right">Contrase&ntilde;a</div></td>
        <td><input name="clave1" type="password" size="20"/></td>
      </tr>
	<tr>
        <td class="celdas"><div align="right">Repita Contrase&ntilde;a</div></td>
        <td><input name="clave2" type="password" size="20"/></td>
      </tr>
      <tr>
	  <td class="celdas"><div align="right">Tipo de Usuario </div></td>
	<td><select name="id_tipo_u">
<?php 
//	echo "<option>--Tipo de Usuario--</option>";
	$sql_c = "select * from usuarios_t"; 
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_tipo_u=$campo ['id_tipo_u'];
			$nombre=$campo['nombre'];
			echo "<option value='$id_tipo_u'>$nombre</option>";
			}
		}
?>
	</select></td></tr>
<tr>
	<td colspan="2"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div>
	<input name="seleccion" type="hidden" value="10"/>
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/></td>
</tr>
</table>
</form>

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
