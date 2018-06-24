<?php
//funciones 

//Inicio Funcion Conexion con la Base de Datos
function conectar()
	{
	$serv = "localhost";
	$user = "root";
	$pass = "123456";
	$mydb="db_sca";//Nombre de la Base de datos
	$link = @mysql_connect($serv, $user, $pass); 
	@mysql_select_db($mydb, $link); 
	if (! $link)
		{
			$control =0;
		}
		else
		{
			$control=1;
		}
	return $control;
	}
//Fin Funcion Conexion con la Base de Datos

function linea()
	{
?>
	<IMG src="./imagenes/lineadegradado.png" width="100%" height="2" align="center"><br>
<?
	}
//Inicio Funcion de Insert Modificar y Eliminar para MYSQL
function sql($sql, $error)
	{
	conectar();
	mysql_query($sql) or die("error en $error: ".mysql_error());
//	mysql_close();
	}
//Fin Funcion de Insert y Eliminar para MYSQL

//Inicio Funcion de Consulta para MYSQL
function sql_c($sql_c)
	{
	conectar();
	$sql_c=mysql_query($sql_c) or die("error en Consulta: ".mysql_error());
	mysql_close();
	return $sql_c;
	}
//Fin Funcion de Consulta para MYSQL
	
/*Inicio Funcion Historial de Inclusion Auto ID*/
function historial_autoid_i($sql,$tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga)
	{
	conectar();
	$id_registro=mysql_insert_id();//Capta el ID autoincremento	
	$campo="Inclusión de $tabla";
	$contenido= addslashes($sql);
	$historial="insert into historiales (id_usuario, ip_acceso_u, fecha, id_registro, tabla, campo, contenido) values ('$sca_id_u_activo', '$ip_acceso_u', '$fecha_larga', '$id_registro', '$tabla', '$campo', '$contenido')";
	mysql_query($historial) or die("error en Incluir Historial: ".mysql_error());
	mysql_close();
	}
/*Fin Funcion Historial de Inclusion Auto ID*/

//Inicio Funcion para Capta el ID autoincremento
function sql_autoid()
	{
	conectar();
	$id_registro=mysql_insert_id();//Capta el ID autoincremento			
	//mysql_close();
	return $id_registro;
	}
//Fin Funcion para Capta el ID autoincremento

/*Inicio Funcion Historial de Inclusion y Actualizacion*/
function historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga)
	{
	conectar();
	$historial="insert into historiales (id_usuario, ip_acceso_u, fecha, id_registro, tabla, campo, contenido) values ('$sca_id_u_activo', '$ip_acceso_u', '$fecha_larga', '$id_registro', '$tabla', '$campo', '$contenido')";
	mysql_query($historial) or die("error en Incluir Historial: ".mysql_error());
	mysql_close();
	}
/*Fin Funcion Historial de Inclusion y Actualizacion*/

/*Inicio Funcion Historial de Eliminacion*/
function historial_e($sql, $id_registro, $tabla, $sca_id_u_activo, $ip_acceso_u, $fecha_larga)
	{	
	conectar();
	$campo="Eliminación de $tabla";
	$contenido= addslashes($sql);
	$historial="insert into historiales (id_usuario, ip_acceso_u, fecha, id_registro, tabla, campo, contenido) values ('$sca_id_u_activo', '$ip_acceso_u', '$fecha_larga', '$id_registro', '$tabla', '$campo', '$contenido')";
	mysql_query($historial) or die("error en Incluir Historial: ".mysql_error());
	mysql_close();
	}
/*Fin Funcion Historial de Eliminacion*/

/*Inicio Funcion Historial de Modificacion*/
function historial_m($tabla, $where, $id_registro, $arreglo_campos_v, $arreglo_variables_v, $error, $sca_id_u_activo, $ip_acceso_u, $fecha_larga)
	{
	for ($i=0; $i<count($arreglo_campos_v);$i++)
		{
		conectar();
		$nombre_campo=$arreglo_campos_v[$i];
		$variable_nueva=$_POST[$arreglo_variables_v[$i]];
		$consulta="select $nombre_campo from $tabla $where";
		$consulta=mysql_query($consulta) or die("error en Consulta de $tabla ".mysql_error());
		if (!(@mysql_num_rows ($consulta) == 0))
			{
			while ($campo2 = mysql_fetch_array($consulta))
				{
				$campo_original=$campo2[$nombre_campo];
				if ($campo_original!=$variable_nueva)
					{
					conectar();	
					$campo="$nombre_campo";
					$contenido="$variable_nueva";
					$historial="insert into historiales (id_usuario, ip_acceso_u, fecha, id_registro, tabla, campo, contenido) values ('$sca_id_u_activo', '$ip_acceso_u', '$fecha_larga', '$id_registro', '$tabla', '$campo', '$contenido')";
					mysql_query($historial) or die("error en Incluir Historial: ".mysql_error());
					$sql="update $tabla set $nombre_campo='$variable_nueva' $where";
					sql($sql, $error);
					}
				}
			}
		else
			mysql_close();
		}
	}
