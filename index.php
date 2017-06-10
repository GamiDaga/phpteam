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


      <div id="filter-nav" class="nav-wrapper gris-1">
          <nav>
            <form>

                <div class="separador">
                  <label>Ordenar por:</label>
                  <p>
                    <input id="nombe" type="radio" name="type-order" class="validate"/>
                    <label for="nombe">Nombre</label>
                  </p>
                  <p>
                    <input id="anio" type="radio" name="type-order" class="validate"/>
                    <label for="anio">Año</label>
                  </p>
                </div>

                <div class="separador">
                  <label>Orden</label>
                  <p>
                    <input id="ascendente" type="radio" name="order" class="validate"/>
                    <label for="ascendente">Ascendente</label>
                  </p>
                  <p>
                    <input id="descendiente" type="radio" name="order" class="validate"/>
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
                  <button type="submit" class="btn btn-submit"  name="button">Buscar</button>
                </div>
            </form>

        </nav>
    </div>

    <div class="container">

        <div class="section-movie">
            <h2 class="header">Peliculas</h2>
                <div class="movie-section">
                    <?php
                    //Evitamos que salgan errores por variables vacías
                    //error_reporting(E_ALL ^ E_NOTICE);
                    //Cantidad de resultados por página (debe ser INT, no string/varchar)
                    $quantity_rows_in_page = 5;
                    //Comprueba si está seteado el GET de HTTP
                    if (isset($_GET["page"])) {
                    	//Si el GET de HTTP SÍ es una string / cadena, procede
                    	if (is_string($_GET["page"])) {
                    		//Si la string es numérica, define la variable 'pagina'
                    		 if (is_numeric($_GET["page"])) {
                    			 //Si la petición desde la paginación es la página uno
                    			 //en lugar de ir a 'index.php?pagina=1' se iría directamente a 'index.php'
                    			 if ($_GET["page"] == 1) {
                    				 header("Location: index.php");
                    				 die();
                    			 }else{ //Si la petición desde la paginación no es para ir a la pagina 1, va a la que sea
                    				 $page = $_GET["page"];
                    			 };
                    		 }else{ //Si la string no es numérica, redirige al index (por ejemplo: index.php?pagina=AAA)
                    			 header("Location: index.php");
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
                        $query = pageMovies($start_from, $quantity_rows_in_page);
                        //echo '<pre>'; var_dump($query); exit();
                        $result = mysqli_query($link, $query);
                        //echo '<pre>'; var_dump($result); exit();
                        //Crea un bluce 'while' y define a la variable 'datos' ($row) como clave del array
                        //que mostrará los resultados por nombre
                        while($row = mysqli_fetch_assoc($result)) {
                                    echo "<div class='row'>";
                                    echo "<span class='imagen-index'><img src='./functions/showImage.php?idMovie=".$row['id']."'></span>" // aca va la imagen desde el sql pero misteriosamente no funiona
                                    //echo "<img src='./Carteles/el-senor-de-los-anillos-la-comunidad-del-anillo.jpg' width='300px' height='450px'>"
                                        ."<h3>".$row['nombre']."</h1>"
                                        ."<p>".$row['anio']."</p>"
                                        ."<p>".$row['sinopsis']."</p>";
                                        echo "<form action='./detalle.php' method='get'>
                                        <input type='hidden' name='id' value='".$row['id']."'>
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
                        if (isset($_GET['page'])) {
                            $currentPage = $_GET['page'];
                            $previousPage = $currentPage - 1;
                            $chevron_left = '';
                        }else{
                            $currentPage = 1;
                            $previousPage = "#";
                            $chevron_left = "disabled";
                        }

                        if (isset($_GET['page']) && $_GET['page'] == $quantityPages) {
                            $nextPage = '#';
                            $chevron_right = "disabled";
                        } else {
                            $nextPage = $currentPage + 1;
                            $chevron_right = '';
                        }


                        echo "<li class='".$chevron_left."'><a href='?page='".$previousPage."'><i class='material-icons'>chevron_left</i></a></li>";
                        for ($i= 1; $i <= $quantityPages; $i++){
                            if ($currentPage == $i) {
                                echo "<li class='active' class='waves-effect'><a href='?page=".$i."'>".$i."</a></li>";
                            }else{
                                echo "<li class='waves-effect'><a href='?page=".$i."'>".$i."</a></li>";
                            }
                        }
                        echo "<li class='".$chevron_right."' class='waves-effect'><a href=?page=".$nextPage."><i class='material-icons'>chevron_right</i></a></li>";
                    ?>
                </ul>
            </div>
          </div>
        </div>
    </div>


<?php require_once('./layout/footer.php'); ?>
</body>
