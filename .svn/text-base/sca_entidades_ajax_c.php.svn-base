<?php
if(isset($_GET['cp']) && $_GET['cp']==1)
	{
?>
	<select name="cod_cp">
	<option value="0">Seleccione...</option>
<?php
	@$cod_ent=$_GET['ide'];
	@$cod_mun=$_GET['idm'];
	@$cod_parr=$_GET['idp'];
	$query_cp1 = "select cod_cp, centro_pob from empcp where cod_ent = '$cod_ent' and cod_mun='$cod_mun' and cod_parr='$cod_parr'"; 
	$resultado_cp1= mysql_query ($query_cp1) or die ("Error".mysql_error());
	while ($campo = mysql_fetch_array ($resultado_cp1))
		{
		$cod_cp=$campo ['cod_cp'];
?>
		<option value="<?php echo $cod_cp?>"><?=$campo ['centro_pob'];?></option>
<?php
		}
?>
	</select>
	<input name="cod_ent" type="hidden" value="<?php echo $cod_ent?>" />
	<input name="cod_parr" type="hidden" value="<?php echo $cod_parr?>" />
<?php	
	}
else
	{
	if(isset($_GET['par']) && $_GET['par']==1)
		{
		@$cod_ent=$_GET['ide'];
		@$cod_mun=$_GET['idm'];
		$query_parr1 = "select cod_parr from empcp where cod_ent = '$cod_ent' and cod_mun='$cod_mun' ORDER BY cod_parr DESC limit 0,1"; 
		$resultado_parr1= mysql_query ($query_parr1) or die ("Error".mysql_error());
		while ($campo = mysql_fetch_array ($resultado_parr1))
			{
			$cod_parr1=$campo ['cod_parr'];
			}
?>
		<select name="parroquia" onchange="act_cp(this.value);">> 
		<option value="0">Seleccione...</option>
<?php
		for ($p=1;$p<=$cod_parr1;$p++)
			{
			if ($p<10)
				{
				$p= "0$p";
				}
			$query_parr2 = "select cod_parr, parroquia from empcp where cod_ent = '$cod_ent' and cod_mun='$cod_mun' and cod_parr='$p' limit 0,1"; 
			$resultado_parr2= mysql_query ($query_parr2) or die ("Error".mysql_error());
			while ($campo = mysql_fetch_array ($resultado_parr2))
				{
				$cod_parr=$campo ['cod_parr'];
				$cod_parr="$cod_parr&ide=$cod_ent&idm=$cod_mun";
?>
				<option value="<?php echo $cod_parr?>"><?=$campo ['parroquia'];?></option>
<?php
    				}
			}
?>
		</select>
		<input name="cod_ent" type="hidden" value="<?php echo $cod_ent?>" />
		<input name="cod_mun" type="hidden" value="<?php echo $cod_mun?>" />
<?php
		}
	else
		{
		$cod_ent=$_GET['ide'];
		$query_mun1 = "select cod_mun from empcp where cod_ent = '$cod_ent' ORDER BY cod_mun DESC limit 0,1"; 
		$resultado_mun1= mysql_query ($query_mun1) or die ("Error".mysql_error());
		while ($campo = mysql_fetch_array ($resultado_mun1))
			{
			$cod_mun1=$campo ['cod_mun'];
			}
?>
		<select name="municipio" onchange="act_parroquia(this.value);">
		<option value="0">Seleccione...</option>
<?php
		for ($m=1;$m<=$cod_mun1;$m++)
			{
			if ($m<10)
				{
				$m= "0$m";
				}
			$query_mun2 = "select cod_mun, municipio from empcp where cod_ent = '$cod_ent' and cod_mun='$m'  limit 0,1"; 
			$resultado_mun2= mysql_query ($query_mun2) or die ("Error".mysql_error());
			while ($campo = mysql_fetch_array ($resultado_mun2))
				{
				$cod_mun=$campo ['cod_mun'];
				$cod_mun="$cod_mun&ide=$cod_ent";
?>
		<option value="<?php echo $cod_mun ?>"><?=$campo ['municipio']?></option>
<?php
				}
			}
?>
		</select>
		<input name="cod_ent" type="hidden" value="<?php echo $cod_ent?>" />
		<input name="cod_mun" type="hidden" value="<?php echo $cod_mun?>" />
<?php
		}
	}
?>