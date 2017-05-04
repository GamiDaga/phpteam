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

        <div class="section ">
            <h2 class="header container">Peliculas</h2>
            <div class="row container">
                <div class="movie-section">
                    <span>
                    <?php
                        $query = movie();
                        $result = mysqli_query($link,$query);
                        //echo "<pre>"; var_dump($result); exit();
                        $row = mysqli_fetch_assoc($result);
                        echo "<span><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>"
                        ."<h3>".$row['nombre']."</h1>"
                        ."<p>".$row['anio']."</p>"
                        ."<p>".$row['sinopsis']."</p>";
                    ?>
                    </span>
                </div>
            </div>
        </div>

    </div>


<?php require_once('./layout/footer.php'); ?>
</body>
