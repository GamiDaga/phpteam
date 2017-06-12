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

  <div class="contenedor ">
    <div class="parallax-container">
        <div class="parallax"><img src="./images/background.jpg"></div>
  </div>


  <div class="container">

    <div class="row white formulario-registro">
      <form class="col s12" action="" method="post">

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
             <select >
             <option value="" disabled selected>Generos</option>
             <?php
              $table = 'generos';
              $field = '*';
              $query = getAny($table,$field);
              $result = mysqli_query($link, $query);
              while($row = mysqli_fetch_assoc($result)) {
                 echo "<option value='".$row[id]."'>".$row[genero]." </option>";
               };
              ?> 
              <label>Materialize Select</label>
            </select>
         </div>

          <div class="input-field col s12">
            <textarea id="sinopsis" class="materialize-textarea"></textarea>
            <label for="sinopsis">Sinopsis</label>
          </div>

         <div class="file-field col s12">
           <div class="btn">
             <span>Poster</span>
             <input type="file">
           </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
        </div>


        </div>     
      </div>
 



      </form>
    </div>
  </div>

  <footer>
    <script type="text/javascript" src='./js/phpteam.js'></script>

      <?php
        require_once('./layout/footer.php');
        ?>
   </footer>    
</body>
