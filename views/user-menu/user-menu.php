<div class="user-menu hidden">
  <?php
    if (isset($user)) {
      print("<a href='user.php'>User</a>");
      print("<a href='sign-out.php'>Sign-Out</a>");
    } else {
      print("<a href='sign-in.php'>Sign-In</a>");
      print("<a href='sign-up.php'>Sign-Up</a>");
      print("<a href='recover-password.php'>Recover Password</a>");
    }
  ?>
</div>
