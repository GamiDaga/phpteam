
<?php
require_once('../sql/connect.php');
require_once('../sql/query.php');
// se recibe el valor que identifica la imagen en la tabla

    $link = connect(); // se recupera la información de la imagen

    //echo '<pre>'; var_dump($_GET['id']); exit();
    $query = image($_GET['id']);
    //echo '<pre>'; var_dump($query); exit();

    $result = mysqli_query($link, $query);
    //echo '<pre>'; var_dump($result); exit();

    $row = mysqli_fetch_assoc($result);
     //echo '<pre>'; var_dump($row); exit();

     mysqli_close($link);
    //echo '<pre>'; var_dump($row['contenidoimagen']); exit();

    // se imprime la imagen y se le avisa al navegador que lo que se está // enviando no es texto, sino que es una imagen un tipo en particular
    header('Content-type: img'.$row['tipoimagen']);
    //echo '<pre>'; var_dump($row['contenidoimagen']); exit();
    echo $row['contenidoimagen'];
?>