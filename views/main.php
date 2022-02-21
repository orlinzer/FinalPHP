<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="logo.svg" type="image/svg+txt" />
    <title>YPO-IDE</title>

    <link rel="stylesheet" href="styles/normalize.css" />
    <link rel="stylesheet" href="styles/common.css" />
    <link rel="stylesheet" href="views/header/header.css" />
    <link rel="stylesheet" href="views/menu/menu.css" />
    <link rel="stylesheet" href="views/user-menu/user-menu.css" />

    <script src="views/header/header.js" defer></script>

  </head>
  <body>
    <?php
      require_once("header/header.php");
      ?>
    <?php
      require_once("menu/menu.php");
    ?>
    <?php
      require_once("user-menu/user-menu.php");
    ?>
    <main>
      <?php
        require_once('about.html');
      ?>
    </main>
    <footer>Created by Or Linzer, Hilal Sharkawi and Itamar Kalimi</footer>
  </body>
</html>
