<?php
  declare(strict_types = 1);

  // get the session if exist
  require_once('utils/Session.php');

  // Check if the user is connected
  if (!isset($user) && !isset($userToShow)) {
    header("location: sign-in.php");
    exit;
  }

  require_once('./views/main/main-top.php');

  // Display profile
  if (isset($user) && $user->isEqual($userToShow)) {
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
      print_r($_POST); // DBG

      $submit = $_POST['submit'];
      if ($submit == 'Update') {


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
          $user->setImage($fileName);
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
      } else if ($submit == 'Create') {

        $name = trim($_POST["name"] ?? "");
        if (empty($name)){
          $nameErr = "Please enter a name.";
        } else if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)){
          $nameErr = "Name can only contain letters, numbers, and underscores.";
        } else if ($instance->isProjectExist($user->getName(), $name)) {
          $nameErr = "This username already exists.";
        }

        $project = new Project();
        $project->setName($name);

        if (isset($_FILES['image']['tmp_name'])) {
          $fileName = $_FILES['image']['tmp_name'];
          $project->setImage($user, $fileName);
        }

        $instance->addProject($user, $name);

        // echo $project; // DBG

        $_SESSION["project"] = $project;

        header("location: project.php");
        exit;
      }
    }

    if (isset($_GET['remove_teacher'])) {
      $teacher = $_GET['remove_teacher'];
      $instance->removeTeacher($teacher, $user->getName());
    }

    require_once('./views/user/profile.php');
  } else { // Display user
    require_once('./views/user/user.php');
  }

  require_once('./views/main/main-bottom.php');
?>
