<?php
  declare(strict_types = 1);

  session_start();

  // session_unset($_SESSION["user"]);
  $_SESSION = array();

  session_destroy();
?>
<h2>You are sign out</h2>
<a href="sign-in.php">Sign In</a>
<a href="sign-up.php">Sign Up</a>
