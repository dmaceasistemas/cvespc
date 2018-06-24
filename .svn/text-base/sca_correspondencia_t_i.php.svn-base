<?php
include ("sca_precarga.php");
/*Modulo de Inclusion de los Tipos de Visitantes*/
conectar();
?>
<?php 
if(!(empty($sca_id_u_activo)))
{
?>
<br/>
<form id="form2" name="form2" method="post" action="sca_case.php">
  <table border="1" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td colspan="2" class="celdas"><div align="center"><b>Inclusión de Tipo Correspondencia</b></div></td>
    </tr>
    <tr>
      <td class="celdas"><div align="right">Tipo</div></td>
      <td><input name="correspondencia_t" type="text" size="50"/></td>
	<input name="seleccion" type="hidden" value="15"/> 
	<input name="url_origen" type="hidden" value="<?php echo $url_origen?>"/> 
	<tr><td colspan="2"><div align="center"><input name="guardar" type="submit" value="Guardar"/></div></td></tr>
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