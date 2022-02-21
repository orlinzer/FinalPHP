<?php
  declare(strict_types = 1);

  require_once('./models/User.php');

  // Check if the user is connected
  session_start();

  if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
  } else {
    $user = new User();
    $_SESSION["user"] = $user;
  }

  require_once('./views/main.php');

?>
