<?php

function movie(){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas";

    return $sql;
  }

function pageMovies($start_from, $quantityPages){

    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas
            LIMIT ".$start_from.",".$quantityPages;
    return $sql;
}

function image($id){
    //var_dump($id); exit();
	$sql= "SELECT contenidoimagen, tipoimagen
		FROM peliculas
		WHERE id=$id";
    return $sql;
}


?>
