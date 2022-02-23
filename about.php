<?php
  declare(strict_types = 1);

  require_once("utils/DB.php");
  require_once('utils/FS.php');

  // get the user data from the session if exist
  require_once('utils/Session.php');

  $instance = DB::GetInstance();

  if (isset($_GET['user'])) {
    $userToShowName = $_GET['user'];
    $userToShow = $instance->getUser($userToShowName);
    $userToShowFS = new FS($userToShow);
  } else if (!isset($user)) {
    header("location: sign-in.php");
    exit;
  }

  require_once('./views/main/main-top.php');
  require_once('./views/about/about.html');
  require_once('./views/main/main-bottom.php');
?>
