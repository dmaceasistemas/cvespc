<?php
include ("sca_precarga.php");
/*Modulo de Administrador de Usuarios Modificacion*/
conectar();
?>

<?php 
if((!(empty($sca_id_u_activo)))and ($sca_id_tipo_u_menu==2))
{
?>

<?php
@$id_usuario2=$_REQUEST['id_usuario'];
?>
<form id="form1" name="form1" method="GET" action="">

<table border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
      <td>Id Usuarios</td>
      <td><select name="id_usuario" onchange = "this.form.submit()">
<?php
		echo "<option value='$url_origen'></option>";
		$sql_c ="select * from usuarios";
		$sql_c = sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array($sql_c))
				{
				$id_usuario_tabla=$campo['id_usuario'];
				if ($id_usuario_tabla==$id_usuario2)
					echo "<option value='$id_usuario_tabla' selected='selected'>$id_usuario_tabla</option>";
				else
					echo "<option value='$id_usuario_tabla'>$id_usuario_tabla</option>";
				}
			}
?>
	</select></td>
    </tr>	
</table>
</form>

<?php
	$sql_c = "select * from usuarios where id_usuario='$id_usuario2'";
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array($sql_c))
			{
			$id_usuario=$campo['id_usuario'];			
			$nombre=$campo['nombre'];
			$apellido=$campo['apellido'];
			$id_tipo_u=$campo['id_tipo_u'];
			}
		}
?>

<form id="form1" name="form1" method="post" action="sca_case.php">
      <table border="1" align="center" cellpadding="2" cellspacing="0">
      <tr>
       <td colspan="2" class="celdas"><div align="center"><strong>Modificaci&oacute;n de Usuario</strong></div></td>
      </tr>
      <tr>
        <td class="celdas"><div align="right"> Id_usuario </div></td>
        <td width="174"><input name="id_usuario" type="text" size="20" maxlength="100" readonly="" value="<?php echo @$id_usuario?>"/></td>
      </tr>
      <tr>
	  <td class="celdas"><div align="right">Nombre </div></td>
      <td><input name="nombre" type="text" size="20" value="<?php echo @$nombre?>"/> </td>
	  </tr>  
      <tr> <td class="celdas"><div align="right">Apellido</div></td>
       <td> <input name="apellido" type="text" size="20" value="<?php echo @$apellido?>"/></td>
      </tr>
      <tr>
	  <td class="celdas"><div align="right">Tipo de Usuario </div></td>
	  <td><select name="id_tipo_u">
<?php 
//	echo "<option value='$id_tipo_u'>--Tipo de Usuario--</option>";
	$sql_c = "select * from usuarios_t"; 
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_tipo_u2=$campo ['id_tipo_u'];
			$nombre=$campo['nombre'];
			if ($id_tipo_u2==$id_tipo_u)
				echo "<option value='$id_tipo_u2' selected='selected'>$nombre</option>";
			else
				echo "<option value='$id_tipo_u2'>$nombre</option>";
			}
		}
?>
	</select></td></tr>
<tr>
	 <td colspan="2"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div></td>
</tr>
  </table>
	<input name="seleccion" type="hidden" value="11"/>
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/>
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
