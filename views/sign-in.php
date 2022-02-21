<?php
  declare(strict_types = 1);

  require_once("../utils/DB.php");
  require_once("../models/User.php");

  // Check if the user is connected
  session_start();
  if (isset($_SESSION["user"])) {
    header("location: user.php");
    exit;
  }

  // Processing form data when form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "test<br>";

    $instance = DB::GetInstance();

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

    echo $password . "<br>";
    echo $hashPassword . "<br>";

    if (password_verify($password, $hashPassword)) {
      echo "Verified!<br>";

      $user = $instance->getUser($name);

      print($user);

      $_SESSION["user"] = $user;
      header("location: user.php");
      exit;
    } else {
      echo "Invalid username or password!<br>";
    }
  }
?>

<form action='' method='post'>
  <label for='name'>Name:</label>
  <input type='text' name='name' id='name'><br>

  <label for='password'>Password:</label>
  <input type='password' name='password' id='password'><br>

  <input type='submit' value='Sign-in'>
</form>
<a href="sign-up.php">Sign Up</a>
<a href="recover-password.php">Recover Password</a>
