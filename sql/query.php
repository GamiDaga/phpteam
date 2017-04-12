<?php


function pelicula(){
    $sql="SELECT nombre, sinopsis, año, generos,
            FROM peliculas, generos"

    return $sql;
  }



?>
