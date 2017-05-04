<?php 
	$fp = fopen($_FILES['contenidoimagen']['tmp_name'], 'rb'); //Abrimos la imagen
	$imagen = fread($fp, $_FILES['contenidoimagen']['size']); //Extraemos el contenido de la imagen
	$imagen = addslashes($imagen);
	fclose($fp);
?>