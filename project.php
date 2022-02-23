<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // Check if the user is connected
  if (!(isset($user) && isset($project)) && !(isset($userToShow) && isset($projectToShow))) {
    header("location: user.php");
    exit;
  }

  require_once('./views/main/main-top.php');
  require_once('./views/project/project.php');
  require_once('./views/main/main-bottom.php');
?>
