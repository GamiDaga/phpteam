<?php
require_once('./sql/connect.php'); $link=connect();
require_once('./functions/functions.php');
require_once('./sql/query.php');

echo "<body>";
    echo "<header>";
    require_once('./layout/header.php');
    echo "</header>";

    if (isset($_POST['userId']) && isset($_POST['idMovie']) && isset($_POST['date']) && isset($_POST['comments']) && isset($_POST['score']) && isset($_POST['comments'])) {

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
                echo "<pre>";var_dump("");
                echo "<a class='btn' href='./detalle.php?idMovie=".$_POST['idMovie']."'>Volver a la pelicula</a>";
                echo "<div class='AlgoMal'>";
                echo "  <h2>Algo anduvo mal</h2>";
                echo "  <p>El comentario no se ha realizado</p>";
                echo "  <br><a class='btn ' href='./detalle.php?idMovie=".$_POST['idMovie']."'>Volver al Inicio</a>";
                echo "</div>";
                die();
                // header("location:./detalle.php?idMovie=".$_POST['idMovie']);

            }
        }else{
            header("location:./detalle.php?idMovie=".$_POST['idMovie']);
        }
    }else{
        header("location:./index.php");
    }

    echo "<footer>";
        require_once('./layout/footer.php');
    echo "</footer>";

echo "</body>";

?>
