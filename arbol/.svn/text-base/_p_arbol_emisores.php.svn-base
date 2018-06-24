<?php
error_reporting (0); 
include_once ("../sca_funciones.php");
//header('Content-Type: text/html; charset=UTF8');
//mysql_connect('localhost','root','') or die(mysql_error());
//bd_mincul_corr();
conectar_mincul_corr();
//mysql_select_db('p_mincul_corr')or die(mysql_error());
?>
<?php
if($_POST['listof']==1)
	{
		foreach($_POST['emisores'] as $idemi)
			{
				$lista .= $idemi.',';
				$lista_nom .= dependenciaEmisor($idemi).',';
			}
		?>
		<script language="javascript">
		window.opener.document.CASO.codigo_dest.value = '<?=$lista?>';
		window.opener.document.CASO.destinatario.value = '<?=$lista_nom?>';
		window.close();
		</script>
		<?php
		exit();
	}
?>
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
  <?php
  if($_GET['dest']==1)
  	{
	?>
	<tr>
		<td colspan="2"><input type="submit" class="boton" value="Listo"><input name="listof" type="hidden" value="1" /></td>
	</tr>
	<?php
	}
  ?>
    <tr>
      <td colspan="2" valign="top" style="background-color:#FFFFFF; border: 1px dashed #445675;">
		<?php
		$htm_axu="";
		function ArmarArbolHijo($cod_padre)
		{
			$long = strlen($cod_padre);
			$sql_hijo="
					SELECT * FROM temisor 
					WHERE codigo LIKE '$cod_padre%' 
					AND LENGTH(codigo)=$long+4 AND estatus=0 AND tipo_emisor = 0
					ORDER BY codigo ASC
			";					
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
					
					if($_GET['emi']==1)
						{
							$htm_axu.="<li><a href=\"javascript:creaCampoEmi('$codigo_bandeja','$ruta_bandeja','$nombre');\">".$row['depl']."</a>";
						}
					elseif($_GET['dest']==1)
						{
							$htm_axu.="<li><input type='checkbox' name='emisores[]' value='".$row['codigo']."' id='emisores_arr' /><a href=\"#\">".$row['depl']."</a>";
						}
					else
						{
							$htm_axu.="<li><a href=\"javascript:actualizaPadre('$codigo_bandeja','$ruta_bandeja')\">".$row['depl']."</a>";
						}
					
					//echo $htm_axu;
					$htm_axu.=ArmarArbolHijo($row['codigo']);
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
				
				$html.=ArmarArbolHijo($row['codigo']);
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