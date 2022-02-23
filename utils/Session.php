<?php
  declare(strict_types = 1);

  // Modules
  require_once('models/User.php');
  require_once('models/Project.php');

  // System Utils
  require_once('utils/FS.php');
  require_once('utils/DB.php');

  // Instance of the Database
  $instance = DB::GetInstance();

  // Check if the user is connected
  session_start();

  // Get User and Project from the session
  if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    if (isset($_SESSION["project"])) {
      $project = $_SESSION["project"];
      $fs = new FS($user, $project);
    } else {
      $fs = new FS($user);
    }
  }

  // Get the User and the Project to show
  if (isset($_GET['user'])) {
    $userToShowName = $_GET['user'];
    $userToShow = $instance->getUser($userToShowName);
    if (isset($_GET['project'])) {
      $projectToShowName = $_GET['project'];
      $projectToShow = $instance->getProject($userToShowName, $projectToShowName);
      $projectToShowFS = new FS($userToShow, $projectToShow);
    } else {
      $userToShowFS = new FS($userToShow);
    }
  }

?>
