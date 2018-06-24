<?php
	include_once("sca_sesiones.php");
	error_reporting (0); 
//	header('Content-Type: text/html; charset=UTF8');
	header('Content-Type: text/html; charset=ISO-8859-1');
	echo "<title> Sistema de Control de Acceso y Correspondencia</title>";
	include_once("sca_logo.php"); // Logo del Ministerio
	echo "<link rel='stylesheet' href='sca_estilo.css' type='text/css'/>";//Carga el Estilo de la Pagina Web
	echo "<link rel='shortcut icon' href='imagenes/favicon.ico'/>";
//	include("sca_conexion.php"); //Conexion Base de Datos
	include_once("sca_funciones.php"); //Funciones
	linea();//Anexado Linea
	$url_origen=$_SERVER['PHP_SELF'];
	include_once("sca_menu.php"); //Inclusion del Menu 
	echo "<br/>";
	include_once ("sca_mensaje.php");
	include_once ("sca_fecha.php");/*Archivo de Fechas TEMPORAL HASTA RESOLVER LAS FECHAS DE LOS FORMULARIOS*/
//	include ("sca_constantes.php"); /*Modulo de Constanstes*/
/*	$script_actual=$_SERVER['SCRIPT_NAME'];//Contiene la ruta del script actual
	$explode = explode("/", $script_actual);
	$conteo_final=count ($explode);
	$conteo_final=$conteo_final-1;
	$script=$explode[$conteo_final];
	if ((!isset($_SESSION['sca_id_u_activo']))and($script!="sca_acceso.php"))
		{
		$url_index2='http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) .'/sca_acceso.php';//Captacion del URL del Servidor
		$dato="Disculpe su Sesión ha Expirado por Inactividad";
		$mensaje=2;
	   	echo "<meta http-equiv='refresh' content='0;URL=sca_acceso.php?mensaje=$mensaje&dato=$dato'/>";//Meta para ir a la pagina del Incluir
		}*/
?>
<script src="js/funciones.js" type="text/javascript"></script>
<script src="js/ajax.js" type="text/javascript"></script>
<script src="js/entidades.js" type="text/javascript"></script>