<?php
    require_once("./layout/head.php");
    require_once("./classUser.php");
    require_once('./sql/connect.php'); $link = connect();

  try {

    $userName = htmlspecialchars($_POST["user"],ENT_QUOTES);
    $password = htmlspecialchars($_POST["password"],ENT_QUOTES);   //para evitar sql injection


    $user = new user;
    $user->validate($userName, $password,$link);
    session_start();
    $_SESSION['log'] = true;
    $_SESSION['id'] = $user->getId();
    $_SESSION['name'] = $user->getName();
    $_SESSION['lastname'] = $user->getLastname();
    $_SESSION['userName'] = $user->getUserName();
    $_SESSION['email'] = $user->getEmail();
    $_SESSION['admin'] = $user->getAdmin();

  } catch (Exception $e) {
       $_SESSION["log"] = false;
       echo "Error al loguearse";
       echo "<a class='btn' href='./index.php'>Volver al index</a>";

       exit();
  }
  header("location:./index.php");

  // $user = "admingmail.com";
  // $pass = "admin";

 ?>
