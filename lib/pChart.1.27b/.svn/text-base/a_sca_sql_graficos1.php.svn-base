<?php
	//Consulta de Tipos de Visitantes Historicos
	$sql_c = "select id_visitante_t, tipo from visitantes_t where id_visitante_t<>'0'"; 
	$sql_c=sql_c($sql_c);
	$i=0;
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_visitante_t=$campo['id_visitante_t'];
			$sql_conteo_c = "select a.fecha_s, b.id_visitante_t, c.tipo from visitantes_h a, visitantes b, visitantes_t c where a.fecha_s<>'0000-00-00 00:00:00' and a.cedula=b.cedula and b.id_visitante_t=c.id_visitante_t and b.id_visitante_t='$id_visitante_t'"; 
			$sql_conteo_c=sql_c($sql_conteo_c);
			$tipo_conteo_c=@mysql_num_rows($sql_conteo_c);
			$tipo_total[$i]=$tipo_conteo_c;
			$tipo[$i]=ascii_ext($campo['tipo'])." ($tipo_conteo_c)";
			$i++;	
			}
		}
?>

<?php
	//Consulta de Tipos de Visitantes 
	$sql_c = "select id_visitante_t, tipo from visitantes_t where id_visitante_t<>'0'"; 
	$sql_c=sql_c($sql_c);
	$i=0;
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_visitante_t=$campo['id_visitante_t'];
			$sql_conteo_c = "select a.fecha_s, b.id_visitante_t, c.tipo from visitantes_h a, visitantes b, visitantes_t c where a.fecha_s='0000-00-00 00:00:00' and a.cedula=b.cedula and b.id_visitante_t=c.id_visitante_t and b.id_visitante_t='$id_visitante_t'"; 
			$sql_conteo_c=sql_c($sql_conteo_c);
			$tipo_conteo_c=@mysql_num_rows($sql_conteo_c);
			$tipo_total[$i]=$tipo_conteo_c;
			$tipo[$i]=ascii_ext($campo['tipo'])." ($tipo_conteo_c)";
			$i++;	
			}
		}
?>

<?php
	//consulta de Visitantes por Asunto
	$sql_c = "select id_asunto, asunto from asuntos where id_asunto<>'0'"; 
	$sql_c=sql_c($sql_c);
	$i=0;
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_asunto=$campo['id_asunto'];
			$sql_conteo_c = "select a.id_asunto from visitantes_h a where a.fecha_s='0000-00-00 00:00:00' and a.id_asunto='$id_asunto'"; 
			$sql_conteo_c=sql_c($sql_conteo_c);
			$tipo_conteo_c=@mysql_num_rows($sql_conteo_c);
			$tipo_total[$i]=$tipo_conteo_c;
//			$tipo[$i]=$campo['tipo']." ($tipo_conteo_c)";
			$tipo[$i]=ascii_ext($campo['asunto'])." ($tipo_conteo_c)";
			$i++;	
			}
		}
?>


<?php
	//consulta de Visitantes por Asunto Historicos
	$sql_c = "select id_asunto, asunto from asuntos where id_asunto<>'0'"; 
	$sql_c=sql_c($sql_c);
	$i=0;
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array ($sql_c))
			{
			$id_asunto=$campo['id_asunto'];
			$sql_conteo_c = "select a.id_asunto from visitantes_h a where a.fecha_s<>'0000-00-00 00:00:00' and a.id_asunto='$id_asunto'"; 
			$sql_conteo_c=sql_c($sql_conteo_c);
			$tipo_conteo_c=@mysql_num_rows($sql_conteo_c);
			$tipo_total[$i]=$tipo_conteo_c;
//			$tipo[$i]=$campo['tipo']." ($tipo_conteo_c)";
			$tipo[$i]=ascii_ext($campo['asunto'])." ($tipo_conteo_c)";
			$i++;	
			}
		}
?>