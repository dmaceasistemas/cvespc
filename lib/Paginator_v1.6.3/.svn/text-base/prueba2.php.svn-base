<?php
//Conexión a la base de datos
$con = mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("p_sca",$con) or die (mysql_error());

//Sentencia sql (sin limit)
$_pagi_sql = "SELECT * FROM historiales";

//cantidad de resultados por página (opcional, por defecto 20)
$_pagi_cuantos = 10;//Elegí un número pequeño para que se generen varias páginas

//cantidad de enlaces que se mostrarán como máximo en la barra de navegación
$_pagi_nav_num_enlaces = 3;//Elegí un número pequeño para que se note el resultado

//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true sólo en tiempo de desarrollo.

//Si tenemos una consulta compleja que hace que el Paginator no funcione correctamente, 
//realizamos el conteo alternativo.
$_pagi_conteo_alternativo = true;//recomendado false.

//Supongamos que sólo nos interesa propagar estas dos variables
$_pagi_propagar = array("id_historial","termino");//No importa si son POST o GET

//Definimos qué estilo CSS se utilizará para los enlaces de paginación.
//El estilo debe estar definido previamente
$_pagi_nav_estilo = "paginacion";

//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "&lt;";// podría ir un tag <img> o lo que sea

//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "&gt;";// podría ir un tag <img> o lo que sea

//Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
include("paginator.inc.php");
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

//Incluimos la información de la página actual
echo"<p>Mostrando registros ".$_pagi_info."</p>";
?>