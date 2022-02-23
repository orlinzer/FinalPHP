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

  require_once('./views/main-top.php');

  if (isset($userToShow) && (!isset($user) || !$user->isEqual($userToShow))) {
    require_once('./views/user/user.php');
  } else {
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

    $instance = DB::GetInstance();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      print_r($_POST); // DBG


      // // Validate name
      // $name = trim($_POST["name"] ?? "");
      // if (empty($name)){
      //   $name_err = "Please enter a name.";
      // // } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)){
      //   // $name_err = "Name can only contain letters, numbers, and underscores.";
      // // } else if ($instance->isUserExist($name)) {
      //   // $name_err = "This username is already taken.";
      // }

      // // Validate password
      // $password = trim($_POST["password"] ?? "");
      // if (empty($password)) {
      //   $password_err = "Please enter a password.";
      // // } else if (strlen($password)) < 8) {
      //   // $password_err = "Password must have atlas 8 characters.";
      // // } else if (!(preg_match('/[a-z]/', $name) && preg_match('/[A-Z]/', $name) && preg_match('/[0-9]/', $name))) {
      //   // $password_err = "Password must contain uppercase letter lowercase letter and a number.";
      // }

      // $hashPassword = $instance->getUserPassword($name);

      $about = trim($_POST["about"] ?? "");
      if (!empty($about)) {
        $user->setAboutFile($about);
      }

      // $user = $instance->getUser($name);
      if (isset($_FILES['image']['tmp_name'])) {
        $fileName = $_FILES['image']['tmp_name'];
        $user->setImageFile($fileName);
      }

      $phone = trim($_POST["phone"] ?? "");
      if (!empty($phone)) {
          $instance->updateUserPhone($user->getName(), $phone);
      }

      $email = trim($_POST["email"] ?? "");
      if (!empty($email)) {
          $instance->updateUserEmail($user->getName(), $email);
      }

      // $newPassword = trim($_POST["new-password"] ?? "");
      // $confirmNewPassword = trim($_POST["confirm-new-password"] ?? "");
      // if (!empty($newPassword) &&
      //     $newPassword === $confirmNewPassword &&
      //     strlen($newPassword) >= 8 && (preg_match('/[a-z]/', $newPassword) &&
      //             preg_match('/[A-Z]/', $newPassword) &&
      //             preg_match('/[0-9]/', $newPassword) &&
      //             preg_match('/[ !"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]/', $newPassword))) {
      //   $hashPassword = password_hash(newPassword, PASSWORD_DEFAULT);
      //   $instance->updateUserPassword($name, $hashPassword);
      // }

      $user = $instance->getUser($user->getName());

      // print($user); // DBG

      // echo "SUCCESS";
      $_SESSION["user"] = $user;
    }

    if (isset($_GET['remove_teacher'])) {
      $teacher = $_GET['remove_teacher'];
      $instance->removeTeacher($teacher, $user->getName());
    }

    require_once('./views/user/profile.php');
  }

  require_once('./views/main-bottom.php');
?>
