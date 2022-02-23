<?php
  declare(strict_types = 1);

  // require_once("../utils/DB.php");
  // require_once("../models/User.php");

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

    $instance = DB::GetInstance();

    // Validate name
    $name = trim($_POST["name"] ?? "");
    if (empty($name)){
      $nameErr = "Please enter a name.";
    } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)){
      $nameErr = "Name can only contain letters, numbers, and underscores.";
    } else if ($instance->isUserExist($name)) {
      $nameErr = "This username already exists.";
    }

    // TODO: create only after validation
    if (isset($_FILES['image']['tmp_name'])) {
      $fileName = $_FILES['image']['tmp_name'];
      if (file_exists($fileName)) {

        mkdir("..\\users\\" . $name);

        // $_FILES['image']['name'];
        // $_FILES['image']['type'];
        // $_FILES['image']['size'];
        // $_FILES['image']['tmp_name'];
        // $_FILES['image']['error'];
        // $_FILES['image']['full_path'];
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        move_uploaded_file($fileName, "..\\users\\" . $name . "\\user_image." . $ext);
        // move_uploaded_file($fileName, "user_image." . $ext);
      }
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

      $user = new User();
      $user->setName($name);
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
?>

<form action='' method='post' enctype="multipart/form-data">
  <label for='name'>Name:</label>
  <input type='text' name='name' id='name' value="<?=$name?>">
  <i style="color: #f00"><?=$nameErr?></i>
  <br>

  <label for="image">Image</label>
  <input type="file" name="image" id="image" value="<?=$image?>">
  <i style="color: #f00"><?=$imageErr?></i>
  <br>

  <label for='email'>Email:</label>
  <input type='email' name='email' id='email' value="<?=$email?>">
  <i style="color: #f00"><?=$emailErr?></i>
  <br>

  <label for='phone'>Phone:</label>
  <input type='text' name='phone' id='phone' value="<?=$phone?>">
  <i style="color: #f00"><?=$phoneErr?></i>
  <br>

  <label for='password'>Password:</label>
  <input type='password' name='password' id='password' value="<?=$password?>">
  <i style="color: #f00"><?=$passwordErr?></i>
  <br>

  <label for='confirm-password'>Confirm Password:</label>
  <input type='password' name='confirm-password' id='confirm-password' value="<?=$confirmPassword?>">
  <i style="color: #f00"><?=$confirmPasswordErr?></i>
  <br>

  <input type='submit' value='Create'>
</form>

<a href="sign-in.php">Sign In</a>
<a href="recover-password.php">Recover Password</a>