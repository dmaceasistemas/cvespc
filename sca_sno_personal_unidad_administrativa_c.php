<?php


session_start();
if(!array_key_exists("la_logusr",$_SESSION))
{
	//include_once ("sca_precarga.php");
include_once ("sca_funciones.php");
$arreglo_bd=bases_sigesp_principal();
echo "<link rel='stylesheet' href='sca_estilo.css' type='text/css'/>";//Carga el Estilo de la Pagina Web
$ls_codnom="";
$as_tipo="";
}


//-----------------------------------------------------------------------------------------------------------------------------------
	function uf_print($as_codper, $as_cedper, $as_nomper, $as_apeper, $as_codnom, $as_tipo)
   	{
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//	     Function: uf_print
		//		   Access: public
		//	    Arguments: as_codper  // C�digo de Personal
		//				   as_cedper  // C�dula de Pesonal
		//				   as_nomper  // Nombre de Personal
		//				   as_apeper // Apellido de Personal
		//				   as_codnom // c�digo de n�mina a la que pertenece
		//				   as_tipo  // Tipo de Llamada del cat�logo
		//	  Description: Funci�n que obtiene e imprime los resultados de la busqueda
		//	   Creado Por: Ing. Yesenia Moreno
		// Fecha Creaci�n: 01/01/2006 								Fecha �ltima Modificaci�n : 
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		global $io_fun_nomina;
		require_once("../shared/class_folder/sigesp_include.php");
		$io_include=new sigesp_include();
		$io_conexion=$io_include->uf_conectar();
		require_once("../shared/class_folder/class_sql.php");
		$io_sql=new class_sql($io_conexion);	
		require_once("../shared/class_folder/class_mensajes.php");
		$io_mensajes=new class_mensajes();		
		require_once("../shared/class_folder/class_funciones.php");
		$io_funciones=new class_funciones();		
   		require_once("sigesp_sno.php");
		$io_sno=new sigesp_sno();				
        $ls_codemp=$_SESSION["la_empresa"]["codemp"];
		print "<table width=500 border=0 cellpadding=1 cellspacing=1 class=fondo-tabla align=center>";
		print "<tr class=titulo-celda>";
		print "<td width=60>C&oacute;digo</td>";
		print "<td width=40>C&eacute;dula</td>";
		print "<td width=340>Nombre y Apellido</td>";
		print "<td width=60>Estatus</td>";
		print "</tr>";
		$ls_sql="SELECT sno_personal.codper, sno_personal.cedper, sno_personal.nomper, sno_personal.apeper, ".
				"  FROM sno_personal".
				"  WHERE sno_personal.codemp='".$ls_codemp."'".
				"   AND sno_profesion.codemp = sno_personal.codemp ".
				"   AND sno_personal.codper like '".$as_codper."' ".
				"   AND sno_personal.cedper like '".$as_cedper."'".
				"   AND sno_personal.nomper like '".$as_nomper."' ".
				"   AND sno_personal.apeper like '".$as_apeper."'";
	
		
		print "</table>";
		unset($io_include);
		unset($io_conexion);
		unset($io_sql);
		unset($io_mensajes);
		unset($io_funciones);
		unset($io_sno);
		unset($ls_codemp);
	}
	//-----------------------------------------------------------------------------------------------------------------------------------
	?>
	
<form name="form1" method="post" action="" autocomplete="off">
  <p align="center">
    <input name="operacion" type="hidden" id="operacion">
</p>
  <table width="500" border="0" align="center" cellpadding="1" cellspacing="1" class=tabla_sql>
    <tr>
      <td width="496" height="20" colspan="2" class="celdas"><div align="center">Cat&aacute;logo de Personal</div></td>
    </tr>
  </table>
<br>
    <table width="500" border="0" cellpadding="2" cellspacing="0" align="center" class=tabla_sql>
      <tr>
        <td width="100" height="22" class="celdas"><div align="right">C&oacute;digo</div></td>
        <td colspan="2"><div align="left">
          <input name="txtcodper" type="text" id="txtcodper" size="30" maxlength="10" onKeyPress="javascript: ue_mostrar(this,event);">        
        </div></td>
      </tr>
      <tr>
        <td height="22" class="celdas"><div align="right">C&eacute;dula</div></td>
        <td colspan="2" ><div align="left">
          <input name="txtcedper" type="text" id="txtcedper" size="30" maxlength="10" onKeyPress="javascript: ue_mostrar(this,event);">
        </div></td>
      </tr>
      <tr>
        <td height="22" class="celdas"><div align="right">Nombre</div></td>
        <td colspan="2"><div align="left">
          <input name="txtnomper" type="text" id="txtnomper" size="30" maxlength="60" onKeyPress="javascript: ue_mostrar(this,event);">
        </div></td>
      </tr>
      <tr>
        <td height="22" class="celdas"><div align="right">Apellido</div></td>
        <td><div align="left">
          <input name="txtapeper" type="text" id="txtapeper" size="30" maxlength="60" onKeyPress="javascript: ue_mostrar(this,event);">
        </div></td>
	<td height="22"><div align="right"><a href="javascript: ue_search();">
          <img src="imagenes/buscar.gif" alt="Buscar" width="20" height="20" border="0"> Buscar</a></div></td>
      </tr>
  </table>
  <br>

<?php

$ls_operacion=$_POST['operacion'];
if($ls_operacion=="BUSCAR")
	{
//Select de PErsonal con Unidad administrativa
 	$ls_codper="%".$_POST["txtcodper"]."%";;
	$ls_cedper="%".$_POST["txtcedper"]."%";
	$ls_nomper="%".$_POST["txtnomper"]."%";
	$ls_apeper="%".$_POST["txtapeper"]."%";
	$ls_criterio="";
	
	
?>
<table width=600 border=1 cellpadding="2" cellspacing="0" align=center class=tabla_sql>
<tr class="celdas"><td>Codigo</td><td>Cedula</td><td>Nombre y Apellido</td></tr>
</table><br/>
<?php
			
		
	}
?>
<script language="JavaScript">
	
function ue_search()
{
	f=document.form1;
  	f.operacion.value="BUSCAR";
  	f.action="sca_sno_personal_unidad_administrativa_c.php?codnom=<?PHP print $ls_codnom;?>&tipo=<?PHP print $as_tipo;?>";
  	f.submit();
}

function ue_mostrar(myfield,e)
{
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	if (keycode == 13)
	{
		ue_search();
		return false;
	}
	else
		return true
}
function cerrarse(){
window.close();
}




</script>