<div class="users">

  <h2>Users</h2>

  <?php
  $instance = DB::GetInstance();
  $users = $instance->getUsers();

    foreach ($users as $u) {
      require('views/users/user.php');
    }
  ?>
</div>
