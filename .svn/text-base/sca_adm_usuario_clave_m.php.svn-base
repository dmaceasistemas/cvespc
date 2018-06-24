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
@$id_usuario=$_REQUEST['id_usuario'];
?>
<form id="form1" name="form1" method="GET" action="">

<table border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
      <td>Id Usuarios</td>
      <td><select name="id_usuario" onchange = "this.form.submit()">
<?php
		echo "<option></option>";
		$sql_c="select * from usuarios";
		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array($sql_c))
				{
				$id_usuario_tabla=$campo['id_usuario'];
				if ($id_usuario_tabla==$id_usuario)
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

<form method="post" action="sca_case.php">
<table border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" class="celdas"><div align="center"><strong>Cambio de Clave</strong></div></td>
  </tr>
  <tr>
    <td class="celdas"><div align="right"> Usuario </div></td>
    <td width="174"><input name="id_usuario" type="text" readonly="" value="<?php echo $id_usuario; ?>"/></td>
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
<input name="seleccion" type="hidden" value="12"/>
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
