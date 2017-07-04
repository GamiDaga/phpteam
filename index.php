<?php

    require_once('./sql/connect.php');
    require_once('./sql/query.php');
    require_once('./functions/functions.php');
    require_once('./layout/head.php');


 ?>

 <body>
     <header>

         <?php
         require_once('./layout/header.php');
         //echo "<pre>";var_dump('asd');exit();

         $link = connect();
         ?>
     </header>


     <div class="contenedor ">

             <div id="filter-nav" class="menu">
                     <form id="filters" action="./index.php" methode="get">


                         <div class="separador">
                             <p>Ordenar por:</p>
                             <div class="filter">
                                 <input id="name" value="nombre" type="radio" name="orderBy" class="validate" <?php if ((isset($_GET['orderBy']) && $_GET['orderBy'] == 'nombre')) echo ('checked'); ?>/>
                                 <label for="name">Nombre</label>
                             </div>
                             <div class="filter">
                                 <input id="year" value="anio" type="radio" name="orderBy" class="validate" <?php if (isset($_GET['orderBy']) && $_GET['orderBy'] == 'anio') echo ('checked'); ?>/>
                                 <label for="year">Año</label>
                             </div>

                         </div>

                         <div class="separador">
                             <p>Orden</p>
                             <div class="filter">
                                 <input id="ascendente" value="ASC" type="radio" name="formatOrder" class="validate" <?php if ((isset($_GET['formatOrder']) && $_GET['formatOrder'] == 'ASC') ) echo ('checked'); ?>/>
                                 <label for="ascendente">Ascendente</label>
                             </div>
                             <div class="filter">
                                 <input id="descendiente" value="DESC" type="radio" name="formatOrder" class="validate" <?php if (isset($_GET['formatOrder']) && $_GET['formatOrder'] == 'DESC') echo ('checked'); ?>/>
                                 <label for="descendiente">Descendiente</label>
                             </div>
                         </div>

                         <div class="separador">
                             <ul class="filter">
                                 <div class="input-field">
                                     <li>
                                         <input id="search" name="search" type="search" class="calidate" value="<?php if (isset($_GET['search'])) echo ($_GET['search']); ?>"/>
                                         <label class="label-icon" for="search">
                                             <i class="material-icons">search</i></label>
                                             <i class="material-icons">close</i>
                                      </li>
                                 </div>
                             </ul>
                         </div>

                        <div class="separador">
                            <p>Genero</p>
                            <div class="filter">

                                <?php
                                $field = '*';
                                $table = 'generos';
                                $query = getAny($field,$table);
                                $result = mysqli_query($link, $query);
                                ?>
                                <select name="genreSearch">
                                    <option value="" disabled selected>Generos</option>
                                    <option value=""></option>
                                    <?php
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='".$row['id']."'>".$row['genero']." </option>";
                                    };
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="separador">
                            <p>Año</p>
                            <div class="filter">
                                 <?php
                                 $query = getYear();
                                 $result = mysqli_query($link,$query);
                                //  echo "<pre>";var_dump($result);
                                 $ult = 0;
                                 ?>
                                 <select class="col s4" name="year">
                                    <option value="" disabled selected>Año</option>
                                    <option value=""></option>
                                <?php
                                 while ($row = mysqli_fetch_array($result)) {
                                     //echo "<pre>";var_dump($row);
                                     if ($row['anio'] > $ult) {
                                         echo '<option class="" value="'.$row['anio'].'">'.$row['anio'].'</option>';
                                         $ult = $row['anio'];
                                     }
                                 }
                                 echo '</select> ';
                                 ?>
                             </div>
                        </div>


                             <div class="navButton">
                                 <button type="submit" class="btn btn-submit">Buscar</button>
                             </div>

                         </form>

                     <div class="navButton">
                         <?php
                         if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {
                                echo "<a class='btn ' href='./ABMcreate.php'>Crear</a>";
                         }
                          ?>
                     </div>
              </div>

                 <div class="container">
                     <?php //echo "<pre>"; var_dump($_GET['page']);exit();

                     $numero = count($_GET);
                     $tags = array_keys($_GET);// obtiene los nombres de las varibles
                     $valores = array_values($_GET);// obtiene los valores de las varibles
                     $parameter = '';
                     // crea las variables y les asigna el valor
                     for($i=0;$i<$numero;$i++){
                         if ($tags[$i] != 'page') {
                             $parameter = $parameter.'&'.$tags[$i].'='.$valores[$i];
                         }
                     }
                     //echo "<pre>"; var_dump($parameter);exit();

                     ?>

                     <div class="section-movie">
                         <h2 class="header">Peliculas</h2>
                         <div class="movie-section">
                             <?php
                             //Evitamos que salgan errores por variables vacías
                             //error_reporting(E_ALL ^ E_NOTICE);
                             //Cantidad de resultados por página (debe ser INT, no string/varchar)
                             $quantity_rows_in_page = 5;
                             //Comprueba si está seteado el GET de HTTP
                             //echo "<pre>"; var_dump($_GET["page"] == 1);exit();

                             if (isset($_GET["page"])) {
                                 //Si el GET de HTTP SÍ es una string / cadena, procede
                                 if (is_string($_GET["page"])) {
                                     //Si la string es numérica, define la variable 'pagina'
                                     if (is_numeric($_GET["page"])) {
                                        $page = $_GET["page"];
                                     }else{ //Si la string no es numérica, redirige al index (por ejemplo: index.php?pagina=AAA)
                                         echo "<meta http-equiv='refresh' content='0; url=index.php?'".$parameter." />";
                                         die();
                                     };
                                 };
                             } else { //Si el GET de HTTP no está seteado, lleva a la primera página (puede ser cambiado al index.php o lo que sea)
                                 $page = 1;
                             };
                             //Define el número 0 para empezar a paginar multiplicado por la cantidad de resultados por página
                             $start_from = ($page-1) * $quantity_rows_in_page;
                             ?>
                             <span>
                                 <?php
                                 $query = movie();
                                 $result = mysqli_query($link, $query);
                                 //Cuenta el número total de registros
                                 $total_rows = mysqli_num_rows($result);
                                 //Obtiene el total de páginas existentes
                                 $quantityPages= ceil($total_rows / $quantity_rows_in_page);
                                 //Realiza la consulta en el orden de ID ascendente (cambiar "id" por, por ejemplo, "nombre" o "edad", alfabéticamente, etc.)
                                 //Limitada por la cantidad de cantidad por página

                                 if (!isset($_GET['orderBy'])) { $orderBy = null;}          else {$orderBy = $_GET['orderBy'];}
                                 if (!isset($_GET['formatOrder'])) {$formatOrder = null;}  else {$formatOrder = $_GET['formatOrder'];}
                                 if (!isset($_GET['search'])) {$search = null;}            else {$search =$_GET['search'];}
                                 if (!isset($_GET['genreSearch'])) {$genreSearch = null;}            else {$genreSearch =$_GET['genreSearch'];}
                                 if (!isset($_GET['year'])) {$year = null;}            else {$year =$_GET['year'];}
                                  $query = pageMovies($start_from, $quantity_rows_in_page,  $orderBy, $formatOrder, $search, $genreSearch, $year);
                                  //echo '<pre>'; var_dump($query); exit();
                                 $result = mysqli_query($link, $query);

                                $field = '*';
                                $table = 'generos';
                                $queryG = getAny($field,$table);
                                $resultG = mysqli_query($link, $queryG);

                                while($row1= mysqli_fetch_assoc($resultG)) {
                                $tabla_generos[$row1['id']] = $row1['genero'];}

                                 while($row = mysqli_fetch_assoc($result)) {

                                    echo "<div class='row'>";
                                     echo "<span class='imagen-index col s10 m10 l4'><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>"; // aca va la imagen desde el sql pero misteriosamente no funiona
                                     echo "
                                     <div class='info-pelicula col s10 m10 l6'>
                                         <h3>".$row['nombre']."</h3>
                                         <div class='score right'>
                                             <p>".number_format(calification($row['id']), 2, ".", ",")."
                                             <i class='material-icons'>star rate</i></p>
                                         </div>
                                         <p>".$row['anio'],' ', $tabla_generos[$row['generos_id']]."</p>
                                         <p>".$row['sinopsis']."</p>
                                     </div>
                                     <div class='info-pelicula col s10 m10 l6'>
                                         <form action='./detalle.php' method='get'>
                                            <input type='hidden' name='idMovie' value='".$row['id']."'>
                                            <button  class='btn'> Ver mas</button>
                                         </form>";
                                         if (isset($_SESSION['log']) && $_SESSION['log'] == true && $_SESSION['admin'] == true) {
                                                echo "<form action='./ABMupdate.php' method='post'>
                                                      <input type='hidden' name='idMovie' value='".$row['id']."'>
                                                      <button  class='btn'>Editar</button>
                                                      </form>";
                                         }
                                     echo "
                                     </div>

                                     </div>
                                     ";
                                 };
                                 ?>
                             </span>
                         </div>
                     </div>

            <div class="paginas">
                <ul class="pagination">

                    <?php
                        for ($i= 1; $i <= $quantityPages; $i++){
                            echo "<li class='waves-effect'><a href='?page=".$i.$parameter."'>".$i."</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

<footer>
    <?php require_once('./layout/footer.php'); ?>
</footer>
</body>
