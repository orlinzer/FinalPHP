<?php
  declare(strict_types = 1);

  require_once("../utils/DB.php");
  require_once("../models/User.php");

  // Check if the user is connected
  // session_start();
  // if (isset($_SESSION["user"])) {
  //   header("location: user.php");
  //   exit;
  // }

  $name = "";
  $password = "";
  $newName = "";
  $newImage = "";
  $newEmail = "";
  $newPhone = "";
  $newPassword = "";
  $confirmNewPassword = "";
  $nameErr = "";
  $passwordErr = "";
  $newNameErr = "";
  $newImageErr = "";
  $newEmailErr = "";
  $newPhoneErr = "";
  $newPasswordErr = "";
  $confirmNewPasswordErr = "";

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<form action='' method='post' enctype='multipart/form-data'>";
    echo "<label for='name'>Name:</label>";
    echo "<input type='text' name='name' id='name' value='$name'>";
    echo "<i style='color: #f00'>$nameErr</i>";
    echo "<br>";
    echo "<label for='password'>Password:</label>";
    echo "<input type='password' name='password' id='password' value='$password'>";
    echo "<i style='color: #f00'>$passwordErr</i>";
    echo "<br>";
    echo "<label for='new-name'>New Name:</label>";
    echo "<input type='text' name='name' id='name' value='$newName'>";
    echo "<i style='color: #f00'>$newNameErr</i>";
    echo "<br>";
    echo "<label for='new-image'>New Image</label>";
    echo "<input type='file' name='new-image' id='new-image' value='$newImage'>";
    echo "<i style='color: #f00'>$newImageErr</i>";
    echo "<br>";
    echo "<label for='new-email'>New Email:</label>";
    echo "<input type='email' name='new-email' id='new-email' value='$newEmail'>";
    echo "<i style='color: #f00'>$newEmailErr</i>";
    echo "<br>";
    echo "<label for='new-phone'>New Phone:</label>";
    echo "<input type='text' name='new-phone' id='new-phone' value='$newPhone'>";
    echo "<i style='color: #f00'>$newPhoneErr</i>";
    echo "<br>";
    echo "<label for='new-password'>New Password:</label>";
    echo "<input type='password' name='new-password' id='new-password' value='$newPassword'>";
    echo "<i style='color: #f00'>$newPasswordErr</i>";
    echo "<br>";
    echo "<label for='confirm-new-password'>Confirm New Password:</label>";
    echo "<input type='password' name='confirm-new-password' id='confirm-new-password' value='$confirmNewPassword'>";
    echo "<i style='color: #f00'>$confirmNewPasswordErr</i>";
    echo "<br>";
    echo "<input type='submit' value='Create'>";
    echo "</form>";
    echo "<a href='sign-in.php'>Sign In</a>";
    echo "<a href='recover-password.php'>Recover Password</a>";

  } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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

    $instance = DB::GetInstance();

    $hashPassword = $instance->getUserPassword($name);

    // echo $password . "<br>";
    // echo $hashPassword . "<br>";

    if (password_verify($password, $hashPassword)) {
      // echo "Verified!<br>";


      $user = $instance->getUser($name);

      $newPhone = trim($_POST["new-phone"] ?? "");
      if (!empty($newPhone)) {
          $instance->updateUserPhone($name, $newPhone);
      }

      $newPhone = trim($_POST["new-phone"] ?? "");
      if (!empty($newPhone)) {
          $instance->updateUserPhone($name, $newPhone);
      }

      $newEmail = trim($_POST["new-email"] ?? "");
      if (!empty($newEmail)) {
          $instance->updateUserEmail($name, $newEmail);
      }

      $newPassword = trim($_POST["new-password"] ?? "");
      $confirmNewPassword = trim($_POST["confirm-new-password"] ?? "");
      if (!empty($newPassword) &&
          $newPassword === $confirmNewPassword &&
          strlen($newPassword) >= 8 && (preg_match('/[a-z]/', $newPassword) &&
                 preg_match('/[A-Z]/', $newPassword) &&
                 preg_match('/[0-9]/', $newPassword) &&
                 preg_match('/[ !"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]/', $newPassword))) {
        $hashPassword = password_hash(newPassword, PASSWORD_DEFAULT);
        $instance->updateUserPassword($name, $hashPassword);
      }

      $user = $instance->getUser($name);

      print($user);

      // echo "SUCCESS";
      $_SESSION["user"] = $user;
      // header("location: user.php");
      exit;
    }
    echo "ERROR";








    // // Validate name
    // $name = trim($_POST["name"] ?? "");
    // if (empty($name)) {
    //   $nameErr = "Please enter a name.";
    // } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
    //   $nameErr = "Name can only contain letters, numbers, and underscores.";
    // } else if ($instance->isUserExist($name)) {
    //   $nameErr = "This username already exists.";
    // }

    // // TODO: create only after validation
    // if (isset($_POST["name"])) {
    //   $image = base64_decode($_POST["image"]);
    //   // $image = base64_encode($_POST["image"]);

    //   // print($_POST["image"] . "<br>");
    //   // print($image);

    //   if ($image) {
    //     try {
    //       if (!is_dir("..\\users\\" . $name)) {
    //         mkdir("..\\users\\" . $name);
    //       }
    //       $fd = fopen("..\\users\\" . $name . "\\user_image.jpeg", "w");

    //       if ($fd) {
    //         fwrite($fd, $image);
    //       }
    //     } catch (Throwable $th) {
    //       //throw $th;
    //     } finally {
    //       fclose($fd);
    //     }
    //   }
    // }

    // // if (isset($_FILES['image']['tmp_name'])) {
    // //   $fileName = $_FILES['image']['tmp_name'];
    // //   if (file_exists($fileName)) {
    // //     mkdir("..\\users\\" . $name);

    // //     $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    // //     move_uploaded_file($fileName, "..\\users\\" . $name . "\\user_image." . $ext);
    // //     // move_uploaded_file($fileName, "user_image." . $ext);
    // //   }
    // // }

    // if (!isset($_POST['email'])) { exit; }
    // $email = trim($_POST['email'] ?? "");
    // if (empty($email)) {
    //   $email_err = "Please enter an email.";
    // } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //   $email_err = "Please enter a valid email.";
    // }

    // if (!isset($_POST['phone'])) { exit; }
    // $phone = $_POST['phone'];

    // // Validate password
    // $password = trim($_POST["password"] ?? "");
    // if (empty($password)) {
    //   $passwordErr = "Please enter a password.";
    // } else if (strlen($password) < 8) {
    //   $passwordErr = "Password must contain at least 8 characters.";
    // } else if (!(preg_match('/[a-z]/', $password) &&
    //              preg_match('/[A-Z]/', $password) &&
    //              preg_match('/[0-9]/', $password) &&
    //              preg_match('/[ !"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]/', $password))) {
    //   $passwordErr = "Password must contain uppercase letter, lowercase letter, number and a special character ( !\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~).";
    // }

    // // Validate password
    // $confirmPassword = trim($_POST["confirm-password"] ?? "");
    // if (empty($confirmPassword)) {
    //   $confirmPasswordErr = "Please confirm password.";
    // } else if ($confirmPassword !== $password) {
    //   $confirmPasswordErr = "Password did not match.";
    // }

    // if (empty($nameErr) && empty($passwordErr) && empty($confirmPasswordErr)) {

    //   $hashPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //   $user = new User();
    //   $user->setName($name);
    //   $user->setEmail($email);
    //   $user->setPhone($phone);

    //   print($user); // DBG

    //   $instance->addUser($user, $hashPassword);
    //   // echo "SUCCESS";

    // } else {
    //   // TODO:
    //   echo "ERROR";
    // }
  }

?>
