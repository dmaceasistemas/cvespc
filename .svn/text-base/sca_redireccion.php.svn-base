<?php
// La solución está en usar rutas relativas. Dentro de cada script la primera variable que yo declaro es $ruta, y le asigno la ruta actual del script. Por ejemplo, en mi página de portada o index mi variable luce así:
$ruta = "./"; // resto de mi codigo php o xhtml

//Ahora bien, si el script está dentro de un subdirectorio, mi variable tiene este otro valor:
//$ruta = "./../"; // resto de mi codigo php o xhtml

//Si existiese un tercer nivel, será así:
//$ruta = "./../../";
?>

<?php
if (empty($sca_id_u_activo))
	{
?>
	<br><br><br><center><img src="imagenes/monito.jpg" /></p>No tiene permisos para accesar a esta area por favor ingrese como usuario registrado</center><meta http-equiv="refresh" content="4;URL=<?php echo $ruta?>" /><br><br><br>
<?php
	}
else
	{
?>
	<br><br><br><center><img src="imagenes/monito.jpg"/></p>No tiene permisos para accesar a esta area</center><meta http-equiv="refresh" content="4;URL=<?php echo $ruta?>" /><br><br><br>
<?php
	}
?>
