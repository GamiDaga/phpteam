<?php
require_once('./sql/connect.php'); $link=connect();
require_once('./functions/functions.php');
require_once('./sql/query.php');

    if ( ($_POST['userId'] != '') && ( $_POST['idMovie'] != '') && ( $_POST['date'] != '') && ( $_POST['comments'] != '') && ( $_POST['score'] != '') && ($_POST['comments'].length < 255) ) {

        $comments = addslashes($_POST['comments']);
        // echo "<pre>";var_dump($comments);exit();

        $query = addComments($_POST['userId'],$_POST['idMovie'],$_POST['date'],$comments,$_POST['score']);
        //echo "<pre>";var_dump($query);exit();

        $result = mysqli_query($link, $query);
        //echo "<pre>";var_dump($result);exit();
        if ($result) {
            header("location:./detalle.php?idMovie=".$_POST['idMovie']);
        }else {
            echo "<pre>";var_dump("El comentario no se ha realizado");exit();
        }
    }else{
        echo "<h2>No se realizo el comentario, vuelva a intentarlo</h2>";
        echo "<a class='btn' href='./detalle.php?idMovie=".$_POST['idMovie']."'>Volver a la pelicula</a>";
        exit();
    }
?>
