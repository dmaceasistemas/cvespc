<?php
include_once("../sca_sesiones.php");
error_reporting (0); 
include_once ("../sca_funciones.php");
include_once ("../sca_fecha.php");/*Archivo de Fechas*/
$url_origen=$_SERVER['PHP_SELF'];
include_once ("../sca_historial_modulo_i.php");//Historiales de Modulos
conectar_mincul_corr();
?>

<?php
$depl=$_POST['depl'];
?>

<form id="form2" name="arbol2" method="post" action="" autocomplete=off>
  <table border="1" align="center" cellpadding="2" cellspacing="0">
    	<tr><td><input name="depl" type="text" value= "<?php echo $depl?>"></td>
	<td><div align="center"><input name="buscar" type="submit" value="Buscar"/></div></td></tr>
    </tr>
  </table>
</form>


<link href="../sca_estilo.css" rel="stylesheet" type="text/css" />
<link href="css/folder-tree-static.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/folder-tree-static.js"></script>
<script language="JavaScript">
<?php
if($_GET['id_accion']!=2)
	{
		?>
		function actualizaPadre(codigo_bandeja,ruta){
			<?php
			/*+
			if($_GET['remi']==1):
			?>
			window.opener.document.CASO.codigo_remi.value = codigo_bandeja
			window.opener.document.CASO.remitente.value = ruta
			<?php
			endif;
			*/
			?>
			<?php
			if($_GET['rec']==1):
			?>
			window.opener.document.nuevo_emisor.cod_emisor.value = codigo_bandeja
			window.opener.document.nuevo_emisor.emisor.value = ruta
			/*window.opener.document.CASO.codigo_receptor.value = codigo_bandeja
			window.opener.document.CASO.receptor.value = ruta*/
			<?php
			endif;
			/*
			?>
			<?php
			if($_GET['int']==1):
			?>
			window.opener.document.CASO.codigo_inter.value = codigo_bandeja
			window.opener.document.CASO.nomb_interm.value = ruta
			<?php
			endif;*/
			?>
			<?php
			if(($_GET['nue_emi']==1) or ($_GET['des']==1) or ($_GET['corr_emi']==1)):
			?>
			window.opener.document.nuevo_emisor.cod_emisor.value = codigo_bandeja
			window.opener.document.nuevo_emisor.emisor.value = ruta
			<?php
			endif;
			?>
			<?php
			if(($_GET['int']==1) or ($_GET['des']==2)):
			?>
			window.opener.document.nuevo_emisor.cod_procedencia.value = codigo_bandeja
			window.opener.document.nuevo_emisor.procedencia.value = ruta
			<?php
			endif;
			?>
			cerrarse();
		}
		<?php
	}
?>
function cerrarse(){
window.close()
}
function pasar_emisores()
	{
		alert(document.arbol.emisores[0].value);
		window.opener.document.CASO.codigo_dest.value = document.getElementById('emisores_arr').value;
	}
</script> 
<div id="nuevo_particular"></div>
<table align="center" cellpadding="5" cellspacing="3" style="background-color:#CCCCCC;" width="100%" class="tabla_sql">
<?php /*<tr><td>Examinador de Visitantes</td></tr>*/?>
</table>

