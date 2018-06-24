<?php
	//Inicio Para colocar la hora actual Temporal
	//	$server_name = $_SERVER['SERVER_NAME']; //Esto da el Nombre del Servidor.
	//	if ($server_name=="sucre")
	$ip_server = $_SERVER['SERVER_ADDR']; //Esto da la ip del Servidor.
	if (($ip_server!="172.16.1.125") and ($ip_server!="127.0.0.1"))
		date_default_timezone_set("Etc/GMT+4");	//Temporal para el servidor sucre
	//Fin Para colocar la hora actual Temporal

	//$fecha_servidor  = date ("j/n/Y H:i");
	$fecha_larga  = date ("Y-m-d H:i:s");
	$fecha_larga_simple  = date ("YmdHis");
	//print ("$fecha");
	//$hoy = date("F j, Y, g:i a"); 
	//print ("$hoy");
?>
