<?php

  function connect(){
       $mysqli = mysqli_connect('localhost', 'root', '','phpteam') or die ("Error ".mysqli_error($mysqli));
       return $mysqli;
  }

 ?>