<form name="arbol" method="post">
<table align="center" cellpadding="5" cellspacing="3" style="background-color:#EEEEEE;" width="100%" class="tabla_arbol">
  <tbody>
    <tr>
      <td colspan="2" valign="top" style="background-color:#FFFFFF; border: 1px dashed #445675;">
		<?php
		$htm_axu="";
		function ArmarArbolHijo($cod_padre, $ls_criterio, $depl)
		{
			$long = strlen($cod_padre);
			$sql_hijo="
					SELECT * FROM temisor 
					WHERE codigo LIKE '$cod_padre%' 
					AND LENGTH(codigo)=$long+4 AND estatus=0 AND tipo_emisor = 0 
					ORDER BY codigo ASC
			";
			//echo "<h5>$sql_hijo</h5><br/>";
			$query_hijo=mysql_query($sql_hijo) or die(mysql_error());
			//echo "Resultado:".pg_num_rows($query_hijo).">0<br>";
			if(mysql_num_rows($query_hijo)>0)
			{
				//echo "dentro del if<br>";
				$htm_axu.="<ul>";
				while($row=mysql_fetch_array($query_hijo))
				{
					$codigo_bandeja=$row['codigo'];
					$ruta_bandeja=$row['depl'];
					$nombre=$row['nomb'].' '.$row['apel'];
					$coincidencia=eregi($depl, $ruta_bandeja);
					
					if ($coincidencia==1)
						{
						//Texto resaltado en amarillo
						$b1="<b><span style='background-color: yellow'>";
						$b2="</b></span>";
						$conteo_r++;
						}
					$coincidencia="";
					if($_GET['emi']==1)
						{
							$htm_axu.="<li><a href=\"javascript:creaCampoEmi('$codigo_bandeja','$ruta_bandeja','$nombre');\">$b1".$row['depl']."$b2</a>";
						}
					elseif($_GET['dest']==1)
						{
							$htm_axu.="<li><input type='checkbox' name='emisores[]' value='".$row['codigo']."' id='emisores_arr' /><a href=\"#\">$b1".$row['depl']."$b2</a>";
						}
					else
						{
							$htm_axu.="<li><a href=\"javascript:actualizaPadre('$codigo_bandeja','$ruta_bandeja')\">$b1".$row['depl']."$b2</a>";
						}
					$b1="";
					$b2="";
					//echo $htm_axu;
					$htm_axu.=ArmarArbolHijo($row['codigo'], $ls_criterio, $depl);
					$htm_axu.="</li>";
				}
				$htm_axu.="</ul>";
			}
			return $htm_axu;
		}
		
		if(isset($_GET['cod']))
			{
				$long_emi = strlen($_GET['cod']);
				$query=mysql_query("SELECT * FROM temisor WHERE codigo LIKE '$_GET[cod]%' AND LENGTH(codigo)=$long_emi+2 AND estatus=0 AND tipo_emisor = 0 ORDER BY codigo ASC");
			}
		elseif(($_GET['rec']==1) or ($_GET['des']==1) or ($_GET['des']==2))
			{
				$query=mysql_query("SELECT * FROM temisor WHERE (codigo = '0001' OR codigo = '0002') AND estatus=0 AND tipo_emisor = 0 ORDER BY codigo ASC") or die(mysql_error());
				
			}
		elseif($_GET['remi']==1)
			{
				$query=mysql_query("SELECT * FROM temisor WHERE (codigo = '0001' OR codigo = '0002') AND estatus=0 ORDER BY codigo ASC");
			}
		elseif($_GET['corr_emi']==1)
			{
				$query=mysql_query("SELECT * FROM temisor WHERE (codigo = '0002' or codigo = '0003') AND estatus=0 AND tipo_emisor = 0 ORDER BY codigo ASC") or die(mysql_error());
			}
		else
			{
				$query=mysql_query("SELECT * FROM temisor WHERE LENGTH(codigo)=4 AND estatus=0 AND tipo_emisor = 0 ORDER BY codigo ASC");
			}
		
		$html="<ul id=\"ejemplo1\" class=\"dhtmlgoodies_tree\">";
		while($row=mysql_fetch_array($query))
			{
				$codigo_bandeja=$row['codigo'];
				$ruta_bandeja=$row['depl'];
				$nombre = $row['nomb'].' '.$row['apel'];
				if($_GET['emi']==1)
					{
						$html.="<li><a href=\"javascript:creaCampoEmi('$codigo_bandeja','$ruta_bandeja','$nombre');\">".$row['depl']."</a>";
					}
				elseif($_GET['dest']==1)
					{
						$html.="<li><a href=\"#\">".$row['depl']."</a>";
					}
				else
					{
						$html.="<li><a href=\"javascript:actualizaPadre('$codigo_bandeja','$ruta_bandeja')\">".$row['depl']."</a>";
					}
				
				$html.=ArmarArbolHijo($row['codigo'], $ls_criterio, $depl);
				$html .= "</li>";
			}
		$html .= "</ul>";
		echo $html;
		?>
       <a href="#"  onclick="expandAll('ejemplo1');return false">Expandir todos</a>
	   <a href="#" onclick="collapseAll('ejemplo1');return false">Contraer todos</a></td>
    </tr>
	<tr>
		<td>
			<input type=button class="boton" onclick="cerrarse()" value="Cerrar">
		</td>
	</tr>
  </tbody>
