<?php
//last commit
  function connect(){
       $mysqli = mysqli_connect('localhost', 'root', 'root','phpteam') or die ("Error ".mysqli_error($mysqli));
       return $mysqli;
  }

 ?>
