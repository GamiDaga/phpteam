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


     <?php
     $query = getMovie($_POST['idMovie']);
     $result = mysqli_query($link,$query);
     $row = mysqli_fetch_array($result);
     $table = 'generos';
     $field = '*';
     $query = getAny($field,$table);
     $result2 = mysqli_query($link, $query);


     echo "

     <div class='row white formulario-registro'>

         <form class='col s12' action='./ABM.php' method='post' enctype='multipart/form-data'>

             <input type='hidden' name='operation' value='updateMovie'>
             <input type='hidden' name='idMovie' value='".$_POST['idMovie']."'>

             <div class='row campo white'>
                 <div class='input-field col s10 m5 l6'>
                     <input id='titulo' type='text' name='titulo' value='". $row['nombre'] ."' class='validate' required>
                     <label for='titulo'>Titulo</label>
                 </div>

                 <div class='input-field col s10 m5 l6'>
                     <input id='anio' type='text' name='anio' value='". $row['anio'] ."' class='validate' required>
                     <label for='anio'>Año</label>
                 </div>

                 <div class='input-field col s12'>
                     <select name='idGenero'>";
                         while($row2 = mysqli_fetch_assoc($result2)) {
                             if ($_POST['generos_id'] != $row2['id']){
                                 echo "<option value='".$row2['id']."'> ".$row2["genero"]." </option>";
                             }else{
                                 echo "<option value='".$row2['id']."' selected=".$_POST['generos_id'].">".$row2["genero"]."</option>";
                             }
                         }

                         echo "
                     </select>
                 </div>

                 <div class='input-field col s12'>
                     <textarea id='sinopsis' name='synopsis'class='materialize-textarea' value'". $row['sinopsis'] ."'>". $row['sinopsis'] ."</textarea>
                     <label for='sinopsis'>Sinopsis</label>
                 </div>

                 <span class='imagen-index col s8 offset-s4'><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>

                 <div class='file-field col s12'>
                     <div class='btn'>
                         <span>Poster</span>
                         <input type='file' name='image' value=''>
                     </div>
                     <div class='file-path-wrapper'>
                         <input class='file-path validate' type='text'>
                     </div>
                 </div>
             </div>
            <button type='submit' class='btn btn-submit right hide-on-med-and-down'>Actualizar</button>
         </form>

        <form action='./ABM.php' method='post'>
            <input type='hidden' name='operation' value='deleteMovie'>
            <input type='hidden' name='idMovie' value='".$_POST['idMovie']."'>
            <button type='submit' class='waves-effect waves-light btn col s4 offset-s4'>Eliminar</a>
        </form>
            ";
     ?>
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
