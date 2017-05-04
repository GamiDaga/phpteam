<?php
    require_once('./sql/connect.php');
    require_once('./sql/query.php');
    require_once('./layout/head.php');

 ?>

<body>
    <?php
        require_once('./layout/navbar.php');
        $link = connect();
    ?>

    <div class="contenedor">

        <div class="parallax-container">
            <div class="parallax"><img src="./images/background.jpg"></div>
        </div>

        <div class="section container ">
            <h2 class="header">Peliculas</h2>
                <div class="movie-section">
                    <span>
                    <?php
                        $query = movie();
                        $result = mysqli_query($link,$query);
                        //echo "<pre>"; var_dump($result); exit();
                        while ($row = mysqli_fetch_array($result)) {
                          echo "<div class='row'>";
                          echo "<img src='../functions/showImage.php?id=".$row['id']."'>" // aca va la imagen desde el sql pero misteriosamente no funiona
                          //echo "<img src='./Carteles/el-senor-de-los-anillos-la-comunidad-del-anillo.jpg' width='300px' height='450px'>"

                          ."<h3>".$row['nombre']."</h3>"
                          ."<p>".$row['anio']."</p>"
                          ."<p>".calificacion($row[id])."</p>"
                          ."<p>".$row['sinopsis']."</p>";
                        echo "<form action='./detalle.php' method='get'>
                          <input type='hidden' name='id' value='".$row['id']."'>
                          <button  class='btn'> Ver mas</button>
                        </form>";

                         echo "</div>";
                        }
                    ?>
                    </span>
                </div>
        </div>

    </div>


<?php require_once('./layout/footer.php'); ?>
</body>
