<?php
/*Inicio Arreglo de Bases de Datos*/
//$arreglo_bd = Array ('monteavila20081125', 'apr2_bibliotecanacional20081201', 'apr2_cdiversidad20081201', 'apr2_cnt20081201', 'apr2_editmonteavila20081201', 'apr2_fundadistvenlibro20081201', 'apr2_fundaeditperroyrana20081201', 'apr2_fundaimprenta20081201', 'apr2_fundavilladelcine20081201', 'apr2_iaem20081201',  'apr2_iartes20081201', 'apr2_ministerio20081201', 'apr2_museos20081125', 'apr_bibliotecanacional20081103', 'apr_cdiversidad20081103', 'apr_cdiversidad20081105', 'apr_cnh20081120','apr_cnt20081103', 'apr_editmonteavila20081003', 'apr_fundacenaf20081105', 'apr_fundacnd20081103', 'apr_fundadistvenlibro20081103', 'apr_fundaeditperroyrana20081103', 'apr_fundafilarmonica20081008', 'apr_fundaimprenta20081103', 'apr_fundavilladelcine20081103', 'mc20081201',  'apr_iaem20081105','apr_iartes20081103','apr_ministerio20081103','armandoreveron20081127', 'cinemateca20081002');
//$arreglo_bd = Array ('ministerio2009_20090128');
$arreglo_bd=bases_sigesp_secundarias();

/*Fin Arreglo de Bases de Datos*/

?>

<?php
if (!(empty($_POST['guardar'])))
	{
//Select de sno_personal 
//	$ls_codper="%".$_POST["txtcodper"]."%";;
	$ls_cedper=$_POST["txtcedper"];
	$ls_criterio="";
	if ($ls_cedper!="")
		{
		$sql_c = "Select DISTINCT cedula, nombre, apellido, telefono_movil, cod_ent, cod_mun, cod_parr, cod_cp, direccion, id_visitante_t from visitantes where cedula='$ls_cedper'";
		$sql_c = sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($row = mysql_fetch_array ($sql_c))
				{
				$ls_cedper=$row["cedula"];
				$ls_nomper=$row["nombre"];
				$ls_apeper=$row["apellido"];
				$ls_dirper=$row["direccion"];		
	//			$ls_telhabper=$row["telhabper"];
				$ls_telmovper=$row["telefono_movil"];
				$cod_ent2=$row["cod_ent"];
				$cod_mun2=$row["cod_mun"];
				$cod_parr2=$row["cod_parr"];
				$cod_cp2=$row["cod_cp"];
				$id_visitante_t2=$row['id_visitante_t'];
				}
			}
		else
			{
		//	$ls_criterio=" AND sno_personal.codper like '$ls_codper' AND sno_personal.cedper like '$ls_cedper' AND sno_personal.nomper like '$ls_nomper' AND sno_personal.apeper like '$ls_apeper'";
		//	$sql_bases="SELECT DISTINCT codemp, codper, cedper, nomper, apeper, dirper, fecnacper, edocivper, telhabper, telmovper from sno_personal";
			$conteo_sql_bases=0;
			for ($i=0; $i<count($arreglo_bd); $i++)
				{
				$mydb=$arreglo_bd[$i];
				$sql_bases="SELECT DISTINCT codemp, codper, cedper, nomper, apeper, dirper, fecnacper, edocivper, telhabper, telmovper, codpai, codest, codmun, codpar from sno_personal where cedper='$ls_cedper'";
				$sql_bases=sql_bases_2($sql_bases,$mydb);
				$conteo_sql_bases=@mysql_num_rows($sql_bases);
				if (!(@mysql_num_rows ($sql_bases) == 0))
					{
					while ($row = mysql_fetch_array ($sql_bases))
						{
						$ls_codper=$row["codper"];
						$ls_cedper=$row["cedper"];
						$ls_nomper=$row["nomper"];
						$ls_apeper=$row["apeper"];
			//			$desuniadm=$row["desuniadm"];
						$ls_dirper=$row["dirper"];		
			//			$ld_fecnacper=$row["fecnacper"];	
			//			$ls_edocivper=$row["edocivper"];
						$ls_telhabper=$row["telhabper"];
						$ls_telmovper=$row["telmovper"];
			//			$ls_sexper=$row["sexper"];
						$ls_codpai=$row["codpai"];
						if ($ls_codpai=="058")
							{
							$ls_codest=$row["codest"];
							$cod_ent2 = substr($ls_codest, 1);
						//	echo "ENTRO AQUI $cod_ent2";
						//	$ls_codmun=$row["codmun"];
						//	$ls_codpar=$row["codpar"];
							}
						}
					}
/*				if ($conteo_sql_bases==0)
					{
					$sql_bases="SELECT DISTINCT ced_bene, codpai, codest, codmun, codpar, nombene, apebene, dirbene, telbene, celbene from rpc_beneficiario where ced_bene='$ls_cedper'";
					$sql_bases=sql_bases_2($sql_bases,$mydb);
					if (!(@mysql_num_rows ($sql_bases) == 0))
						{
						while ($row = mysql_fetch_array ($sql_bases))
							{
							$ls_cedper=$row["ced_bene"];
							$ls_nomper=$row["nombene"];
							$ls_apeper=$row["apebene"];
							$ls_dirper=$row["dirbene"];	
							$ls_telhabper=$row["telbene"];
							$ls_telmovper=$row["celbene"];
							$ls_codpai=$row["codpai"];
							if ($ls_codpai=="058")
								{
								$ls_codest=$row["codest"];
								$cod_ent2 = substr($ls_codest, 1);
							//	echo "ENTRO AQUI $cod_ent2";
							//	$ls_codmun=$row["codmun"];
							//	$ls_codpar=$row["codpar"];
								}
							}
						}
					}*/
				}
			}
/*		//Consulta de Personal egresado
		$array_egreso="";
		$sql_c = "Select * from personas_egresadas  where cedula='$ls_cedper'";
		$sql_c = sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			$i=0;
			//$array_egreso = mysql_fetch_array ($sql_c);
			while ($row = mysql_fetch_array ($sql_c))
				{
				$array_egreso['cedula'][$i] = 		$row["cedula"];
				$array_egreso['nombre_y_apellido'][$i] = 	$row["nombre_y_apellido"];
				$i++;
				}
			}
*/
		}
	}
?>