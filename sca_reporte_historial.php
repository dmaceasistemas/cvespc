<?php
//Modulo de Historial de Reportes
include_once ("sca_sesiones.php");/*Archivo de Sesiones*/
error_reporting (0); /*Recordar Quitar Descomentar cuando se use el Sistema Futuro*/
include_once ("sca_fecha.php");/*Archivo de Fechas*/
include_once ("sca_funciones.php");

	$script_actual=$_SERVER['SCRIPT_NAME'];//Contiene la ruta del script actual
	$explode = explode("/", $script_actual);
	$conteo_final=count ($explode);
	$conteo_final=$conteo_final-1;
	$script=$explode[$conteo_final];

	$ip_acceso_u=ip_real();//IP real Saltando Proxy
	$id_registro="reporte";
	$tabla=$_SESSION['tabla_reporte'];
	$campo=$script;
	$contenido="Generacion de Reporte PDF";
	unset($_SESSION['tabla_reporte']);
	historial($id_registro, $tabla, $contenido, $campo, $sca_id_u_activo, $ip_acceso_u, $fecha_larga);
?>