<?php

function movie(){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas";

    return $sql;
  }

function pageMovies($start_from, $quantityPages,$orderBy = "null",$formatOrder = ""){
    if ($orderBy == null) {
      $orderBy = "null";
    }
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas
            ORDER BY $orderBy $formatOrder
            LIMIT ".$start_from.",".$quantityPages;
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
  function getCalifications($id){
    $r=" SELECT calificacion
         FROM comentarios
         WHERE peliculas_id=$id";
      return $r;
  }

  function getAny($table, $field){ //Query nueva
    $sql="SELECT $field
          FROM $table";
    return $sql;
  }

  function createMovie( $titulo, $año, $genero, $sinopsis, $image, $imageType){
      $sql ="INSERT INTO peliculas (nombre, sinopsis, anio, generos_id, contenidoimagen, tipoimagen)
              VALUES ($titulo, $sinopsis, $año, $genero, $image, $imageType)";
      return $sql;
  }
?>
