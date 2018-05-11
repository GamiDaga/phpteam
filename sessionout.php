<?php
    session_start();
    $_SESSION['log'] = false;
    session_unset();
    session_destroy();
    header("location:./index.php");
    //last commit
 ?>
