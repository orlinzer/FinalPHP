<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // Check if the user is connected
  if (isset($user)) {
    header("location: user.php");
    exit;
  }

  $nameErr = "";
  $imageErr = "";
  $emailErr = "";
  $phoneErr = "";
  $passwordErr = "";
  $confirmPasswordErr = "";
  $name = "";
  $image = "";
  $email = "";
  $phone = "";
  $password = "";
  $confirmPassword = "";

  // Processing form data when form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate name
    $name = trim($_POST["name"] ?? "");
    if (empty($name)){
      $nameErr = "Please enter a name.";
    } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)){
      $nameErr = "Name can only contain letters, numbers, and underscores.";
    } else if ($instance->isUserExist($name)) {
      $nameErr = "This username already exists.";
    }

    $user = new User();
    $user->setName($name);

    // TODO: create only after validation
    if (isset($_FILES['image']['tmp_name'])) {
      $fileName = $_FILES['image']['tmp_name'];
      $user->setImage($fileName);
    }

    if (!isset($_POST['email'])) { exit; }
    $email = trim($_POST['email'] ?? "");
    if (empty($email)) {
      $email_err = "Please enter an email.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Please enter a valid email.";
    }

    if (!isset($_POST['phone'])) { exit; }
    $phone = $_POST['phone'];

    // Validate password
    $password = trim($_POST["password"] ?? "");
    if (empty($password)) {
      $passwordErr = "Please enter a password.";
    } else if (strlen($password) < 8) {
      $passwordErr = "Password must contain at least 8 characters.";
    } else if (!(preg_match('/[a-z]/', $password) &&
                 preg_match('/[A-Z]/', $password) &&
                 preg_match('/[0-9]/', $password) &&
                 preg_match('/[ !"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]/', $password))) {
      $passwordErr = "Password must contain uppercase letter, lowercase letter, number and a special character ( !\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~).";
    }

    // Validate password
    $confirmPassword = trim($_POST["confirm-password"] ?? "");
    if (empty($confirmPassword)) {
      $confirmPasswordErr = "Please confirm password.";
    } else if ($confirmPassword !== $password) {
      $confirmPasswordErr = "Password did not match.";
    }

    if (empty($nameErr) && empty($passwordErr) && empty($confirmPasswordErr)) {

      $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $user->setEmail($email);
      $user->setPhone($phone);

      // print($user); // DBG

      $instance->addUser($user, $hashPassword);

      // TODO: verification by email
      mail($email, "YPO-IDE User confirmation", "Please confirm your YPO-IDE user by clicking <a href=''>here</a> ");

      $_SESSION["user"] = $user;
      header("location: user.php");
      exit;
    }
  }

  require_once('./views/main/main-top.php');
  require_once('./views/sign-up/sign-up.htm');
  require_once('./views/main/main-bottom.php');
?>
