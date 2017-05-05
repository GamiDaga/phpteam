
<?php
require_once('./sql/connect.php');
require_once('./sql/query.php');
// se recibe el valor que identifica la imagen en la tabla

    $link = connect(); // se recupera la información de la imagen

    //echo '<pre>'; var_dump($_GET['idMovie']); exit();
    $query = image($_GET['id']);
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    //echo '<pre>'; var_dump($row['tipoimagen']); exit();
    mysqli_close($link);

    // se imprime la imagen y se le avisa al navegador que lo que se está // enviando no es texto, sino que es una imagen un tipo en particular
    header("Content-type: image/jpeg".$row['tipoimagen']);
    echo ($row['contenidoimagen']);
?>
