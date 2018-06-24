<?php
//Conexión a la base de datos
include_once ("../../sca_precarga.php");
$con = mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("p_sca",$con) or die (mysql_error());

//Sentencia sql (sin limit)
//$_pagi_sql = "SELECT * FROM historiales";

$_pagi_sql = "select a.id_visitante_h, a.cedula, a.cod_procedencia, a.procedencia, a.cod_emisor, a.emisor, a.fecha_e, a.fecha_s, a.id_asunto, a.observacion, a.id_carnet, b.nombre, b.apellido, b.id_visitante_t, c.asunto, d.tipo from visitantes_h a, visitantes b, asuntos c, visitantes_t d where a.cedula=b.cedula and a.id_asunto=c.id_asunto and b.id_visitante_t=d.id_visitante_t $ls_criterio and a.fecha_s<>'0000-00-00 00:00:00' order by a.fecha_s DESC"; 

//cantidad de resultados por página (opcional, por defecto 20)
$_pagi_cuantos = 10;

//Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
include("paginator.inc.php");
echo"<p>".$_pagi_navegacion."</p>";
?>
<table border="1" align="center" cellpadding="2" cellspacing="0">
<tr>
<?php /*	<td class="celdas"><div align="center">Id visitante_h</div></td>	*/?>
	<td class="celdas"><div align="center">Cedula</div></td>
	<td class="celdas"><div align="center">Apellidos</div></td>
	<td class="celdas"><div align="center">Nombres</div></td>
	<td class="celdas"><div align="center">Tipo de Visitante</div></td>
	<td class="celdas"><div align="center">Procedencia</div></td>
	<td class="celdas"><div align="center">Destino</div></td>
	<td class="celdas"><div align="center">Fecha de Entrada</div></td>
	<td class="celdas"><div align="center">Fecha de Salida</div></td>	
	<td class="celdas"><div align="center">Asunto</div></td>
	<td class="celdas"><div align="center">Observacion</div></td>
	<td class="celdas"><div align="center">Nro de Carnet</div></td>	
<?php
//Leemos y escribimos los registros de la página actual
while($campo = mysql_fetch_array($_pagi_result)){
	echo "<tr>";

		$id_visitante_h=$campo['id_visitante_h'];
		$cedula=$campo['cedula'];

		$procedencia=$campo['procedencia'];
		$emisor=$campo['emisor'];
//		$procedencia=sql_mincul_corr($campo['cod_procedencia']);
//		$emisor=sql_mincul_corr($campo['cod_emisor']);
		$fecha_e=mostrar_fecha_larga($campo['fecha_e']);
		$fecha_s=mostrar_fecha_larga($campo['fecha_s']);
		$asunto=$campo['asunto'];
		$observacion=$campo ['observacion'];
		$id_carnet=$campo ['id_carnet']; 
		$nombre=$campo ['nombre'];
		$apellido=$campo ['apellido'];
//		$telefono_movil=$campo ['telefono_movil'];
		$tipo=$campo ['tipo'];

    	echo "<td>".$cedula."</td>";
	echo "<td>".$apellido."</td>";
	echo "<td>".$nombre."</td>";
	echo "<td>".$tipo."</td>";
	echo "<td>".$procedencia."</td>";
	echo "<td>".$emisor."</td>";
	echo "<td>".$fecha_e."</td>";
	echo "<td>".$fecha_s."</td>";
	echo "<td>".$asunto."</td>";
	echo "<td>".$observacion."</td>";
	echo "<td>".$id_carnet."</td>";

	echo "</tr>";
}
echo "</table>";
//Incluimos la barra de navegación
echo"<p>".$_pagi_navegacion."</p>";
?>