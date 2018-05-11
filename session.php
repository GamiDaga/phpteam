<?php
//last commit
    require_once("./layout/head.php");
    require_once("./classUser.php");
    require_once('./sql/connect.php'); $link = connect();
    echo "<body>";
    echo "<header>";
    require_once('./layout/header.php');
    echo "</header>";
  if (!isset($_POST["userNameLog"]) || !isset($_POST["contraseñaLog"])) {
    echo "<div class='AlgoMal'>";
    echo "  <h2>Algo anduvo mal</h2>";
    echo "  <p>No se recibió un usuario o contraseña para loguearse</p>";
    echo "  <br><a class='btn ' href='./index.php'>Volver al Inicio</a>";
    echo "</div>";
  }else{
    try {

      $userName = htmlspecialchars($_POST["userNameLog"],ENT_QUOTES);
      $password = htmlspecialchars($_POST["contraseñaLog"],ENT_QUOTES);   //para evitar sql injection


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
      header("location:./index.php");

    }catch (Exception $e) {
      $_SESSION["log"] = false;
      echo "<div class='AlgoMal'>";
      echo "  <h2>Algo anduvo mal</h2>";
      echo "  <p>El usuario o contraseña es incorrecta</p>";
      echo "  <br><a class='btn ' href='./index.php'>Volver al Inicio</a>";
      echo "</div>";

    }
}
      echo "<footer>";
        require_once('./layout/footer.php');
      echo "</footer>";

echo "</body>";

  // $user = "admingmail.com";
  // $pass = "admin";

 ?>
