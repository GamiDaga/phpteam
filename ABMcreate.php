<?php
     require_once('./sql/connect.php');
     require_once('./sql/query.php');
     require_once('./layout/head.php');

?>
<body>
    <header>
        <?php
        require_once('./layout/header.php');       
        if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

        $link = connect();
        ?>
    </header>

    <div class="contenedor ">
        <div class="parallax-container">
            <div class="parallax"><img src="./images/background.jpg"></div>
        </div>


        <div class="container">
            <div class="row white formulario-registro">
                <form class="col s12" action="./ABM.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="operation" value="createMovie">

                    <div class="row campo white">
                        <div class="input-field col s10 m5 l6">

                            <input id="titulo" type="text" name="titulo" value="" class="validate" required>
                            <label for="titulo">Titulo</label>
                        </div>

                        <div class="input-field col s10 m5 l6">
                            <input id="anio" type="text" name="anio" value="" class="validate" required>
                            <label for="anio">Año</label>
                        </div>


                        <div class="input-field col s12">
                            <?php
                            $table = 'generos';
                            $field = '*';
                            $query = getAny($table,$field);
                            $result = mysqli_query($link, $query);
                            ?>

                            <select name="idGenero">
                                <option value="" disabled selected>Generos</option>
                                <?php
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row[id]."'>".$row[genero]." </option>";
                                };
                                ?>
                                <label>Materialize Select</label>
                            </select>
                        </div>


                        <div class="input-field col s12">
                            <textarea id="sinopsis" name="synopsis" class="materialize-textarea"></textarea>
                            <label for="sinopsis">Sinopsis</label>
                        </div>
                        <div class="file-field col s12">
                            <!-- <div class="btn">
                                <span>Poster</span>
                                <input name="image" type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input name="imageName" class="file-path validate" type="text">
                            </div> -->
                        </div>
                        <input type="file" name="image" value="">
                        <button type='submit' class='btn btn-submit right hide-on-med-and-down'>Crear</button>

                        
                    </form>
                </div>
            </div>
        <?php }else {
            echo "Debe estar logueado como administrador para acceder a esta pagina";
            echo "
                <form action='./index.php' method='post'>
                    <button type='submit' name='button'>Volver al index</button>
                </form> ";
        }


         ?>


  <footer>
      <?php
        require_once('./layout/footer.php');
        ?>
   </footer>
</body>
