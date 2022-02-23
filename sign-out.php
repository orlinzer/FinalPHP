<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // reset the session (sign out)
  $_SESSION = array();
  session_destroy();

  require_once('./views/main/main-top.php');
  require_once('./views/sign-out/sign-out.htm');
  require_once('./views/main/main-bottom.php');
?>
