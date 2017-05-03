<?php


function movie(){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas";

    return $sql;
  }

function image($id){

	$sql= "SELECT contenidoImagen, tipoImagen	
		FROM espectaculos
		WHERE idespectaculo=$id";
}


?>