/*Fin Funcion Historial de Modificacion*/

/*Inicio Funcion Conexion con la Base de Datos diferente al del sistema con tabla base_sigesp*/
function conectar_bases()
	{
	conectar();
	$sql_c="select base_db, id_base_db_t from bases_db where id_base_db_t='1'";
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($row = mysql_fetch_array ($sql_c))
			{
			$base_sigesp=$row["base_db"];
			}
		$mydb="$base_sigesp";//Nombre de la Base de datos
//		$link = @mysql_connect($serv, $user, $pass); 
		conectar_mysql();
		@mysql_select_db($mydb); 
		}
	}
/*Fin Funcion Conexion con la Base de Datos diferente al del sistema con tabla base_sigesp*/

/*Inicio Funcion de Consulta para MYSQL*/
function sql_bases($sql_bases)
	{
	conectar_bases();
	$sql_bases=mysql_query($sql_bases) or die("error en Consulta: ".mysql_error());
	mysql_close();
	return $sql_bases;
	}
/*Fin Funcion de Consulta para MYSQL*/

/*Inicio Funcion base_sigesp Principal*/
function bases_sigesp_principal()
	{
	conectar();
	$sql_c="select base_db, id_base_db_t from bases_db where id_base_db_t='1'";
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		$i=0;
		while ($row = mysql_fetch_array ($sql_c))
			{
			$base_sigesp=$row["base_db"];
			$resultado=ExistenciaBase($base_sigesp);
			if ($resultado==1)
				{
				$nombretabla="sno_personal";//Temporal, cambiar a futuro por ultimas tablas 20090407
				$resultado2=ExistenciaTabla($nombretabla, $base_sigesp);
				if ($resultado2==1)
					{
					$arreglo_bd[$i]=$base_sigesp;
					$i++;
					}
				}
			}
		}
	return $arreglo_bd;
	}
/*Fin Funcion base_sigesp Principal*/

/*Inicio Funcion Conexion con la Base de Datos*/
function conectar_bases_2($mydb) /*Corregir*/
	{
	$serv = "localhost";
	$user = "root";
	$pass = "";
	$link = @mysql_connect($serv, $user, $pass); 
	@mysql_select_db($mydb, $link); 
	if (! $link)
		{
			$control =0;
		}
		else
		{
			$control=1;
		}
	return $control;
	}
/*Fin Funcion Conexion con la Base de Datos*/

/*Inicio Funcion de Consulta para MYSQL*/
function sql_bases_2($sql_bases,$mydb)
	{
	conectar_bases_2($mydb);
	$sql_bases=mysql_query($sql_bases) or die("error en Consulta: ".mysql_error());
	mysql_close();
	return $sql_bases;
	}
/*Fin Funcion de Consulta para MYSQL*/

/*Inicio Funcion Regresar*/
function regresar()
	{
	$id_menu_p="";
	$url_origen=$_SERVER['PHP_SELF'];
	$extension = end(explode('/', $url_origen));
	@$id_tipo_u=$_SESSION['sca_id_tipo_u_menu'];
	$sql_c = "select id_menu, id_menu_p, nombre, id_tipo_u from menus where url='$extension' and no_publicado='0' and id_tipo_u='$id_tipo_u'"; 
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_tipo_u2=$campo['id_tipo_u'];
			if ($id_tipo_u2==$id_tipo_u)
				$id_menu_p=$campo['id_menu_p'];
			}
	
		$sql_c = "select id_menu, url from menus where id_menu='$id_menu_p' and no_publicado='0' and id_tipo_u='$id_tipo_u'"; 
		$sql_c=sql_c($sql_c);
		if (!(@mysql_num_rows ($sql_c) == 0))
			{
			while ($campo = mysql_fetch_array ($sql_c))
				{
				$url=$campo['url'];
				$id_menu=$campo['id_menu'];
				}
?>
		<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
			<tr>
			<td class="celdas"><div align="center"><a href="<?php echo "$url?id_menu=$id_menu" ?>">Regresar</a></div></td>
			</tr>
		</table>
<?php
			}
		}
	}
