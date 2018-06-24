<?php
include_once ("sca_precarga.php");
//echo "<link rel='stylesheet' href='sca_estilo.css' type='text/css'/>";//Carga el Estilo de la Pagina Web
?>
<form name="form1" method="post" action="sca_basico_visitante_i.php" autocomplete="off">
  <p align="center">
    <input name="operacion" type="hidden" id="operacion">
</p>
  <table width="500" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="496" height="20" colspan="2" class="celdas"><div align="center">Cat&aacute;logo de Personal</div></td>
    </tr>
  </table>
<br>
    <table width="500" border="0" cellpadding="2" cellspacing="0" align="center">
      <tr>
        <td height="22" width="110" class="celdas"><div align="right">C&eacute;dula</div></td>
        <td>
	<input name="txtcedper" type="text" id="txtcedper" size="30" maxlength="10">
        </div></td>
 	<td><div align="center"><input name="guardar" type="submit" value="Buscar"/></div></td>
      </tr>
  </table>
</form>
  <br>

<?php
/*
if (!(empty($_POST['guardar'])))
	{
	$ls_cedper=$_POST["txtcedper"];

	$sql_c = "Select DISTINCT cedula, nombre, apellido, telefono_movil, cod_ent, cod_mun, cod_parr, cod_cp, direccion, id_visitante_t from visitantes where cedula='$ls_cedper'";
	$sql_c = sql_c($sql_c);


//Select de sno_personal 
//	$ls_codper="%".$_POST["txtcodper"]."%";;
	
	$ls_criterio="";
//	$ls_criterio=" AND sno_personal.codper like '$ls_codper' AND sno_personal.cedper like '$ls_cedper' AND sno_personal.nomper like '$ls_nomper' AND sno_personal.apeper like '$ls_apeper'";
//	$sql_bases="SELECT DISTINCT codemp, codper, cedper, nomper, apeper, dirper, fecnacper, edocivper, telhabper, telmovper from sno_personal";
	$sql_bases="SELECT DISTINCT codemp, codper, cedper, nomper, apeper, dirper, fecnacper, edocivper, telhabper, telmovper from sno_personal where cedper='$ls_cedper'";
 
	$sql_bases=sql_bases($sql_bases);
	if (!(@mysql_num_rows ($sql_bases) == 0))
		{
?>
		<table width=600 border=1 cellpadding="2" cellspacing="0" align=center class=tabla_sql>
		<tr class="celdas">
			<td>Codigo</td>
			<td>Cedula</td>
			<td>Nombre</td>
			<td>Apellido</td>
			<td>Dirección</td>
			<td>Teléfono Habitación</td>
			<td>Teléfono Movil</td>
		</tr>
<?php
		$i=0;
		while ($row = mysql_fetch_array ($sql_bases))
			{
			$ls_codper=$row["codper"];
			$ls_cedper=$row["cedper"];
			$ls_nomper=$row["nomper"];
			$ls_apeper=$row["apeper"];
//			@$desuniadm=$row["desuniadm"];
			$ls_dirper=$row["dirper"];		
//			$ld_fecnacper=$row["fecnacper"];	
//			$ls_edocivper=$row["edocivper"];
			$ls_telhabper=$row["telhabper"];	
			$ls_telmovper=$row["telmovper"];
//			$ls_sexper=$row["sexper"];
			echo "<tr>";
			echo "<td>$ls_codper</td>";
			echo "<td>$ls_cedper</td>";
			echo "<td>$ls_nomper</td>";
			echo "<td>$ls_apeper</td>";
			echo "<td>$ls_dirper</td>";
			echo "<td>$ls_telhabper</td>";
			echo "<td>$ls_telmovper</td>";		
			echo "</tr>";
			}
?>
			</table>
<?php
		}
	}*/
?>

<?php
include_once ("sca_postcarga.php");
?>