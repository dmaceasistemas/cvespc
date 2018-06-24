<?php
include ("sca_precarga.php");
/*Modulo de Modificacion de Visitantes*/
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>

<?php
	@$id_asunto=$_GET['id_asunto'];
	if (!(empty($id_asunto)))
		{
		$sql_c = "select * from asuntos where id_asunto='$id_asunto'";
		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$id_asunto=$campo['id_asunto'];
				$asunto=$campo['asunto'];
				}
			}
?>

<form id="form2" name="form2" method="post" action="sca_case.php">
  <table border="1" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td colspan="2" class="celdas"><div align="center"><b>Actualización de Asunto</b></div></td>
    </tr>
    <tr>
      <td class="celdas"><div align="right">Asunto</div></td>
	<td><input name="asunto" type="text" size="50" value="<?php echo $asunto?>"/></td>
	<input name="seleccion" type="hidden" value="5"/> 
	<input name="id_asunto" type="hidden" value="<?php echo $id_asunto?>"/>
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
      <td class="celdas"><div align="center"><a href="<?php echo 'sca_asunto_c.php' ?>">Regresar</a></div></td>
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