/*Fin Funcion Regresar*/


/*Inicio Funcion IP Real*/
function ip_real() {
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
              $ip=$_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
              $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       }else{
              $ip=$_SERVER['REMOTE_ADDR'];
       }
return $ip;
}
/*Fin Funcion IP Real*/

/*Inicio Funcion Vacio Variables*/

function vacio($arreglo_empty_v, $arreglo_empty_n)
	{
	$dato="";
	for ($i=0; $i<count($arreglo_empty_n);$i++)
		{
		$campo_empty_v=$arreglo_empty_v[$i];
		if ($campo_empty_v=="")
			{
			if ($dato=="")
				$dato="El campo $arreglo_empty_n[$i]";
			else
				$dato="$dato, $arreglo_empty_n[$i]";
			}
		}
	if ($dato!="")
		{
		$dato="$dato no deben estar en blanco";
		}
	return $dato;
	}
/*Fin Funcion Vacio Variables*/

/*Inicio Funcion Vacio Variables POST*/
function vacio_post($arreglo_empty_v, $arreglo_empty_n)
	{
	$dato="";
	for ($i=0; $i<count($arreglo_empty_n);$i++)
		{
		$campo_empty_v=$arreglo_empty_v[$i];
		if ($_POST["$campo_empty_v"]=="")
			{
			if ($dato=="")
				$dato="El campo $arreglo_empty_n[$i]";
			else
				$dato="$dato, $arreglo_empty_n[$i]";
			}
		}
	if ($dato!="")
		{
		$dato="$dato no deben estar en blanco";
		}
	return $dato;
	}

/*Fin Funcion Vacio Variables POST*/

/*Inicio Funcion Conexion*/
function conectar_mysql()
	{
	$serv = "localhost";
	$user = "root";
	$pass = "";
	$link = @mysql_connect($serv, $user, $pass); 
	}
/*Fin Funcion Conexion*/


/*Inicio Funcion base_sigesp Secundarias*/
function bases_sigesp_secundarias()
	{
	conectar();
	$sql_c="select base_db, id_base_db_t from bases_db where id_base_db_t='2'";
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		$i=0;
		while ($row = mysql_fetch_array ($sql_c))
			{
			$base_sigesp=$row["base_db"];
			$resultado=ExistenciaBase($base_sigesp);
			if ($resultado==1)
				{
				$nombretabla="sno_personal";//Temporal, cambiar a futuro por ultimas tablas 20090407
				$resultado2=ExistenciaTabla($nombretabla, $base_sigesp);
				if ($resultado2==1)
					{
					$arreglo_bd[$i]=$base_sigesp;
					$i++;
					}
				}
			}
		}
	return $arreglo_bd;
	}
/*Fin Funcion base_sigesp Secundarias*/

/*Inicio Funcion Conexion con la Base de Datos de mincul_corr*/
function conectar_mincul_corr()
	{
	conectar();
	$sql_c="select * from bases_db where id_base_db_t='3'";
	$sql_c = sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($row = mysql_fetch_array ($sql_c))
			{
			$base_mincul_corr=$row["base_db"];
			}
		$mydb="$base_mincul_corr";//Nombre de la Base de datos
		conectar_mysql();
		@mysql_select_db($mydb); 
		}
	}
/*Fin Funcion Conexion con la Base de Datos diferente al del sistema con tabla base_sigesp*/

/*Inicio Funcion de Consulta para MYSQL*/
function sql_mincul_corr($cod_arbol)
	{
	conectar_mincul_corr();
	$sql_mincul_corr="select depl from temisor where codigo='$cod_arbol'";
	$sql_mincul_corr=mysql_query($sql_mincul_corr) or die("error en Consulta: ".mysql_error());
	if (!(@mysql_num_rows ($sql_mincul_corr) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_mincul_corr))
			{
			$depl=$campo ['depl'];
			}
		}
	mysql_close();
//	$depl=utf8_decode(@$depl);//Asume codificación UTF-8 , a ISO-8859-1. 
	return @$depl;
	}
/*Fin Funcion de Consulta para MYSQL*/

