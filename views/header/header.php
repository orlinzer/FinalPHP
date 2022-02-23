<header>
  <img
    class="menu-button"
    src="images/menu_black_48dp.svg"
    alt="Menu"
    width="48"
    title="Menu"
  >
  <a class="logo" href="index.php" title="Home">
    <img src="logo.svg" alt="Logo" width="48" />
    <h1>YPO-IDE</h1>
  </a>
  <form action="" method="post" class="search" title="Search">
    <input type="image" value="Search" alt="Search" src="images/search_black_48dp.svg" width="24"/>
    <input type="search" name="search" id="search" placeholder="Search" />
  </form>
  <div class="properties">
    <img
      class="user-menu-button"
      src="<?= isset($user) ? $user->getImage() : 'images/default_user_image.svg' ?>"
      alt="User"
      width="48"
      title="User Menu"
      >
  </div>
</header>
