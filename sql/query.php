<?php

function movie(){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas";

    return $sql;
  }

function pageMovies($start_from, $quantityPages,$orderBy = "nombre",$formatOrder = "ASC", $search="", $genre="", $year="" ){
    if ($orderBy == null) {
      $orderBy = "null";
    }
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas
            WHERE nombre LIKE '%$search%' AND generos_id LIKE '%$genre%' AND anio LIKE '%$year%'
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
    $sql=" SELECT calificacion
           FROM comentarios
           WHERE peliculas_id=$id";
      return $sql;
  }

  function getAny($field,$table){ //Query nueva
    $sql="SELECT $field
          FROM $table";
    return $sql;
  }

  function createMovie( $titulo, $año, $idGenero, $sinopsis, $image, $imageType){
      $sql ="INSERT INTO peliculas (id, nombre, sinopsis, anio, generos_id, contenidoimagen, tipoimagen)
              VALUES (NULL ,'$titulo', '$sinopsis', '$año', '$idGenero', '$image', '$imageType')";
      return $sql;
  }

  function updateMovie($id, $titulo, $año, $genero, $sinopsis, $image){
      $sql ="UPDATE peliculas
             SET nombre = '$titulo', sinopsis ='$sinopsis', anio = '$año', generos_id ='$genero' $image
             WHERE id = '$id' ";
      return $sql;
  }

  function deleteMovie($id){
      $sql ="DELETE FROM peliculas
             WHERE id = '$id' ";
      return $sql;
  }

  function register($apellido, $nombre, $usuario, $contraseña, $email){
      $sql =" INSERT INTO usuarios (apellido, nombre, nombreusuario, password, email, administrador)
      VALUES ('$apellido', '$nombre', '$usuario', '$contraseña', '$email', 0)";
      return $sql;
  }

  function getComments($idMovie){
    $sql=" SELECT *
         FROM comentarios
         WHERE peliculas_id=$idMovie";
      return $sql;
}
  function getMovie($id){
    $sql="SELECT id, nombre, sinopsis, anio, generos_id
            FROM peliculas
            WHERE id=$id";

    return $sql;
  }


  function addComments($userId,$idMovie,$date,$comments,$score){
      $sql =" INSERT INTO comentarios (comentario, fecha, peliculas_id, usuarios_id, calificacion)
      VALUES ('$comments', '$date', '$idMovie', '$userId', '$score')";
      return $sql;
  }
  function getUser($id){
      $sql="SELECT *
              FROM usuarios
              WHERE id=$id";

      return $sql;
    }

    function getExistUser($name){
        $sql="SELECT nombreusuario
                FROM usuarios
                WHERE nombreusuario='$name'";

        return $sql;
      }

    function getYear()
    {
        $sql = "SELECT anio
                FROM peliculas
                ORDER BY anio ASC";

        return $sql;
    }
?>
