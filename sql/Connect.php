<?php

  function conect(){
       $mysqli = mysqli_connect('localhost', 'root', 'root','phpteam') or die ('Error');
       return $mysqli;
  }

 ?>
