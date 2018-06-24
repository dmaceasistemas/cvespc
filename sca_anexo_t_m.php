<?php
include ("sca_precarga.php");
/*Modulo de Modificacion de las Tipo de Anexos*/
conectar();
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>

<?php
	@$id_anexo_t=$_GET['id_anexo_t'];
//	@$id_visitante_t=$_GET['id_visitante_t'];
	if (!(empty($id_anexo_t)))
		{
		$sql_c = "select id_anexo_t, anexo_t from anexos_t where id_anexo_t='$id_anexo_t'";
		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$id_anexo_t=$campo['id_anexo_t'];
				$anexo_t=$campo['anexo_t'];
				}
			}
?>

<form id="form2" name="form2" method="post" action="sca_case.php">
  <table border="1" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td colspan="2" class="celdas"><div align="center"><b>Actualización de Tipo de Anexo</b></div></td>
    </tr>
    <tr>
      <td class="celdas"><div align="right">Tipo</div></td>
	<td><input name="anexo_t" type="text" size="50" value="<?php echo $anexo_t?>"/></td>
	<input name="seleccion" type="hidden" value="19"/> 
	<input name="id_anexo_t" type="hidden" value="<?php echo $id_anexo_t?>"/>
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	<tr><td colspan="2"><div align="center"><input name="actualizar" type="submit" value="Actualizar"/></div></td></tr>
    </tr>
  </table>
</form>
<?php
		}//Cierre del If de empty de ID
?>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td class="celdas"><div align="center"><a href="<?php echo 'sca_anexo_t_c.php' ?>">Regresar</a></div></td>
    </tr>
</table>

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