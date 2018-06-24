<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include_once ("sca_funciones.php");
conectar();

if(isset($_GET['mun']) && $_GET['mun']==1)
	{
		include 'sca_entidades_ajax_c.php';
		exit();
	}
if(isset($_GET['par']) && $_GET['par']==1)
	{
		include 'sca_entidades_ajax_c.php';
		exit();
	}
if(isset($_GET['cp']) && $_GET['cp']==1)
	{
		include 'sca_entidades_ajax_c.php';
		exit();
	}
?>