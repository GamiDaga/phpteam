<?php
//last commit
require_once('./sql/connect.php'); $link = connect();
require_once('./sql/query.php');

require_once('./layout/head.php');

echo "<body>";

echo "<header>";
    require_once('./layout/header.php');
echo "</header>";


if (!isset($_POST['operation'])) {
    echo "<div class='AlgoMal'>";
    echo "  <h2>Algo anduvo mal</h2>";
    echo "  <p>La operacion a realizar no fue encontrada</p>";
    echo "  <br><a class='btn ' href='./index.php'>volver al index</a>";
    echo "</div>";
}else{
    // echo "<pre>";var_dump($_FILES['operation']);exit();
    if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

        switch ($_POST['operation']) {

            case 'createMovie':
            if (isset($_POST['title']) && isset($_POST['year']) && isset($_POST['idGenero']) && isset($_POST['synopsis']) ){

                if (($_POST['title'] != "") && (strlen($_POST['title']) < 255) && ($_POST['year'] != "") && ($_POST['idGenero'] != "") && ($_POST['synopsis'] != "") && ($_FILES['image']['size'] > 0)
                    && ( $_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/gif' || $_FILES['image']['type'] == 'image/png')) {

                    $ext = $_FILES['image']['type'];

                    //VALIDAR TIPO IMAGEN


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
                        echo "<div class='AlgoMal'>";
                        echo "  <h2>Algo anduvo mal</h2>";
                        echo "  <p>La carga de la película no se ha realizado</p>";
                        echo "  <br><a class='btn ' href='./ABMcreate.php'>volver a Crear</a>";
                        echo "</div>";
                    }
                }else{
                    echo "<div class='AlgoMal'>";
                    echo "  <h2>Algo anduvo mal</h2>";
                    echo "  <p>Alguno de los campos no cumple con los requisitos o esta vacio</p>";
                    echo "  <br><a class='btn ' href='./ABMcreate.php'>volver a Crear</a>";
                    echo "</div>";
                    //var_dump($_FILES['image']['type']);
                }
            }else{
                echo "<div class='AlgoMal'>";
                echo "  <h2>Algo anduvo mal</h2>";
                echo "  <p>Alguno de los campos no esta declarado</p>";
                echo "  <br><a class='btn ' href='./ABMcreate.php'>volver a Crear</a>";
                echo "</div>";
            }
            break;

            case 'updateMovie':
                if (isset($_POST['idMovie'])){
                    if (isset($_POST['title']) && isset($_POST['year']) && isset($_POST['idGenero']) && isset($_POST['synopsis']) ){

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
                            $query = updateMovie($_POST['idMovie'],$_POST['title'],$_POST['year'],$_POST['idGenero'],$_POST['synopsis'],$qimage);
                            $result = mysqli_query($link, $query);

                            if ($result) {
                                header("location:./detalle.php?idMovie=".$_POST['idMovie']);
                            }else {
                                echo "<div class='AlgoMal'>";
                                echo "  <h2>Algo anduvo mal</h2>";
                                echo "  <p>La edicion de la película no se ha realizado por una coneccion fallida</p>";
                                echo "  <br>
                                        <form action='./ABMupdate.php' method='post'>
                                            <input type='hidden' name='idMovie' value='".$_POST['idMovie']."'>
                                            <button  class='btn'>Volver a editar</button>
                                        </form>";
                                echo "</div>";
                            }
                        }else{
                            echo "<div class='AlgoMal'>";
                            echo "  <h2>Algo anduvo mal</h2>";
                            echo "  <p>Alguno de los campos no cumple con los requisitos o esta vacio</p>";
                            echo "  <br>
                                    <form action='./ABMupdate.php' method='post'>
                                        <input type='hidden' name='idMovie' value='".$_POST['idMovie']."'>
                                        <button  class='btn'>Volver a editar</button>
                                    </form>";
                            echo "</div>";
                        }
                    }else{
                        echo "<div class='AlgoMal'>";
                        echo "  <h2>Algo anduvo mal</h2>";
                        echo "  <p>Alguno de los campos no fue declarado para la edición</p>";
                        echo "  <br>
                                <form action='./ABMupdate.php' method='post'>
                                    <input type='hidden' name='idMovie' value='".$_POST['idMovie']."'>
                                    <button  class='btn'>Volver a editar</button>
                                </form>";
                        echo "</div>";

                    }
                }else{
                    echo "<div class='AlgoMal'>";
                    echo "  <h2>Algo anduvo mal</h2>";
                    echo "  <p>No se recibió ninguna pelicula para editar</p>";
                    echo "  <br><a class='btn ' href='./index.php'>Volver al Inicio</a>";
                    echo "</div>";
                }

            break;

            case 'deleteMovie':

            if (isset($_POST['idMovie'])) {
                $query1 = deleteComments($_POST['idMovie']);
                $result1 = mysqli_query($link, $query1);


                $query = deleteMovie($_POST['idMovie']);
                $result = mysqli_query($link, $query);
                if ($result) {
                 header("location:./index.php");
                }else {
                echo "<div class='AlgoMal'>";
                echo "  <h2>Algo anduvo mal</h2>";
                echo "  <p>No se elimino la pelicula por problemas de coneccion</p>";
                echo "  <br><a class='btn ' href='./index.php'>Volver al Inicio</a>";
                echo "</div>";
                }
            }else{
                echo "<div class='AlgoMal'>";
                echo "  <h2>Algo anduvo mal</h2>";
                echo "  <p>No se recibió ninguna pelicula para eliminar</p>";
                echo "  <br><a class='btn ' href='./index.php'>Volver al Inicio</a>";
                echo "</div>";
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
                        echo "<div class='AlgoMal'>";
                        echo "  <h2>Bienvenido</h2>";
                        echo "  <p>Su usuario fue creado satisfactoriamente</p>";
                        echo "  <br><a class='btn ' href='./index.php'>Volver al Inicio</a>";
                        echo "</div>";
                    }else{
                        echo "<div class='AlgoMal'>";
                        echo "  <h2>Algo anduvo mal</h2>";
                        echo "  <p>La coneccion a la base de datos NO fue satisfactoria</p>";
                        echo "  <br><a class='btn ' href='./register.php'>Volver al registro</a>";
                        echo "</div>";
                    }
                }else{
                    echo "<div class='AlgoMal'>";
                    echo "  <h2>Algo anduvo mal</h2>";
                    echo "  <p>Ya existe un usuario con ese nombre de usuario</p>";
                    echo "  <br><a class='btn ' href='./register.php'>Volver al registro</a>";
                    echo "</div>";
                }
            // //$_POST['lastname'],$_POST['name'],$_POST['userName'],$_POST['contraseña'],$_POST['recontraseña'],$_POST['email']
            }
    }else{
        echo "<div class='AlgoMal'>";
        echo "  <h2>Algo anduvo mal</h2>";
        echo "  <p>La operacion a realizar no se encontro, (no esta o esta mal definida)</p>";
        echo "  <br><a class='btn ' href='./register.php'>Volver al registro</a>";
        echo "</div>";
    }
}

 ?>
 <footer>
    <?php require_once('./layout/footer.php');  ?>
 </footer>
</body>
