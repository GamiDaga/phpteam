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


  <div class="row"><!--  INICIO DE SECCION DE COMENTARIOS -->
    <form > <!-- Aca seria donde el usuario escribe su comentario, nombre y apellido son los del usuario que este actualmente ingresado -->
       <div class="col s1">
         <p>Nombre</p>
       </div>

       <div class="col s1">
         <p>Apellido</p>
       </div>

       <div class="input-field col s12">
          <textarea id="comentario" class="materialize-textarea"></textarea>
          <label for="comentario">Comentario</label>
        </div>
        <div class="divider col s12"></div>
    </form> 


    <!-- ACA EMPIEZAN LA LISTA DE COMENTARIOS QUE ESTAN EN LA BASE DE DATOS  -->
    
    <div class="col s8">
      <p class="col s1">User1</p> <p class="col s1">Apellido1</p> <p class="col s1">dd/mm/yyyy</p>
      <div>
        <p class="col s10">Esto vendria siendo un comentario </p>
      </div>
    </div>
    <div class="divider col s12"></div>

    <div class="col s8">
      <p class="col s1">User2</p> <p class="col s1">Apellido2</p> <p class="col s1">dd/mm/yyyy</p>
      <div>
        <p class="col s10">Esto vendria siendo otro comentario </p>
      </div>
    </div>
    <div class="divider col s12"></div>
    <!-- FIN DE LISTA DE COMENTARIOS  -->

  </div> <!-- FIN DE SECCION DE COMENTARIOS -->

 </div>

<footer>
    <?php require_once('./layout/footer.php'); ?>
</footer>
</body>
