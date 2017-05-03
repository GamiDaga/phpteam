<?php
    require_once('./sql/connect.php');
    require_once('./sql/query.php');
    require_once('./layout/head.php');

 ?>

<body>
    <?php require_once('./layout/navbar.php'); ?>

    <div class="contenedor">

        <div class="parallax-container">
            <div class="parallax"><img src="./images/background.jpg"></div>
        </div>

        <div class="section white">
            <div class="row container">
            <h2 class="header">Peliculas</h2>
            <div class="movie-section">
                <span><img src="mostrarimagen.php?idespectaculo=1"></span>
                <span>
                <?php 
                   $link = connect(); 
                   $query = movie();
                   $result = mysqli_query($link,$query);
                   //echo "<pre>"; var_dump($result); exit();
                   $row = mysqli_fetch_assoc($result);
                   //echo "<pre>"; var_dump($row); exit();
                   echo "<h1>".$row['nombre']."</h1>"
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
