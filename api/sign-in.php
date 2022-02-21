<?php
  declare(strict_types = 1);

  require_once("../utils/DB.php");
  require_once("../models/User.php");

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<form action='' method='post'>";
    echo "<label for='name'>Name:</label>";
    echo "<input type='text' name='name' id='name'><br>";
    echo "<label for='password'>Password:</label>";
    echo "<input type='password' name='password' id='password'><br>";
    echo "<input type='submit' value='Sign-in'>";
    echo "</form>";
  } else //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processing form data when form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "test<br>";

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

    // echo $password . "<br>";
    // echo $hashPassword . "<br>";

    if (password_verify($password, $hashPassword)) {
      // echo "Verified!<br>";

      $user = $instance->getUser($name);

      print($user);

      // echo "SUCCESS";
      $_SESSION["user"] = $user;
      // header("location: user.php");
      exit;
    } else {
      echo "ERROR";
      // echo "Invalid username or password!<br>";
    }
    echo "ERROR";
  // }
  //   if (!isset($_POST['name'])) { exit; }
  //   $name = $_POST['name'];

  //   if (!isset($_POST['password'])) { exit; }
  //   // Create a hash of the given password
  //   $password = $_POST['password'];

  //   $instance = DB::GetInstance();

  //   $hashPassword = $instance->getUserPassword($name);

  //   print($hashPassword); // DBG

  //   echo "<br>";

  //   if (password_verify($password, $hashPassword)) {
  //     echo "Verified!" . "<br>";

  //     session_start();
  //     if (!isset($_SESSION["user"])) {
  //       $user = $instance->getUser($name);

  //       $_SESSION["user"] = $user;
  //     }
  //   } else {
  //     echo "Invalid password!" . "<br>";
  //   } // TODO: continue

  //   header("location: /views/user.php");
  } else {
    // TODO:
    // echo "ERROR!";
  }


?>
