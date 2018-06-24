<?php
 /*
     Example13: A 2D exploded pie graph
 */
include_once ("../../sca_precarga.php");
// Standard inclusions   
include("pChart/pData.class");
include("pChart/pChart.class");


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

$Test->Render("visitantes_asuntos_t.png");

	//visitantes_t Tipo
//	$sql_c = "select a.fecha_s, b.id_asunto, c.tipo from visitantes_h a, visitantes b, visitantes_t c where a.fecha_s='0000-00-00 00:00:00' and a.cedula=b.cedula and b.id_asunto=c.id_asunto "; 
	//$sql_c = "select * from visitantes_h where fecha_s='0000-00-00 00:00:00'"; 
//	$sql_c=sql_c($sql_c);
//	if (!(@mysql_num_rows ($sql_c) == 0))
//		{
//		while ($campo = mysql_fetch_array ($sql_c))
//			{
//			$id_visitante_h=$campo['id_visitante_h'];
//			$id_asunto=$campo['id_asunto'];
//			$tipo=$campo ['tipo'];
//			}


?>
<center><b>Visitantes actuales por tipo de Asuntos</b></center>
<center><img src="visitantes_asuntos_t.png"></center>