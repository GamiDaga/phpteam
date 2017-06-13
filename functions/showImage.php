<?php
require_once('../sql/connect.php');
require_once('../sql/query.php');
// se recibe el valor que identifica la imagen en la tabla

    $link = connect(); // se recupera la información de la imagen

    //echo '<pre>'; var_dump($link); exit();
    $query = image($_GET['idMovie']);
    //echo '<pre>'; var_dump($query); exit();
    //echo '<pre>'; var_dump($id); exit();
    $result=mysqli_query($link, $query);
    //echo '<pre>'; var_dump($res); exit();

    $row = mysqli_fetch_array($result);
    //echo '<pre>'; var_dump($rowb['0']); exit();

     mysqli_close($link);
    //echo '<pre>'; var_dump($row['contenidoimagen']); exit();

    // se imprime la imagen y se le avisa al navegador que lo que se está // enviando no es texto, sino que es una imagen un tipo en particular

    header('Content-type: '.$row['tipoimagen']);
    echo $row['contenidoimagen'];

?>
