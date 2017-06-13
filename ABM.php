<?php

require_once('./sql/connect.php'); $link = connect();
require_once('./sql/query.php');


// if (isset) {
//     # code...
// }
    switch ($_POST['operation']) {

        case 'createMovie':

            $path = $_FILES['image']['name'];
            // echo "<pre>";var_dump($path);exit();
            //  echo "<pre>";var_dump($_FILES['image']);exit();
            //echo "<pre>";var_dump($_FILES['imageName']);exit();

            $ext = pathinfo($path, PATHINFO_EXTENSION);
            // echo "<pre>";var_dump($ext);exit();

            $fp = fopen($_FILES['image']['tmp_name'], 'rb'); //Abrimos la imagen
            $image = fread($fp, $_FILES['image']['size']); //Extraemos el contenido de la imagen
            $image = addslashes($image);
            fclose($fp);

            $query = createMovie($_POST['titulo'],$_POST['anio'],$_POST['idGenero'],$_POST['synopsis'],$image,$ext);
            //echo "<pre>";var_dump($query);exit();
            mysqli_query($link, $query);

            header("location:./funciona.php");
        break;

        case 'updateMovie':
        break;

        case 'deleteMovie':
        break;

        case 'registerUser':
        break;

        default:

        break;
    }



 ?>
