<?php
//Conexión a la base de datos
$con = mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("p_sca",$con) or die (mysql_error());

//Sentencia sql (sin limit)
$_pagi_sql = "SELECT * FROM historiales";

//cantidad de resultados por página (opcional, por defecto 20)
$_pagi_cuantos = 10;

//Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
include("paginator.inc.php");
echo"<p>".$_pagi_navegacion."</p>";
echo "<table border='1'>";
//Leemos y escribimos los registros de la página actual
while($row = mysql_fetch_array($_pagi_result)){
	echo "<tr>";
    	echo "<td>".$row['id_historial']."</td>";
	echo "<td>".$row['tabla']."</td>";
	echo "<td>".$row['campo']."</td>";
	echo "<td>".$row['contenido']."</td>";
	echo "</tr>";
}
echo "</table>";
//Incluimos la barra de navegación
echo"<p>".$_pagi_navegacion."</p>";
?>