/*Inicio Funcion de Consulta para MYSQL mincul_corr
function sql_mincul_corr($sql_mincul_corr)
	{
	conectar_mincul_corr();
	$sql_mincul_corr=mysql_query($sql_mincul_corr) or die("error en Consulta: ".mysql_error());
	mysql_close();
	return $sql_mincul_corr;
	}
Fin Funcion de Consulta para MYSQL mincul_corr*/

//Inicio Funcion para la existencia de Tablas
function ExistenciaTabla($nombretabla, $db) {
	conectar_mysql();
    // Get a list of tables contained within the database.
    $result = mysql_list_tables($db);
    $rcount = mysql_num_rows($result);

    // Check each in list for a match.
    for ($i=0;$i<$rcount;$i++) {
        if (mysql_tablename($result, $i)==$nombretabla) return true;
    }
	mysql_close();
    return false;
}
//Fin Funcion para la existencia de Tablas

//Inicio Funcion para la existencia de Bases
function ExistenciaBase($db)
	{
	conectar_mysql();
	$db_list = mysql_list_dbs();
	while ($row = mysql_fetch_object($db_list)) 
		{
		$mydb=$row->Database;
		if ($mydb==$db)
			return true;
		}
	mysql_close();
	return false;
	}
//Fin Funcion para la existencia de Bases

//Inicio Funcion para reemplazar a texto ASCII Extendido
function ascii_ext($texto)
	{
	$texto = str_replace("á","&#225;",$texto);
	$texto = str_replace("é","&#233;",$texto);
	$texto = str_replace("í","&#237;",$texto);
	$texto = str_replace("ó","&#243;",$texto);
	$texto = str_replace("ú","&#250;",$texto);
	$texto = str_replace("ñ","&#241;",$texto);
	return $texto;
	}
//Fin Funcion para reemplazar a texto ASCII Extendido

//Inicio Funcion para mostrar fecha Larga del formato 2009-03-13 16:11:52 al 13/03/2009 16:11:52
function mostrar_fecha_larga($fecha)
	{
	//$fecha=date("d-m-Y H:i:s",strtotime($fecha));
	$fecha=date("d/m/Y H:i:s",strtotime($fecha));
	return $fecha;
	}
//Fin Funcion para mostrar fecha Larga del formato 2009-03-13 16:11:52 al 13/03/2009 16:11:52

//Inicio Funcion convertir fecha del formato 15-01-2009 a 2009-01-15
function convertir_fecha($fecha)
	{
	$ls_fecreg=""; 
	$li_pos=strpos($fecha,"/");
	$li_pos2=strpos($fecha,"-");
	if(($li_pos==2)||($li_pos2==2))
		{
		$ls_fecreg=(substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2)); 
		}
	elseif(($li_pos==4)||($li_pos2==4))
		{
		$ls_fecreg=$fecha;
		}
	return $ls_fecreg;
	}
//Fin Funcion convertir fecha del formato 15-01-2009 a 2009-01-15


/*
function bases_entes($sql_entes);
	{
	Inicio Arreglo de Bases de Datos
	$arreglo_bd = Array ('monteavila20081125', 'apr2_bibliotecanacional20081201', 'apr2_cdiversidad20081201', 'apr2_cnt20081201', 'apr2_editmonteavila20081201', 'apr2_fundadistvenlibro20081201', 'apr2_fundaeditperroyrana20081201', 'apr2_fundaimprenta20081201', 'apr2_fundavilladelcine20081201', 'apr2_iaem20081201',  'apr2_iartes20081201', 'apr2_ministerio20081201', 'apr2_museos20081125', 'apr_bibliotecanacional20081103', 'apr_cdiversidad20081103', 'apr_cdiversidad20081105', 'apr_cnh20081120', 'apr_cnt20081103', 'apr_editmonteavila20081003', 'apr_fundacenaf20081105', 'apr_fundacnd20081103', 'apr_fundadistvenlibro20081103', 'apr_fundaeditperroyrana20081103', 'apr_fundafilarmonica20081008', 'apr_fundaimprenta20081103', 'apr_fundavilladelcine20081103', 'ministerio2009_20090204',  'apr_iaem20081105','apr_iartes20081103','apr_ministerio20081103','armandoreveron20081127', 'cinemateca20081002');
	Fin Arreglo de Bases de Datos
	
	for ($i=0; $i<count($arreglo_bd); $i++)
		{
		$mydb=$arreglo_bd[$i];
		$sql_bases=sql_bases_2($sql_entes,$mydb);
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
					$ls_codmun=$row["codmun"];
					$ls_codpar=$row["codpar"];
					}
				}
			}
		}
	}*/
?>
