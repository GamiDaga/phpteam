<?php
require_once('./sql/connect.php');
require_once('./sql/query.php');

function calification($id){

    $link = connect();
    $query=getCalifications($id);

    $result=mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    $tot=array_sum($row);
    $cant=count($row);
    $calification=($tot/$cant);
    return $calification;

}
?>
