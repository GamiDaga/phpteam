<?php

require_once('./sql/connect.php'); $link = connect();
require_once('./sql/query.php');
session_start();


if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

    switch ($_POST['operation']) {

        case 'createMovie':
            //echo "<pre>";var_dump($_FILES['image']);exit();

            // $path = $_FILES['image']['name'];
            // $ext = pathinfo($path, PATHINFO_EXTENSION);
            $ext = $_FILES['image']['type'];
            $fp = fopen($_FILES['image']['tmp_name'], 'rb'); //Abrimos la imagen que viene por $_FILES
            $image = fread($fp, $_FILES['image']['size']); //Extraemos el contenido de la imagen
            $image = addslashes($image);
            fclose($fp);

            $query = createMovie($_POST['title'],$_POST['year'],$_POST['idGenero'],$_POST['synopsis'],$image,$ext);
            $result = mysqli_query($link, $query);
            if ($result) {
                $id = mysqli_insert_id($link);

                header("location:./detalle.php?idMovie=".$id);
            }else{
                echo "<pre>";var_dump("La carga de la película no se ha realizado");exit();
            }
        break;

        case 'updateMovie':

            //$path = $_FILES['image']['name'];
            //$ext = pathinfo($path, PATHINFO_EXTENSION);
            $qimage ="";

            if($_FILES['image']['tmp_name'] != '') {
                 $ext = $_FILES['image']['type'];

                 $fp = fopen($_FILES['image']['tmp_name'], 'rb'); //Abrimos la imagen que viene por $_FILES
                 $image = fread($fp, $_FILES['image']['size']); //Extraemos el contenido de la imagen
                 $image = addslashes($image);
                 fclose($fp);
                 $qimage = ", contenidoimagen = '".$image."' , tipoimagen = ' ".$ext." ' " ;}


            $query = updateMovie($_POST['idMovie'],$_POST['titulo'],$_POST['anio'],$_POST['idGenero'],$_POST['synopsis'],$qimage);
            //echo "<pre>";var_dump( $query);exit();
            $result = mysqli_query($link, $query);

            //echo "<pre>";var_dump( $query);exit();


            if ($result) {

                header("location:./detalle.php?idMovie=".$_POST['idMovie']);
            }else {
                echo "<pre>";var_dump("La carga de la película no se ha realizado");exit();
            }

        break;

        case 'deleteMovie':
             $query = deleteMovie($_POST['idMovie']);
             $result = mysqli_query($link, $query);
             if ($result) {

                header("location:./index.php");
             }else {
                echo "<pre>";var_dump("Error");exit();
                 }
        break;

        case 'registerUser':
            if (($_POST['lastname'] != "") && ($_POST['name'] != "") && ($_POST['user'] != "") && ($_POST['password'] != "") && ($_POST['repassword'] != "") && ($_POST['email'] != "") &&  ($_POST['password'] == $_POST['repassword'])) {
                $query = getUser($_POST['user']);
                $result = mysqli_query($link, $query);
                echo "<pre>";var_dump($result);exit();
                $row = mysqli_fetch_assoc($result);
                if ($row['nombreusuario'] != $_POST['user']) {
                    $query = register($_POST['lastname'],$_POST['name'],$_POST['user'],$_POST['password'], $_POST['email']);
                    $result = mysqli_query($link, $query);


                }

            }else{

            }
            $_POST['lastname'],$_POST['name'],$_POST['user'],$_POST['password'],$_POST['repassword'],$_POST['email']
        break;

        default:

        break;
    }
}



 ?>
