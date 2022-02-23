<?php
  declare(strict_types = 1);

  // TODO: get all projects
?>

<div class="card">

  <h2>Projects</h2>

  <?php
    $instance = DB::GetInstance();
    $projects = $instance->getProjects();

    foreach ($projects as $p) {
      require('views/projects/project.php');
    }
  ?>

</div>

<!-- ... -->
