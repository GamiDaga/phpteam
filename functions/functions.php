<?php
require_once('./sql/connect.php');
require_once('./sql/query.php');

function calification($id){

    $link = connect();
    $query=getCalifications($id);

    $result=mysqli_query($link, $query);
    //echo '<pre>'; var_dump($result); exit();   
    //echo '<pre>'; var_dump($row); exit();
    if ($result ) {
          $tot=0; $cant = 0;
          while ($row = mysqli_fetch_assoc($result)){
              $tot += $row['calificacion'];
              $cant ++;}
          //echo '<pre>'; var_dump($cant); exit();
           $calification=($tot / $cant);
           return $calification;
        }
     else{ return 0; }

}
?>
