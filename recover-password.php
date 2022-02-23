<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // Check if the user is connected
  if (isset($user)) {
    header("location: user.php");
    exit;
  }

  require_once('./views/main/main-top.php');
  require_once('./views/recover-password/recover-password.php');
  require_once('./views/main/main-bottom.php');
?>
