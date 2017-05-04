<?php
require_once('./sql/connect.php');
// se recibe el valor que identifica la imagen en la tabla
$id = $_GET['idespectaculo'];

$link = connect();
// se recupera la información de la imagen
$query = image($id); 

$result= mysqli_query($link, $query); 
$row= mysqli_fetch_array($result); 
mysqli_close($link); 

// se imprime la magen y se le avisa al navegador que lo que se está 
// enviando no es texto, sino que es una imagen un tipo en particular
header("Content-type: “ . $row[‘tipoImagen’]); 
echo $row[contenidoImagen']; 	
?>