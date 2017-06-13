<?php

require_once('./sql/connect.php'); $link = connect();
require_once('./sql/query.php');


if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

    switch ($_POST['operation']) {

        case 'createMovie':

            $path = $_FILES['image']['name'];

            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $fp = fopen($_FILES['image']['tmp_name'], 'rb'); //Abrimos la imagen que viene por $_FILES
            $image = fread($fp, $_FILES['image']['size']); //Extraemos el contenido de la imagen
            $image = addslashes($image);
            fclose($fp);

            $query = createMovie($_POST['titulo'],$_POST['anio'],$_POST['idGenero'],$_POST['synopsis'],$image,$ext);
            $result = mysqli_query($link, $query);
            if ($result) {
                $id = mysqli_insert_id($link);

                header("location:./detalle.php?idMovie=".$id);
            }else {
                echo "<pre>";var_dump("La carga de la película no se ah realizado");exit();
            }
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
}



 ?>
