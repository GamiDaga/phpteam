<?php
     require_once('./sql/connect.php');
     require_once('./sql/query.php');
     require_once('./layout/head.php');
     require_once('./functions/functions.php');
?>
<body>
  <?php
      require_once('./layout/navbar.php');
      $link = connect();
  ?>


  <div class="parallax-container">
      <div class="parallax"><img src="./images/background.jpg"></div>
  </div>


 <div class="pelicula">
   <?php
     $query = movieDetail($_GET['id']);
     $result = mysqli_query($link,$query);
     $row = mysqli_fetch_array($result);

     echo "<div class='row'>";
     //echo "<img src='./functions/showImage.php?id=".$row['id']."'>" // aca va la imagen desde el sql pero misteriosamente no funiona
     echo "<img src='./Carteles/star-wars-episode-2.jpg' width='300px' height='450px'>";
        echo "<div class='info-pelicula'>";
        echo "<h1>".$row['nombre']."</h1>"
         //."<p>".$calif=calification($row['id'])."</p>"
         ."<p>".$row['anio']."</p>"
         ."<p>".$row['sinopsis']."</p>";
       echo  "</div>";
     echo "</div>";
   ?>
 </div>


<?php require_once('./layout/footer.php'); ?>
</body>
