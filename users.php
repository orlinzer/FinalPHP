<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // Handle teachers
  if (isset($user)){
    if (isset($_GET['add_teacher'])) {
      $teacher = $_GET['add_teacher'];
      $instance->addTeacher($teacher, $user->getName());
    } else if (isset($_GET['remove_teacher'])) {
      $teacher = $_GET['remove_teacher'];
      $instance->removeTeacher($teacher, $user->getName());
    }
  }

  require_once('views/main/main-top.php');
  require_once('views/users/users.php');
  require_once('views/main/main-bottom.php');
?>
