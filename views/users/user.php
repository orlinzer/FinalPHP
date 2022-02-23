<div class="user">
  <a href="user.php?user=<?= $u->getName() ?>">
    <img src="<?= $u->getImage() ?>" alt="User Image" width="48" />
    <p>
      <strong>User Name:</strong>
      <?= $u->getName() ?>
    </p>
    <p>
      <strong>User About:</strong>
      <?= $u->getAbout() ?>
    </p>
    <p>
      <strong>User Email:</strong>
      <?= $u->getEmail() ?>
    </p>
    <p>
      <strong>User Phone:</strong>
      <?= $u->getPhone() ?>
    </p>
    <p>
      <strong>User is Manager:</strong>
      <?= $u->getRole() ?>
    </p>
    <p>
      <strong>Number of Students:</strong>
      <?= $instance->getNoOfStudents($u->getName()) ?></p>
  </a>
  <?php
    if (isset($user)) {

      if ($instance->isATeacher($u->getName(), $user->getName())) {
        echo "<a href='users.php?remove_teacher=" . $u->getName() . "'>";
        echo "<img";
        echo "  class='clickable'";
        echo "  src='images/remove_black_48dp.svg'";
        echo "  alt='Remove'";
        echo "/>";
        echo "</a>";
      } else {
        echo "<a href='users.php?add_teacher=" . $u->getName() . "'>";
        echo "<img";
        echo "  class='clickable'";
        echo "  src='images/add_black_48dp.svg'";
        echo "  alt='Add'";
        echo "/>";
        echo "</a>";
      }
    }
  ?>

</div>
