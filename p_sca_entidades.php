<?php
include_once ("sca_precarga.php");
conectar();
?>
<table>
<tr><td class="celdas"><div align="right">Entidad</div></td><td>
<select name="menu1" onChange="location.href=this.value">
<?php 
$cod_ent2=$_GET['cod_ent'];
$cod_mun2=$_GET['cod_mun'];
$cod_parr2=$_GET['cod_parr'];
$cod_cp2=$_GET['cod_cp'];

/*$entidad2=$_GET['entidad'];
$municipio2=$_GET['municipio'];
$parroquia2=$_GET['parroquia'];
$centro_pob2=$_GET['centro_pob'];*/

//Inicio Entidad

echo "<option value='$url_origen'>Entidad</option>";
for ($i=1;$i<=25;$i++)
{
	if ($i<10)
	{
		$i= "0$i";
	}
$query = "select cod_ent, entidad from empcp where cod_ent = '$i'  limit 0,1"; 
$resultado= mysql_query ($query) or die ("Error".mysql_error());
while ($campo = mysql_fetch_array ($resultado))
	{
	$cod_ent=$campo ['cod_ent'];
	$entidad=$campo ['entidad'];
	if ($cod_ent==$cod_ent2)
		{
		echo "<option value='$url_origen?cod_ent=$cod_ent' selected='selected'>$entidad</option>";
		$entidad2=$entidad;
		}
	else
		{
		echo "<option value='$url_origen?cod_ent=$cod_ent'>$entidad</option>";
		}
	}
}
?>
</select></td></tr>
<!--Fin de Entidad-> 
 
<!--Comienzo de Municipios-->
<tr><td class="celdas"><div align="right">Municipio</div></td><td>

<?php 
$query_mun1 = "select cod_mun from empcp where cod_ent = '$cod_ent2' ORDER BY cod_mun DESC limit 0,1"; 
$resultado_mun1= mysql_query ($query_mun1) or die ("Error".mysql_error());
while ($campo = mysql_fetch_array ($resultado_mun1))
	{
	$cod_mun1=$campo ['cod_mun'];
	}
?>

<select name="select4" onchange="location.href=this.value">
  <?php 

echo "<option value='$url_origen?cod_ent=$cod_ent2'>Municipio</option>";
for ($m=1;$m<=$cod_mun1;$m++)
{
	if ($m<10)
	{
		$m= "0$m";
	}
$query_mun2 = "select cod_mun, municipio from empcp where cod_ent = '$cod_ent2' and cod_mun='$m'  limit 0,1"; 
$resultado_mun2= mysql_query ($query_mun2) or die ("Error".mysql_error());
while ($campo = mysql_fetch_array ($resultado_mun2))
	{
	$cod_mun=$campo ['cod_mun'];
	$municipio=$campo ['municipio'];
	if ($cod_mun==$cod_mun2)
		{
		echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun' selected='selected'>$municipio</option>";
		$municipio2=$municipio;
		}
	else
		{
		echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun'>$municipio</option>";
		}
	}
	echo "<br>";
}
?>
</select></td>
</tr><!--Fin de Municipios-->

<!--Comienzo de Parroquias-->
<td class="celdas"><div align="right">Parroquia</div></td><td> 

<?php
$query_parr1 = "select cod_parr from empcp where cod_ent = '$cod_ent2' and cod_mun='$cod_mun2' ORDER BY cod_parr DESC limit 0,1"; 
$resultado_parr1= mysql_query ($query_parr1) or die ("Error".mysql_error());
while ($campo = mysql_fetch_array ($resultado_parr1))
	{
	$cod_parr1=$campo ['cod_parr'];
	}
?>

<select name="menu1" onChange="location.href=this.value">
          
<?php
echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun2'>Parroquia</option>";
for ($p=1;$p<=$cod_parr1;$p++)
{
	if ($p<10)
	{
		$p= "0$p";
	}
$query_parr2 = "select cod_parr, parroquia from empcp where cod_ent = '$cod_ent2' and cod_mun='$cod_mun2' and cod_parr='$p' limit 0,1"; 
$resultado_parr2= mysql_query ($query_parr2) or die ("Error".mysql_error());
while ($campo = mysql_fetch_array ($resultado_parr2))
	{
	$cod_parr=$campo ['cod_parr'];
	$parroquia=$campo ['parroquia'];
	if ($cod_parr==$cod_parr2)
	{
	echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun2&cod_parr=$cod_parr' selected='selected'>$parroquia</option>";
	$parroquia2=$parroquia;
	}
	else
	{
	echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun2&cod_parr=$cod_parr'>$parroquia</option>";
	}
	}
}
?>
</select>

<!--Fin de Parroquias--></td></tr>

<!--Inicio de Centro_pob-->
<tr><td class="celdas"><div align="right">Centro Poblado</div></td><td>

<select name="menu1" onChange="location.href=this.value">

<?php
echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun2&cod_parr=$cod_parr2'>Centro Poblado</option>";
if (!(empty ($cod_parr2)))
{
$query_cp1 = "select cod_cp, centro_pob from empcp where cod_ent = '$cod_ent2' and cod_mun='$cod_mun2' and cod_parr=$cod_parr2"; 
$resultado_cp1= mysql_query ($query_cp1) or die ("Error".mysql_error());
while ($campo = mysql_fetch_array ($resultado_cp1))
	{
	$cod_cp=$campo ['cod_cp'];
	$centro_pob=$campo ['centro_pob'];
	if ($cod_cp==$cod_cp2)
		{
		echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun2&cod_parr=$cod_parr2&cod_cp=$cod_cp' selected='selected'>$centro_pob</option>";
		$centro_pob2=$centro_pob;
		}
	else
		{
		echo "<option value='$url_origen?cod_ent=$cod_ent2&cod_mun=$cod_mun2&cod_parr=$cod_parr2&cod_cp=$cod_cp'>$centro_pob</option>";
		}
	}
}
?>
      </select></td>
</tr>        
<!--Fin de Centro_pob--> 
</table>
<?php
include_once ("sca_postcarga.php");
?>
