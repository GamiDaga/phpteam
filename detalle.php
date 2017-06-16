<?php
require_once('./sql/connect.php');
require_once('./sql/query.php');
require_once('./layout/head.php');
require_once('./functions/functions.php');
?>
<body>
    <header>
        <?php
        require_once('./layout/header.php');
        $link = connect();
        ?>
    </header>

    <div class="parallax-container">
        <div class="parallax"><img src="./images/background.jpg"></div>
    </div>
    <div class="contenedor">
        <div class="pelicula">
            <?php
            $query = movieDetail($_GET['idMovie']);
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_array($result);

            echo "
            <div class='row'>
                <span class='imagen-index'><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>
                <div class='info-pelicula'>
                    <h1>".$row['nombre']."</h1>
                    <div class='score right'>
                    <p>".number_format(calification($row['id']), 2, ".", ",")."
                    <i class='material-icons'>star rate</i></p>
                    </div>
                    <p>".$row['anio']."</p>


                    <p>".$row['sinopsis']."</p>
                </div>
            </div>
            ";
            // ."<p>".$calif=calification($row['id'])."</p>"
            ?>
        </div>

            <!--  INICIO DE SECCION DE COMENTARIOS -->
            <div class="row">
            <?php if (isset($_SESSION['log']) && $_SESSION['log'] == true ): ?>

                    <?php
                    echo '

                    <div class="">
                        <p class="col">'.$_SESSION['userName'].'</p>
                        <p class="col">'.$_SESSION['name'].'</p>
                        <p class="col right">'.date("Y/m/d").'</p>
                    </div>
                    ';
                    ?>

                    <!-- Aca seria donde el usuario escribe su comentario, nombre y apellido son los del usuario que este actualmente ingresado -->
                        <?php
                        echo '

                        <div class="row">
                            <form class="" action="./addComments.php" method="post" onsubmit="">
                                <input type="hidden" name="userId" value="'.$_SESSION['id'].'">
                                <input type="hidden" name="idMovie" value="'.$_GET['idMovie'].'">
                                <input type="hidden" name="date" value="'.date("Y/m/d").'">
                                <div class="input-field col right">
                                <i class="material-icons">star rate</i>
                                    <select name="score" required>
                                      <option class="calification" value="1">1</option>
                                      <option class="calification" value="2">2</option>
                                      <option class="calification" value="3">3</option>
                                      <option class="calification" value="4">4</option>
                                      <option class="calification" value="5">5</option>

                                    </select>
                                    <label>Calificacion</label>
                                    </div>
                                    <br>
                                <div class="input-field col s12">
                                    <textarea id="comments" type="text" name="comments" class="materialize-textarea" maxlength="255" required"></textarea>
                                    <label for="comments">Comentar</label>
                                    <br>
                                </div>
                                <button type="" value="" class="btn right hide-on-med-and-down" onclick="validateComments()">Comentar</button>
                            </form>
                        </div>
                        ';
                        ?>
                    <div class="divider col s12">
                    </div>

                <?php else: ?>
                    <br>
                    <pre>Debe iniciar sesion para comentar</pre>
                    <br>
                <?php endif; ?>

            </div>

            <!-- ACA EMPIEZAN LA LISTA DE COMENTARIOS QUE ESTAN EN LA BASE DE DATOS  -->
            <?php

            $query = getAny('id, nombreusuario','usuarios');
             //echo "<pre>";var_dump($query);exit();
            $result = mysqli_query($link,$query);
            while($row = mysqli_fetch_assoc($result)){
                //echo "<pre>";var_dump($row);//exit();

                $listUser[$row['id']] = $row['nombreusuario'];
            }


            $query = getComments($_GET['idMovie']);
            // echo "<pre>";var_dump($query);//exit();
            $result = mysqli_query($link,$query);
            //echo "<pre>";var_dump($result);//exit();
            while($row = mysqli_fetch_assoc($result)){
                //echo "<pre>";var_dump($row);//exit();
                echo '
                <div class="row">
                    <div class="col s8">
                        <div class="data">

                                <p class="col"> Id:'.$row['id'].'</p>

                                <p class="col">'.$listUser[$row['usuarios_id']].'</p>
                                <p class="col right">'.$row['fecha'].'</p>
                                <p class="col right">'.$row['calificacion'].'
                                <i class="material-icons">star rate</i></p>
                        </div>
                        <div>
                            <p class=" col s10">'.$row['comentario'].' </p>
                        </div>

                        </p>
                    </div>
                    <div class="divider col s12">
                    </div>
                </div>
                ';
             } ?>
            <!-- FIN DE LISTA DE COMENTARIOS  -->
            <!-- FIN DE SECCION DE COMENTARIOS -->
    </div>

    <footer>
        <script type="text/javascript" src='./js/functions.js'></script>

        <?php require_once('./layout/footer.php'); ?>
    </footer>
</body>
