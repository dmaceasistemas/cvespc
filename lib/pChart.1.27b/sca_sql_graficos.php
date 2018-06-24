<?php
include_once ("../../sca_precarga.php");

// Standard inclusions
include("pChart/pData.class");
include("pChart/pChart.class");
$grafico_titulo="";
@$seleccion=$_REQUEST["seleccion"];
?>
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr><td colspan="2"  class="celdas"><div align="center">Grafico</div></td>
<td><select name="seleccion" onchange="location.href=this.value">
<option value=<?php echo "$url_origen?seleccion=0?"?>>Gráfico</option>

<?php
$selected="";

$grafico_array=array('Tipo de Visitantes Historicos', 'Tipo de Visitantes', 'Tipo de Visitantes por Asunto', 'Tipo de Visitantes por asunto Historicos');
$conteo_grafico_array=count($grafico_array);
for ($i=0; $i<$conteo_grafico_array; $i++)
	{
	$a=$i+1;
	if ($seleccion==$a)
		$selected="selected='selected'";
?>
	<option value="<?php echo "$url_origen?seleccion=$a"?>" <?php echo $selected?>><?php echo $grafico_array[$i]?></option>
<?php
	$selected="";
	}
?>
</select>
</td></tr>
</table>


<?php


switch($seleccion)
	{	
	case 1:
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
		$grafico_titulo="Tipo de Visitantes Historicos";
		}
	break;

	case 2:
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
		$grafico_titulo="Tipo de Visitantes";
		}
	break;

	case 3:
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
			$tipo[$i]=ascii_ext($campo['asunto'])." ($tipo_conteo_c)";
			$i++;	
			}
		}
		$grafico_titulo="Tipo de Visitantes por Asunto";
	break;

	case 4:
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
			$tipo[$i]=ascii_ext($campo['asunto'])." ($tipo_conteo_c)";
			$i++;	
			}
		$grafico_titulo="Tipo de Visitantes por asunto Historicos";
		}
	break;
	}

if ($grafico_titulo!="")
	{
	// Dataset definition 
	$DataSet = new pData;
	$DataSet->AddPoint($tipo_total,"Resultado");
	$DataSet->AddPoint($tipo,"Tipo");
	//$DataSet->AddPoint(array(89,500,1000,100,1),"Serie1");
	$DataSet->AddAllSeries();
	$DataSet->SetAbsciseLabelSerie("Tipo");
	
	// Initialise the graph
	$Test = new pChart(500,200);	//Tamaño de Imagen
	$Test->drawFilledRoundedRectangle(7,7,293,193,5,240,240,240);
	$Test->drawRoundedRectangle(5,5,295,195,5,230,230,230);
	
	// Draw the pie chart
	$Test->setFontProperties("Fonts/tahoma.ttf",8);
	$Test->drawFlatPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),120,100,60,PIE_PERCENTAGE,10);
	$Test->drawPieLegend(230,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);
	
	$Test->Render("tmp/visitante_h_t_c.png");

?>
	<center><b><?php echo $grafico_titulo?></b></center>
	<center><img src="tmp/visitante_h_t_c.png"></center>
<?php
	}
?>
