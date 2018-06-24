<?php 
	include("sca_precarga.php"); //Inclusion del Modulo Precarga.php
	/*Modulo de Administrador Consulta de Historial*/
	include ("metacalendario.php");
	conectar();
?>

<?php
if (!(empty($sca_id_u_activo)))
{
?>

<?php
//Inicio Where Historial
@$id_usuario2=$_REQUEST['w_id_usuario'];
@$fecha_desde=$_REQUEST['w_desde'];
@$fecha_hasta=$_REQUEST['w_hasta'];
@$fecha_desde2=$fecha_desde;
@$fecha_hasta2=$fecha_hasta;
if (!(empty($fecha_desde)))
	$fecha_desde="$fecha_desde 00:00:00";
if (!(empty($fecha_hasta)))
	$fecha_hasta="$fecha_hasta 24:60:60";
@$tabla2=$_REQUEST['w_tabla'];
$where_h="&w_id_usuario=$id_usuario2&w_desde=$fecha_desde2&w_hasta=$fecha_hasta2&w_tabla=$tabla2";

$where_historial="";
if (!(empty($id_usuario2)))
	{
	if (empty($where_historial))
		$where_historial="where id_usuario='$id_usuario2'";
	else
		$where_historial="$where_historial and id_usuario='$id_usuario2'";
	}

if (!(empty($fecha_desde)) and (!(empty($fecha_hasta))))
	{
	if (empty($where_historial))
		$where_historial="where fecha>='$fecha_desde' and fecha<='$fecha_hasta'";
	else
		$where_historial="$where_historial and fecha>='$fecha_desde' and fecha<='$fecha_hasta'";
	}
	else
	{
	if (!(empty($fecha_desde)))
		{
		if (empty($where_historial))
			$where_historial="where fecha>='$fecha_desde'";
		else
			$where_historial="$where_historial and fecha>='$fecha_desde'";
		}
	if (!(empty($fecha_hasta)))
		{
		if (empty($where_historial))
			$where_historial="where fecha<='$fecha_hasta'";
		else
			$where_historial="$where_historial and fecha<='$fecha_hasta'";
		}
	}

if (!(empty($tabla2)))
	{
	if (empty($where_historial))
		$where_historial="where tabla='$tabla2'";
	else
		$where_historial="$where_historial and tabla='$tabla2'";
	}

//Fin Where Historial
?>


<div align="center"><b>Consulta de Historial Avanzada</b><br>
  <br></div>

<form id="form1" name="form1" method="post" action="">
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr><!--<td colspan="10" class="celdas"><div align="center">Por Fecha del Caso </div></td>-->
  </tr>
<tr>
  <td class="celdas">Desde
    <input  name="w_desde" type="text" id="campo_fecha1" size="10" value="<?php echo $fecha_desde2?>"/>
	<script type="text/javascript">
		Calendar.setup({
		inputField : "campo_fecha1", // id del campo de texto
		ifFormat : "%Y-%m-%d", // formato de la fecha que se escriba en el campo de texto
		button : "lanzador" // el id del botón que lanzará el calendario
		});
	</script></td>
	<td class="celdas">Hasta
	  <input  name="w_hasta" type="text" id="campo_fecha2" size="10"  value="<?php echo $fecha_hasta2?>"/>
	<script type="text/javascript">
		Calendar.setup({
		inputField : "campo_fecha2", // id del campo de texto
		ifFormat : "%Y-%m-%d", // formato de la fecha que se escriba en el campo de texto
		button : "lanzador" // el id del botón que lanzará el calendario
		});
	</script></td>
</td><td class="celdas"></td>

<td class="celdas">Usuario<select name="w_id_usuario">
<?php	
	echo "<option></option>";
	$sql_c="select * from usuarios";
	$sql_c=sql_c($sql_c);
	if (!(@mysql_num_rows ($sql_c) == 0))
		{
		while ($campo = mysql_fetch_array($sql_c))
			{
			$id_usuario_tabla=$campo['id_usuario'];
			if ($id_usuario_tabla==$id_usuario2)
				{
				echo "<option value='$id_usuario_tabla' selected='selected'>$id_usuario_tabla</option>";
				}
			else
				{
				echo "<option value='$id_usuario_tabla'>$id_usuario_tabla</option>";
				}
			}
		}
?>
	</select>
</td>
<td class="celdas">Tabla<select name="w_tabla">
<?php	
	echo "<option></option>";
	$sql_c = "show tables";
	$sql_c = sql_c($sql_c);
	if (!$sql_c) 
		{
    		echo 'MySQL Error: ' . mysql_error();
    		exit;
		}
	while ($tabla = mysql_fetch_row($sql_c)) 
		{
		if ($tabla[0]==$tabla2)
			echo "<option value='{$tabla[0]}' selected='selected'>{$tabla[0]}</option>";
		else
			echo "<option value='{$tabla[0]}'>{$tabla[0]}</option>";
		}
			
?>
	</select>
</td>
	<td class="celdas">
	  <label for="Submit"></label>
	  <input type="submit" name="Submit" value="Buscar"/>
	</td>
</tr>
</table>
</form>

<?php
	//Inicio Limitador de SQL "Limit"
	@$numero=$_GET['numero'];
	@$muestra=$_GET['muestra'];
	if (empty ($numero))
			$numero_inicio=0;
		else
			$numero_inicio=$numero;
		
	/*$muestra="select valores from tipos where id_tipo='id_muestra'";
	$muestra = mysql_db_query($mydb,$muestra) or die("error en la consulta de la Cantidad de Muestras: ".mysql_error());
	while ($campo = mysql_fetch_array($muestra))
		{
		$muestra_total=$campo["valores"];
		}
	$muestra=$muestra_total;*/
	$muestra=20;
	$limitador="Limit $numero_inicio,$muestra";//Nuevo Limitador para muestra de resultados =) v2
	//Fin Limitador
?>

<?php 
	//Inicio Orden de SQL
	$orden="";
	@$id_historial=$_GET['id_historial'];
	@$id_usuario=$_GET['id_usuario'];
	@$ip_acceso=$_GET['ip_acceso'];
	@$fecha=$_GET['fecha'];
	@$id_registro=$_GET['id_registro'];
	@$tabla=$_GET['tabla'];
	@$campo=$_GET['campo'];
	@$contenido=$_GET['contenido'];

	if (!(empty($id_historial)))
		$orden="ORDER BY id_historial $id_historial";
	if (!(empty($id_usuario)))
		$orden="ORDER BY id_usuario $id_usuario";
	if (!(empty($ip_acceso)))
		$orden="ORDER BY ip_acceso_u $ip_acceso";
	if (!(empty($fecha)))
		$orden="ORDER BY fecha $fecha";
	if (!(empty($id_registro)))
		$orden="ORDER BY id_registro $id_registro";
	if (!(empty($tabla)))
		$orden="ORDER BY tabla $tabla";
	if (!(empty($campo)))
		$orden="ORDER BY campo $campo";
	if (!(empty($contenido)))
		$orden="ORDER BY contenido $contenido";
		
	if ($id_historial=="ASC")
		$orden_id_historial="DESC";
	else
		$orden_id_historial="ASC";

	if ($id_usuario=="ASC")
		$orden_id_usuario="DESC";
	else
		$orden_id_usuario="ASC";

	if ($ip_acceso=="ASC")
		$orden_ip_acceso="DESC";
	else
		$orden_ip_acceso="ASC";

	if ($fecha=="ASC")
		$orden_fecha="DESC";
	else
		$orden_fecha="ASC";

	if ($id_registro=="ASC")
		$orden_id_registro="DESC";
	else
		$orden_id_registro="ASC";
	
	if ($tabla=="ASC")
		$orden_tabla="DESC";
	else
		$orden_tabla="ASC";

	if ($campo=="ASC")
		$orden_campo="DESC";
	else
		$orden_campo="ASC";

	if ($contenido=="ASC")
		$orden_contenido="DESC";
	else
		$orden_contenido="ASC";
	//Fin Orden de SQL
?>

<br />

<?php
//Inicio ConTaDoR de registros
	@$sql_c="select count(*) from historiales $where_historial";
	$sql_c= sql_c($sql_c);
	$conteo_r= mysql_result($sql_c,0);	//Nueva Funcion: int mysql_result ( int id_resultado, int numero_de_fila [, mixed campo])			
//Fin  ConTaDoR de registros
?>

<table border="0" align="center" cellpadding="2" cellspacing="0">
	<tr><td>
<?php 
	$filas_inicio=$numero_inicio+1;
	$filas_final=$muestra+$numero_inicio;
	if ($filas_final>$conteo_r)
		{
		$filas_final=$conteo_r;
		}
	if ($conteo_r==0)
		$filas_inicio=0;

	//Inicio Reseteador del Muestra
	if ($numero_inicio>$conteo_r)
		{
		$limitador="Limit 0,$muestra";//Nuevo Reseteador de Limitador para muestra de resultados =) v3
		$filas_inicio=0;
		$numero_inicio=0;
		}
	//Fin Reseteador del Muestra
  	echo "Resultados $filas_inicio - $filas_final de $conteo_r Registros";
?>
</td></tr>
</table>

<?php
//Inicio Divisor de Paginas
$paginas=$conteo_r/$muestra;
$entero=(int)$paginas;
//echo "<br>ENTERO: $entero";
if ($paginas>$entero)
	$entero=$entero+1;
//echo "<br>PAGINAS: $paginas";
//echo "<br>ENTERO: $entero";
//Fin  Divisor de Paginas
//$entero=is_int($paginas); //Detecta si es Entero o Cifras en Decimal
?>

<?php
	//Inicio modulo de Orden
	$orden_ant_sig="";
	if (!(empty ($id_historial)))
		$orden_ant_sig="$orden_ant_sig&id_historial=$id_historial";
	if (!(empty ($nro_contrato)))
		$orden_ant_sig="$orden_ant_sig&id_usuario=$id_usuario";
	if (!(empty ($ip_acceso)))
		$orden_ant_sig="$orden_ant_sig&ip_acceso=$ip_acceso";
	if (!(empty ($fecha)))
		$orden_ant_sig="$orden_ant_sig&fecha=$fecha";
	if (!(empty ($id_registro)))
		$orden_ant_sig="$orden_ant_sig&id_registro=$id_registro";
	if (!(empty ($tabla)))
		$orden_ant_sig="$orden_ant_sig&tabla=$tabla";
	if (!(empty ($campo)))
		$orden_ant_sig="$orden_ant_sig&campo=$campo";
	if (!(empty ($contenido)))
		$orden_ant_sig="$orden_ant_sig&contenido=$contenido";
	//Fin modulo de Orden
		
?>

<table border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
<?php
  	$anterior=$numero_inicio-$muestra;//Para el Boton Anterior la cifra actual se le resta a la cifra de Muestreo
	$siguiente=$numero_inicio+$muestra;//Para el Boton Anterior la cifra actual se le resta a la cifra de Muestreo
	
	if ($anterior>=0)
		{
		$ant=1;
		$anterior="$anterior$orden_ant_sig$where_h";
		?>
		<td width="100"><div align="center"><a href="<?php echo $url_origen.'?numero='.$anterior ?>">Anterior</a></div></td>
		<?php
		}
	else
		{
			echo "<td width='100'></td>";
		}
	//Inicio de Links a Siguiente - Anterior
	if ($entero!=1)
		{
		echo "<td><div align='center'>";
		for ($num=0;$num<$entero;$num++)
			{
			$total_n=$num*$muestra;
			$num2=$num+1;//Sumador de Muestreo de Paginas
			
			if (($numero==$total_n))
				echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> <b>$num2</b</a> | ";
			else
				echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> $num2</a> | ";
			}
		echo "</td></div>";	
		}
	//Fin de Links a Siguiente - Anterior
	if ($siguiente<$conteo_r)	
		{
		$sig=1;
		$siguiente="$siguiente$orden_ant_sig$where_h";
		?>
		<td width="100"><div align="center"><a href="<?php echo $url_origen.'?numero='.$siguiente ?>">Siguiente</a></div></td>
		<?php
		}
	else
		{
			echo "<td width='100'></td>";
		}
	?>
  </tr>
</table>

<?php
/*	echo "<center>";
	for ($num=0;$num<$entero;$num++)
		{
		$total_n=$num*$muestra;
		$num2=$num+1;//Sumador de Muestreo de Paginas
		if ($numero==$total_n)
			echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> <b>$num2</b</a> ";
		else
			echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> $num2</a> ";
	}
echo "</center>";*/
?>


<table width="90%" border="1" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td class="celdas" colspan="9"><div align="center"><strong>Consulta de Historial de Eventos</strong></div></td>
  </tr>
  <tr>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?id_historial=$orden_id_historial$where_h"?>">Id Historial</a></div></td>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?id_usuario=$orden_id_usuario$where_h"?>">Id Usuario </a></div></td>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?ip_acceso=$orden_ip_acceso$where_h"?>">IP Acceso </a></div></td>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?fecha=$orden_fecha$where_h"?>">Fecha</a></div></td>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?id_registro=$orden_id_registro$where_h"?>">Id Registro</a></div></td>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?tabla=$orden_tabla$where_h"?>">Tabla</a></div></td>
	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?campo=$orden_campo$where_h"?>">Campo</a></div></td>
    	<td class="celdas"><div align="center"><a href="<?php echo "$url_origen?contenido=$orden_contenido$where_h"?>">Contenido</a></div></td>
  </tr>

<?php
	$sql_c="select * from historiales $where_historial $orden $limitador";
	$historial= sql_c($sql_c);
	if (!(@mysql_num_rows ($historial) == 0))
		{
		while ($campo = mysql_fetch_array($historial))
			{
			$id_historial=$campo['id_historial'];
			$id_usuario=$campo['id_usuario'];
			$ip_acceso_u=$campo['ip_acceso_u'];
			$fecha=mostrar_fecha_larga($campo['fecha']);
			$id_registro=$campo['id_registro'];
			$tabla=$campo['tabla'];
			$campo_h=$campo['campo'];
			$contenido=$campo['contenido'];	

//Inicio Color Filas
	if (@$tr_control=="1")
		{
		$tr_bdcolor="bgcolor='#E9E9E9'";
		$tr_control=0;
		}
	else
		{
		$tr_control=1;
		$tr_bdcolor="";
		}
//Fin Color Filas
			
?>
<tr <?php echo $tr_bdcolor?>>
	<td><div align="center"><?php echo $id_historial?>&nbsp;</div></td>
	<td><div align="center"><?php echo $id_usuario?>&nbsp;</div></td>
	<td><div align="center"><?php echo $ip_acceso_u?>&nbsp;</div></td>
	<td><div align="center"><?php echo $fecha?>&nbsp;</div></td>
	<td><div align="center"><?php echo $id_registro?>&nbsp;</div></td>
	<td><div align="center"><?php echo $tabla?>&nbsp;</div></td>
	<td><div align="center"><?php echo $campo_h?>&nbsp;</div></td>
	<td><div align="center"><?php echo $contenido?>&nbsp;</div></td>
</tr>

<?php
			}
		}
?>
</table>

<table border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
<?php
if (@$ant==1)
	{ 
	?>
	<td width="100"><div align="center"><a href="<?php echo $url_origen.'?numero='.$anterior ?>">Anterior</a></div></td>
	<?php
	}
	else
		echo "<td width='100'></td>";
	//Inicio de Links a Siguiente - Anterior
	if ($entero!=1)
		{
		echo "<td><div align='center'>";
		$numero_inicial=$numero/$muestra;
		$numero_inicial=$numero_inicial-5;// Usado para limitar la cantidad de paginas que salgan al principio
		if ($numero_inicial<=0)
			$numero_inicial=0;
		$conteo=0;
		for ($num= $numero_inicial;$num<$entero;$num++)
			{
			$total_n=$num*$muestra;
			$num2=$num+1;//Sumador de Muestreo de Paginas
			
			if ($conteo<=10)
				{
				if (($numero==$total_n))
					echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> <b>$num2</b</a> | ";
				else
					echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> $num2</a> | ";
				}
				$conteo++;
				}
		echo "</td></div>";	
		}
	//Fin de Links a Siguiente - Anterior
	/*
	//Inicio de Links a Siguiente - Anterior
	if ($entero!=1)
		{
		echo "<td><div align='center'>";
		for ($num=0;$num<$entero;$num++)
			{
			$total_n=$num*$muestra;
			$num2=$num+1;//Sumador de Muestreo de Paginas
			
			if (($numero==$total_n))
				echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> <b>$num2</b</a> | ";
			else
				echo "<a href=$url_origen?numero=$total_n$orden_ant_sig$where_h> $num2</a> | ";
			}
		echo "</td></div>";	
		}
	//Fin de Links a Siguiente - Anterior*/
if (@$sig==1)
	{
	?>
	<td width="100"><div align="center"><a href="<?php echo $url_origen.'?numero='.$siguiente ?>">Siguiente</a></div></td>
	<?php
	}
	else
		echo "<td width='100'></td>";
	?>
  </tr>
</table>

<?php
}//Cierrre del Inicio del If
else  
{
	include ("sca_redireccion.php");//Redireccion que sube un nivel hacia el Acceso 
}
?>

<?php
	include ("sca_postcarga.php");
?>
