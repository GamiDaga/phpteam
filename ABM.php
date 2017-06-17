<?php

require_once('./sql/connect.php'); $link = connect();
require_once('./sql/query.php');
session_start();


// echo "<pre>";var_dump($_FILES['operation']);exit();
if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

    switch ($_POST['operation']) {

        case 'createMovie':
        //echo "<pre>";var_dump($_FILES['image']);exit();
            if (($_POST['title'] != "") &&  (strlen($_POST['title']) < 255) && ($_POST['year'] != "") && ($_POST['idGenero'] != "") && ($_POST['synopsis'] != "") && ($_FILES['image']['size'] != 0)) {

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
            }
        break;

        case 'updateMovie':

            if (($_POST['title'] != "") &&  (strlen($_POST['title']) < 255) && ($_POST['year'] != "") && ($_POST['idGenero'] != "") && ($_POST['synopsis'] != "") ) {
                $qimage ="";
                if($_FILES['image']['size'] != 0) {
                     $ext = $_FILES['image']['type'];
                     $fp = fopen($_FILES['image']['tmp_name'], 'rb'); //Abrimos la imagen que viene por $_FILES
                     $image = fread($fp, $_FILES['image']['size']); //Extraemos el contenido de la imagen
                     $image = addslashes($image);
                     fclose($fp);
                     $qimage = ", contenidoimagen = '".$image."' , tipoimagen = ' ".$ext." ' " ;
                 }
                $query = updateMovie($_POST['idMovie'],$_POST['titulo'],$_POST['anio'],$_POST['idGenero'],$_POST['synopsis'],$qimage);
                $result = mysqli_query($link, $query);

                if ($result) {
                    header("location:./detalle.php?idMovie=".$_POST['idMovie']);
                }else {
                    echo "<pre>";var_dump("La carga de la película no se ha realizado");exit();
                }
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

        default:

        break;
    }
} elseif ($_POST['operation'] == 'register') {

        if (($_POST['lastname'] != "") && ($_POST['name'] != "") && ($_POST['userName'] != "") && ($_POST['contraseña'] != "") && ($_POST['recontraseña'] != "") && ($_POST['email'] != "") &&  ($_POST['contraseña'] == $_POST['recontraseña'])) {
            $query = getExistUser($_POST['userName']);
            //echo "<pre>";var_dump($query);exit();

            $result = mysqli_query($link, $query);
            //echo "<pre>";var_dump($result);exit();
            // $row = mysqli_fetch_assoc($result);
            $exist = mysqli_num_rows($result);

            //echo "<pre>";var_dump(!$exist);exit();
            if (!$exist) {
                $query = register($_POST['lastname'],$_POST['name'],$_POST['userName'],$_POST['contraseña'], $_POST['email']);
                // echo "<pre>";var_dump($query);exit();

                $result = mysqli_query($link, $query);
                if ($result) {
                    echo "Su usuario fue creado satisfactoriamente";
                    echo "<br><a href='./index.php'>volver al index</a>";
                    exit();
                }else{
                    echo "Algo anduvo mal con la creacion del usuario";
                    echo "<br><a href='./register.php'>volver al registro</a>";
                    exit();
                }
            }else{
                echo "Ya existe un usuario con ese nombre de usuario";
                echo "<br><a href='./register.php'>volver al registro</a>";
                exit();
            }
        // //$_POST['lastname'],$_POST['name'],$_POST['userName'],$_POST['contraseña'],$_POST['recontraseña'],$_POST['email']
        }
}else{
    echo "Algo anduvo mal";
    echo "<br><a href='./index.php'>volver al index</a>";
    exit();
}

 ?>
