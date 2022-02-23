
<div class="card">
  <h2>Project</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="fields">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?=$project->getName()?>" required />

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
        <!-- <img src="<?= $user->getImage() ?>" alt="Image" width="48" > -->
        <!-- <?= $project ?> -->
        <img src="<?= $project->getImage($user) ?>" alt="Image" width="48" >
      </div>
    </div>

    <input type="submit" name="submit" value="Update" title="Update" />
  </form>
</div>
<div class="card">
  <h2>File</h2>
  <h3>Create new Project</h3>
  <!-- <form action="" method="post" enctype="multipart/form-data">
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

    <input type="submit" name="submit" value="Create"  title="Create">
  </form> -->
</div>