</table>
</form>

<?php
	if ($depl!="") 
		{
?>

<form name="arbol2" method="post">
<table align="center" cellpadding="5" cellspacing="3" style="background-color:#EEEEEE;" width="100%">
<tr>
 <td colspan="2" valign="top" style="background-color:#FFFFFF; border: 1px dashed #445675;">
<?php
	$ruta_bandeja_2=array();
	$sql_depl="Select * FROM temisor WHERE depl LIKE '%$depl%'";
	$sql_depl=mysql_query($sql_depl) or die(mysql_error());
	if(mysql_num_rows($sql_depl)>0)
		{
		while($row=mysql_fetch_array($sql_depl))
			{
			$codigo_bandeja=$row['codigo'];
			
			//Validacion de Muestreo
			$num = 4;
			$codigo = substr($codigo_bandeja, 0, $num);
			$valido=0;
			if((($_GET['rec']==1) or ($_GET['des']==1) or ($_GET['des']==2)) and (($codigo == "0001") or ($codigo == "0002")))
				$valido=1;
			
			if(($_GET['corr_emi']==1) and (($codigo == "0002") or ($codigo == "0003")))
				$valido=1;

			if ($_GET['int']==1)
				$valido=1;

			if ($valido==1)
				{

			$ruta_bandeja=$row['depl'];
			$long = strlen($codigo_bandeja);
			$num = 4;
			$i=0;
			$array_ruta_bandeja=array();
			$codigo_substr=$codigo_bandeja;
			while ($long >$num)
				{
				$codigo_substr = substr($codigo_substr, 0, -$num);
				$long = strlen($codigo_substr);
				$sql_padre="Select * FROM temisor WHERE codigo ='$codigo_substr' and estatus=0  AND tipo_emisor = 0";
				$sql_padre=mysql_query($sql_padre) or die(mysql_error());
				if(mysql_num_rows($sql_padre)>0)
					{
					while($row2=mysql_fetch_array($sql_padre))
						{
						$array_ruta_bandeja[$i]=$row2['depl'];
						$i++;
						}
					}
				}
			$count_array_ruta_bandeja= count($array_ruta_bandeja);
			$count_array_ruta_bandeja=$count_array_ruta_bandeja-1;
			//$html="<ul id=\"ejemplo1\" class=\"dhtmlgoodies_tree\">";
			for ($i=$count_array_ruta_bandeja; $i>=0; $i--)
				{
				echo "$array_ruta_bandeja[$i] > ";
				//echo"<li><a href=\"javascript:actualizaPadre('$codigo_bandeja','$array_ruta_bandeja[$i]')\">".$array_ruta_bandeja[$i]."</a></li>";
				}
			//$html=$html."<ul id=\"ejemplo1\" class=\"dhtmlgoodies_tree\">";
			$html="<a href=\"javascript:actualizaPadre('$codigo_bandeja','$ruta_bandeja')\">".$ruta_bandeja."</a>";
			//$html="<li><a href=\"javascript:actualizaPadre('$codigo_bandeja','$ruta_bandeja')\">".$ruta_bandeja."</a></li>";
			echo $html;
			echo "<hr>";
			}
				}
			$valido=0;
		}
?>
</td>
</tr>
</table>
</form>

<?php
	}
?>