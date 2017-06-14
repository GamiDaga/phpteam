<?php
require_once('./sql/connect.php'); $link=connect();
require_once('./sql/query.php');

    $query = addComments($_POST['userId'],$_POST['idMovie'],$_POST['date'],$_POST['comments'],$_POST['score']);
    //echo "<pre>";var_dump($query);exit();

    $result = mysqli_query($link, $query);
    //echo "<pre>";var_dump($result);exit();
    if ($result) {
        header("location:./detalle.php?idMovie=".$_POST['idMovie']);
    }else {
        echo "<pre>";var_dump("El comentario no se ha realizado");exit();
    }
?>
