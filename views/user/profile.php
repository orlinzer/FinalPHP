
<div class="card">
  <h2>User</h2>
  <form action="" method="post" enctype="multipart/form-data" name="update-user">
    <div class="fields">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?=$user->getName()?>" required />

      <label for="about">About:</label>
      <textarea
        id="about"
        name="about"
        rows="10"
        cols="50"
        placeholder="Please Enter Text About Yourself"
        title="Please Enter Text About Yourself"
      ><?=$user->getAbout()?></textarea>

      <label for="image">Image:</label>
      <div>
        <input
          type="file"
          id="image"
          name="image"
          accept="image/webp,
          image/svg,
          image/avif,
          image/png,
          image/apng,
          image/gif,
          image/jpg,
          image/jpeg,
          image/jfif,
          image/pjpeg,
          image/pjp"
          title="Please Select an Profile Image"
        />
        <img src="<?= $user->getImage() ?>" alt="Image" width="48" >
      </div>

      <label for="email">Email:</label>
      <input
        type="email"
        id="email"
        name="email"
        placeholder="Please Enter Email"
        title="Please Enter Email"
        value="<?=$user->getEmail()?>"
        required
      />

      <label for="phone">Phone:</label>
      <input
        type="tel"
        id="phone"
        name="phone"
        placeholder="Please Enter Phone"
        title="Please Enter Phone"
        value="<?=$user->getPhone()?>"
      />

      <p>Number of Students:</p>
      <p><?= $instance->getNoOfStudents($user->getName()) ?></p>
    </div>

    <input type="submit" value="Update" title="Update" />
  </form>
</div>
<div class="card">
  <h2>Teachers</h2>
  <?php
    $teachers = $instance->getTeachers($user);
    foreach ($teachers as $teacher) {
      echo '<div class="teacher"><p>' . $teacher . '</p>';
      echo "<a href='user.php?remove_teacher=" . $teacher . "'>";
      echo "<img";
      echo "  class='clickable'";
      echo "  src='images/remove_black_48dp.svg'";
      echo "  alt='Remove'";
      echo "/>";
      echo "</a>";
      echo "</div>";
    }
  ?>
</div>
<div class="card">
  <h2>Projects</h2>
  <h3>Create new Project</h3>
  <form action="" method="post" enctype="multipart/form-data" name="create-project">
    <div class="fields">
      <label for="name">Name:</label>
      <input
        type="text"
        name="name"
        id="name"
        placeholder="Please Enter Project Name"
        title="Please Enter Project Name"
        required
      >

      <label for="about">About:</label>
      <textarea
        id="about"
        name="about"
        rows="10"
        cols="50"
        placeholder="Please Enter Text About The Project"
        title="Please Enter Text About The Project"
      ></textarea>

      <label for="image">Image:</label>
      <input
        type="file"
        id="image"
        name="image"
        accept="image/webp,
        image/svg,
        image/avif,
        image/png,
        image/apng,
        image/gif,
        image/jpg,
        image/jpeg,
        image/jfif,
        image/pjpeg,
        image/pjp"
        title="Please Select an Project Image"
      />
    </div>

    <input type="submit" value="Create">
  </form>
</div>
