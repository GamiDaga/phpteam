<?php
//last commit
     require_once('./sql/connect.php');
     require_once('./sql/query.php');
     require_once('./layout/head.php');

?>
<body>
    <header>
        <?php

        echo "<header>";
            require_once('./layout/header.php');
        echo "</header>";
        if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

        $link = connect();
        ?>
    </header>


        <div class="container">
            <div class="row white formulario-registro">
                <form class="col s12" action="./ABM.php" method="post" enctype="multipart/form-data" onsubmit="return validateABMcreate(this)">

                    <input type="hidden" name="operation" value="createMovie">

                    <div class="row campo white">
                        <div class="input-field col s10 m5 l6">

                            <input id="title" type="text" name="title" value="">
                            <label for="title">Titulo</label>
                        </div>

                        <div class="input-field col s10 m5 l6">
                            <input id="year" type="text" name="year" value="">
                            <label for="year">Año</label>
                        </div>
                    </div>
                        <div class="input-field col s12">
                            <?php
                            $field = '*';
                            $table = 'generos';
                            $query = getAny($field,$table);
                            $result = mysqli_query($link, $query);
                            ?>

                            <select id="idGenero" name="idGenero">
                                <option value="" disabled selected>Generos</option>
                                <?php
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row[id]."'>".$row[genero]." </option>";
                                };
                                ?>
                                <label for="idGenero">Select</label>
                            </select>
                        </div>


                        <div class="input-field col s12">
                            <textarea id="synopsis" name="synopsis" class="materialize-textarea"></textarea>
                            <label for="synopsis">Sinopsis</label>
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
                        <input type="file" class="btn" id="image" name="image" value="" onchange="validateImage(this)">
                        <button type='submit' class='btn btn-submit right hide-on-med-and-down'>Crear</button>


                    </form>
                </div>
            </div>
        <?php }else {
                echo "<div class='AlgoMal'>";
                echo "  <h2>Algo anduvo mal</h2>";
                echo "<p>Debe estar logueado como administrador para acceder a esta pagina</p>";
                echo "  <br><a class='btn ' href='./index.php'>volver al index</a>";
                echo "</div>";
        }


         ?>


  <footer>
      <?php
        require_once('./layout/footer.php');
        ?>
   </footer>
</body>
