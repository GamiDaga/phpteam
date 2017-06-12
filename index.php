<?php
    // session_start();

    require_once('./sql/connect.php');
    require_once('./sql/query.php');
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

         <div class="parallax-container">
             <div class="parallax"><img src="./images/background.jpg"></div>
         </div>


             <div id="filter-nav" class="nav-wrapper gris-1">
                 <nav>
                     <form>

                         <div class="separador">
                             <label>Ordenar por:</label>
                             <p>
                                 <input id="nombe" value="nombre" type="radio" name="orderBy" class="validate" />
                                 <label for="nombe">Nombre</label>
                             </p>
                             <p>
                                 <input id="anio" value="anio" type="radio" name="orderBy" class="validate"/>
                                 <label for="anio">Año</label>
                             </p>

                         </div>

                         <div class="separador">
                             <label>Orden</label>
                             <p>
                                 <input id="ascendente" value="ASC" type="radio" name="formatOrder" class="validate"/>
                                 <label for="ascendente">Ascendente</label>
                             </p>
                             <p>
                                 <input id="descendiente" value="DESC" type="radio" name="formatOrder" class="validate"/>
                                 <label for="descendiente">Descendiente</label>
                             </p>
                         </div>

                         <div class="separador">
                             <ul class="">
                                 <div class="input-field">
                                     <li>
                                         <input id="search" type="search"/>
                                         <label class="label-icon" for="search">
                                             <i class="material-icons">search</i></label>
                                             <i class="material-icons">close</i>
                                         </li>
                                     </div>
                                 </ul>
                             </div>
                             <div>
                                 <button type="submit" class="btn btn-submit">Buscar</button>
                             </div>
                         </form>

                     </nav>
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
                                 if (isset($_GET['orderBy']) && isset($_GET['formatOrder'])) {
                                     $query = pageMovies($start_from, $quantity_rows_in_page, $_GET['orderBy'],$_GET['formatOrder']);
                                 }elseif (isset($_GET['orderBy'])) {
                                     $query = pageMovies($start_from, $quantity_rows_in_page, $_GET['orderBy'],null);
                                 }elseif (isset($_GET['formatOrder'])) {
                                     $query = pageMovies($start_from, $quantity_rows_in_page, null,$_GET['formatOrder']);
                                 }else {
                                     $query = pageMovies($start_from, $quantity_rows_in_page, null,null);
                                 }
                                 //echo "<pre>";var_dump($_GET['orderBy'],$_GET['formatOrder'],$query);exit();
                                 //echo '<pre>'; var_dump($query); exit();
                                 $result = mysqli_query($link, $query);
                                 //echo '<pre>'; var_dump($result); exit();
                                 //Crea un bluce 'while' y define a la variable 'datos' ($row) como clave del array
                                 //que mostrará los resultados por nombre
                                 while($row = mysqli_fetch_assoc($result)) {
                                     echo "<div class='row'>";
                                     echo "<span class='imagen-index'><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>" // aca va la imagen desde el sql pero misteriosamente no funiona
                                     //echo "<img src='./Carteles/el-senor-de-los-anillos-la-comunidad-del-anillo.jpg' width='300px' height='450px'>"
                                     ."<h1>".$row['nombre']."</h1>"
                                     ."<p>".$row['anio']."</p>"
                                     ."<p>".$row['sinopsis']."</p>";
                                     echo "<form action='./detalle.php' method='get'>
                                     <input type='hidden' name='idMovie' value='".$row['id']."'>
                                     <button  class='btn'> Ver mas</button>
                                     </form>";

                                     echo "</div>";
                                 };
                                 ?>
                             </span>
                         </div>
                     </div>

            <div class="paginas">
                <ul class="pagination">

                    <?php
                        for ($i= 1; $i <= $quantityPages; $i++){
                            if ($currentPage == $i) {
                                echo "<li class='active' class='waves-effect'><a href='?page=".$i.$parameter."'>".$i."</a></li>";
                            }else{
                                echo "<li class='waves-effect'><a href='?page=".$i.$parameter."'>".$i."</a></li>";
                            }
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
