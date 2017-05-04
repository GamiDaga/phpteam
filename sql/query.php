<?php

function movie(){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas";

    return $sql;
  }

function image($id){
    //echo '<pre>'; var_dump($id); exit();
	$sql= "SELECT contenidoimagen, tipoimagen
		FROM peliculas
		WHERE id=$id";

    return $sql;
}

function movieDetail($id){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas
            WHERE id=$id";

    return $sql;
  }


?>
