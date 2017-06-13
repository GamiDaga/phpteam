<?php
     require_once('./sql/connect.php');
     require_once('./sql/query.php');
     require_once('./layout/head.php');
?>
<body>
    <header>
        <?php
        if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {

        require_once('./layout/header.php');
        $link = connect();
        ?>
    </header>

  <div class="contenedor ">
    <div class="parallax-container">
        <div class="parallax"><img src="./images/background.jpg"></div>
  </div>


  <div class="container">
     <?php
     $query = movieDetail($_GET['id']);
     $result = mysqli_query($link,$query);
     $row = mysqli_fetch_array($result);

     echo "
     <div class='row white formulario-registro'>
      <form class='col s12' action='' method='post'>

        <div class='row campo white'>
          <h5 class='col s6' >Titulo</h5> <h5 class='col s6'>Año</h5>
          <div class='input-field col s10 m5 l6'>

            <input id='titulo' type='text' name='titulo' value='' class='validate' required>
            <label for='titulo'>". $row['nombre'] ."</label>
          </div>

          <div class='input-field col s10 m5 l6'>
            <input id='anio' type='text' name='anio' value='' class='validate' required>
            <label for='anio'>". $row['anio'] ."</label>
          </div>

          <h5>Genero</h5>
          <div class='input-field col s12'>
             <select >".

              $table = 'generos';
              $field = '*';
              $query2 = getAny($table,$field);
              $result2 = mysqli_query($link, $query2);

             echo "<option value='' disabled selected> ". $row2[genero]."</option>";

              while($row2 = mysqli_fetch_assoc($result2)) {
                 echo '<option value='.$row2[id].'>'.$row2[genero].' </option>';
               }

            echo "</select>
         </div>


          <h5>Sinopsis</h5>
          <div class='input-field col s12'>
            <textarea id='sinopsis' class='materialize-textarea'></textarea>
            <label for='sinopsis'>". $row['sinopsis'] ."</label>
          </div>

         <span class='imagen-index'><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>

         <div class='file-field col s12'>
           <div class='btn'>
             <span>Poster</span>
             <input type='file'>
           </div>
            <div class='file-path-wrapper'>
              <input class='file-path validate' type='text'>
            </div>
        </div>

        <div >
          <a class='waves-effect waves-light btn col s4 offset-s4' href=''>Eliminar</a>
        </div>

        </div>
      </div>
     ";
     ?>


      </form>
    </div>
  </div>

  <footer>
    <script type="text/javascript" src='./js/phpteam.js'></script>

      <?php
        require_once('./layout/footer.php');
    }else {
        echo "Debe estar logueado como administrador para acceder a esta pagina";
        echo "
        <form action='./index.php' method='post'>
        <button type='submit' name='button'>Volver al index</button>
        </form> ";
    }
        ?>
   </footer>
</body>
