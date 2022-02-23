<?php
  declare(strict_types = 1);

  session_start();

  // session_unset($_SESSION["user"]);
  $_SESSION = array();

  session_destroy();

  require_once('./views/main/main-top.php');
  require_once('./views/sign-out/sign-out.htm');
  require_once('./views/main/main-bottom.php');
?>
