<?php
session_start();
error_reporting (0);
ini_set('memory_limit','2048M');
ini_set('max_execution_time','0');
/**
 * Logiciel : exemple d'utilisation de HTML2PDF
 * 
 * Convertisseur HTML => PDF, utilise fpdf de Olivier PLATHEY 
 * Distribué sous la licence GPL. 
 *
 * @author		Laurent MINGUET <webmaster@spipu.net>
 *
 * SetDisplayMode : permet de choisir le mode d'affichage par defaut
 * 
 * isset($_GET['vuehtml']) n'est pas obligatoire
 * il permet juste d'afficher le résultat au format HTML
 * si le paramètre 'vuehtml' est passé en paramètre _GET
 */

	//Inicio cabecera
	$fecha_reporte=$_POST['fecha_reporte'];
	$cabecera="<link rel='stylesheet' href='sca_estilo_rerporte.css' type='text/css'/>";
	$cabecera=$cabecera."<table>";
	$cabecera=$cabecera."<tr>";
	$cabecera=$cabecera."<td style='width: 20%;'><img src='imagenes/logo.jpg' width='90' height='50' border='0'/></td>";
	$cabecera=$cabecera."<td style='width: 80%;'>Ministerio del Poder Popular para la Cultura <br> SCA - Sistema de Control de Acceso y Correspondencia<br> $fecha_reporte  <br><b>Reporte de Historial de Visitantes</b></td>";
	$cabecera=$cabecera."</tr>";
	$cabecera=$cabecera."</table>";
	//Fin cabecera
	
	//Inicio Titulos Tabla
	$html="";
	$html=$html."<table>";
	$html=$html."<tr>";
	$html=$html."<td class='celdas' style='width: 8%;'>Cedula</td>";
	$html=$html."<td class='celdas' style='width: 10%;'>Apellido</td>";
	$html=$html."<td class='celdas' style='width: 10%;'>Nombre</td>";
	$html=$html."<td class='celdas' style='width: 10%;'>Tipo de visitante</td>";
	$html=$html."<td class='celdas' style='width: 11%;'>Procedencia</td>";
	$html=$html."<td class='celdas' style='width: 11%;'>Destino</td>";
	$html=$html."<td class='celdas' style='width: 7%;'>Fecha de Entrada</td>";
	$html=$html."<td class='celdas' style='width: 7%;'>Fecha de Salida</td>";
	$html=$html."<td class='celdas' style='width: 10%'>Asunto</td>";
	$html=$html."<td class='celdas' style='width: 10%;'>Observación</td>";
	$html=$html."<td class='celdas' style='width: 6%;'>Nro de Carnet</td>";
	$html=$html."</tr>";
	//Inicio Fin Tabla
	
	$html_fin="</table>";
	
	$html_c=$_POST['html_c'];
	$contenido=$cabecera.$html.$html_c.$html_fin;

 	// récupération du contenu HTML
 	ob_start();
// 	include(dirname(__FILE__).'/resultado.html');
	$content = ob_get_clean();

	// conversion HTML => PDF
	require_once(dirname(__FILE__).'/lib/html2pdf_v3.19/html2pdf.class.php');
	$html2pdf = new HTML2PDF('P','A4', 'fr');
	$html2pdf->pdf->SetDisplayMode('fullpage');
//	$content=$_POST['html'];
	$content=$contenido;
	$content=stripslashes($content);
	$content=nl2br($content);

//	$html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
	$html2pdf->WriteHTML($content);
	$html2pdf->Output('visitantes.pdf');

	$_SESSION['tabla_reporte']="visitantes_h";
	require_once("sca_reporte_historial.php");
?>