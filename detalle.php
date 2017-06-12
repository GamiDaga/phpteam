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


 <div class="pelicula">
   <?php
     $query = movieDetail($_GET['idMovie']);
     $result = mysqli_query($link,$query);
     $row = mysqli_fetch_array($result);

     echo "<div class='row'>";
     //echo "<img src='./functions/showImage.php?idMovie=".$_GET['idMovie']."'>" // aca va la imagen desde el sql pero misteriosamente no funiona
     echo "<span class='imagen-index'><img src='./functions/showImage.php?idMovie=".$_GET['idMovie']."'></span>";
     //echo "<img src='./Carteles/star-wars-episode-2.jpg' width='300px' height='450px'>";
        echo "<div class='info-pelicula'>";
        echo "<h1>".$row['nombre']."</h1>"
         //."<p>".$calif=calification($row['id'])."</p>"
         ."<p>".$row['anio']."</p>"
         ."<p>".$row['sinopsis']."</p>";
       echo  "</div>";
     echo "</div>";
   ?>
 </div>

<footer>
    <?php require_once('./layout/footer.php'); ?>
</footer>
</body>
