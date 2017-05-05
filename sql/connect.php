<?php

  function connect(){
       $mysqli = mysqli_connect('localhost', 'root', 'root','peliculas') or die ("Error ".mysqli_error($mysqli));
       return $mysqli;
  }

 ?>
