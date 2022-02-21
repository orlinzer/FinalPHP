<?php
  declare(strict_types = 1);

  require_once "../models/User.php";

  // Check if the user is disconnected
  session_start();
  if (!isset($_SESSION["user"])) {
    header("location: sign-in.php");
    exit;
  }

  $user = $_SESSION["user"];
?>

<h2>Hello</h2>
<p>Name: <?=$user->getName()?></p>
<p>Image:
<img src="<?=$user->getImage()?>" alt="User Image">
</p>
<?=$user->getImage()?>
<p>Email: <?=$user->getEmail()?></p>
<p>Phone: <?=$user->getPhone()?></p>
<p>Role: <?=$user->getRole()?></p>

<a href="sign-out.php">Sign Out</a>
<a href="update-user.php">Update User</a>
<!-- <form action='sign-out.php' method='POST'>
  <input type='submit' value='sign out' />
</form> -->
