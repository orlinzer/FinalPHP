<?php
  declare(strict_types = 1);

  require_once('models/User.php');
  require_once('utils/FS.php');

  // Check if the user is connected
  session_start();

  if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $fs = new FS($user);
  }

?>
