<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // Check if the user is connected
  if (isset($user)) {
    header("location: user.php");
    exit;
  }

  // Processing form data when form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate name
    $name = trim($_POST["name"] ?? "");
    if (empty($name)){
      $name_err = "Please enter a name.";
    // } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)){
      // $name_err = "Name can only contain letters, numbers, and underscores.";
    // } else if ($instance->isUserExist($name)) {
      // $name_err = "This username is already taken.";
    }

    // Validate password
    $password = trim($_POST["password"] ?? "");
    if (empty($password)) {
      $password_err = "Please enter a password.";
    // } else if (strlen($password)) < 8) {
      // $password_err = "Password must have atlas 8 characters.";
    // } else if (!(preg_match('/[a-z]/', $name) && preg_match('/[A-Z]/', $name) && preg_match('/[0-9]/', $name))) {
      // $password_err = "Password must contain uppercase letter lowercase letter and a number.";
    }

    $hashPassword = $instance->getUserPassword($name);

    // echo $password . "<br>";
    // echo $hashPassword . "<br>";

    if (password_verify($password, $hashPassword)) {
      // echo "Verified!<br>";

      $user = $instance->getUser($name);

      // print($user); // DBG

      $_SESSION["user"] = $user;
      header("location: user.php");
      exit;
    } else {
      // echo "Invalid username or password!<br>";
    }
  }


  require_once('./views/main/main-top.php');
  require_once('./views/sign-in/sign-in.htm');
  require_once('./views/main/main-bottom.php');
?>
