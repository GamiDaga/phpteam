<?php
require_once('./sql/connect.php');
require_once('./sql/query.php');

function calification($id){

    $link = connect();
    $query=getCalifications($id);

    $result=mysqli_query($link, $query);
    //echo '<pre>'; var_dump($result); exit();
    $row = mysqli_fetch_array($result);
    //echo '<pre>'; var_dump($row); exit();
    if ($row != null ) {
          $tot = array_sum($row);
          $cant= count($row);
          //echo '<pre>'; var_dump($cant); exit();
          $calification=($tot / $cant)." Estrellas";
          return $calification;
        }
     else{ 
     	$calification = 'No hay calificaciones disponibles';
        return $calification;}

}
?>
