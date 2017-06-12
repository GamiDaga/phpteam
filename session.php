<?php
  require_once("./classUser.php");
  $user = new user;

  try {

    $userName = htmlspecialchars($_POST["user"],ENT_QUOTES);
    $password = htmlspecialchars($_POST["password"],ENT_QUOTES);   //para evitar sql injection


    $user->validate($userName, $password);
    session_start();
    $_SESSION['log'] = true;
    $_SESSION['name'] = $user->getName();
    $_SESSION['lastname'] = $user->getLastname();
    $_SESSION['userName'] = $user->getUserName();
    $_SESSION['email'] = $user->getEmail();
    $_SESSION['admin'] = $user->getAdmin();

    echo "asdasd";

  } catch (Exception $e) {
       $_SESSION["log"] = false;
       echo "Error al loguearse";exit();
  }
  header("location:./index.php");

  // $user = "admingmail.com";
  // $pass = "admin";

 ?>
