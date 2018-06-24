<?php
include ("sca_precarga.php");
/*Modulo de Inclusion de Casos del Sig¸es*/
include ("metacalendario.php"); //InclusiÛn del Meta del Calendario solo se usa en el caso de usar fechas
conectar();
?>
<?php 
//if(!(empty($sca_id_u_activo)))
//{
?>
<form id="form1" name="form1" method="post" action="sca_case.php" enctype="multipart/form-data">
      <table border="1" align="center" cellpadding="2" cellspacing="0">
      <tr>
       <td colspan="2" class="celdas"><div align="center"><strong>Inclusi&oacute;n de Casos</strong></div></td>
      </tr>
      <tr>
        <td width="230" class="celdas"><div align="right">Nombre del Usuario</div></td>
        <td width="174"><input name="usuario" type="text" size="20" maxlength="100"/></td>
      </tr>
      <tr>
	  <td class="celdas"><div align="right">Tel&eacute;fono de Contacto</div></td>
      <td><input name="telefono_usuario" type="text" size="20"/> </td>
	<tr>
        <td class="celdas"><div align="right">E-Mail</div></td>
        <td><input name="email" type="text" size="20"/></td>
      </tr>
</tr>  
      <tr>
	  <td class="celdas"><div align="right">Nombre de la Persona de Tecnolog&iacute;a</div></td>
      <td><input name="telefono_usuario" type="text" size="20"/> </td>
	  </tr>  
      <tr>
	  <td class="celdas"><div align="right">Tel&eacute;fono de Contacto (Persona de tecnolog&iacute;a)</div></td>
      <td><input name="telefono_usuario" type="text" size="20"/> </td>
	  </tr>
<tr><td class="celdas"><div align="right">Fecha aproximada de la presentacion del problema</div></td>
	<td><input name="fecha" type="text" id="campo_fecha" size="9" maxlength="10" readonly=""/>	</td>
	<script type="text/javascript">
		Calendar.setup({
		inputField : "campo_fecha", // id del campo de texto
		ifFormat : "%Y-%m-%d", // formato de la fecha que se escriba en el campo de texto
		button : "lanzador" // el id del bot√≥n que lanzar√° el calendario
		});
	</script>
</tr>

      <tr> <td class="celdas"><div align="right">M&oacute;dulo</div></td>
       <td><select name="id_modulo">
<?php
	$id_modulo2="";
	echo "<option>- - - Selecione - - -</option>";
	$modulos_c = "select id_modulo, modulo from modulos"; 
	$modulos_c= mysql_db_query ($mydb,$modulos_c) or die ("Error en consulta de modulos".mysql_error());
	while ($campo = mysql_fetch_array ($modulos_c))
		{
		$id_modulo=$campo ['id_modulo'];
		$modulo=$campo ['modulo'];
		if ($id_modulo==$id_modulo2)
			{
			echo "<option value=$id_modulo selected='selected'>$id_modulo - $modulo</option>";
			}
		else
			{
			echo "<option value=$id_modulo>$id_modulo - $modulo</option>";
			}
		}
?>
</select></td>
</tr>

<tr>
<td class="celdas"><div align="right">Sub-M&oacute;dulo</div></td>
      <td><input name="submodulo" type="text" size="40"/> </td>
</tr>

<tr>
      <td class="celdas"><div align="right">Detalle del Problema</div></td>
      <td><textarea name="tema" cols="50"></textarea></td>
</tr>

<tr>
	<td class="celdas"><div align="right">Adjunto</div></td>
	<td><input name="file" type="file" id="file"/></td> 
</tr>
<tr>
	 <td colspan="2"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div>
	<input name="seleccion" type="hidden" value="1"/>
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/></td>
</tr>

</table>
</form>
<?php
/*}
else  
	{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
	}*/
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td class="celdas"><div align="center"><a href="<?php echo 'sca_submenu.php?id_menu=2' ?>">Regresar</a></div></td>
    </tr>
</table>

<?php
include ("sca_postcarga.php");
?>