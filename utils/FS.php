<?php
  declare(strict_types = 1);

  require_once "models/User.php";
  require_once "models/Project.php";

  class FS {
    private static $PATH = "users/";
    private static $USER_IMAGE_NAME = "user_image";
    private static $USER_ABOUT_NAME = "user_about.txt";

    private User | null $user;
    private Project | null $project;

    public function __construct(User $user = null, Project $project = null) {
      $this->user = $user;
      $this->project = $project;
    }

    public function getUser() : User {
      return $this->user;
    }

    public function setUser(User $user) {
      $this->user = $user;
    }

    public function getProject() : Project {
      return $this->project;
    }

    public function setProject(Project $project) {
      $this->project = $project;
    }

    // General functions

    private static function rrmdir($dir) {
      if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
          if ($object != "." && $object != "..") {
            if (is_dir($dir. DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object)) {
              rrmdir($dir. DIRECTORY_SEPARATOR . $object);
            } else {
              unlink($dir. DIRECTORY_SEPARATOR . $object);
            }
          }
        }
        rmdir($dir);
      }
    }

    private static function winToUnixPath($path) {
      return str_replace('\\', '/', $path);
    }

    private static function unixToWinPath($path) {
      return str_replace('/', '\\', $path);
    }

    // User

    public function isUserExist() : bool {
      return $this->user != null;
    }

    public function getUserPath() : string | false {
      if (!$this->isUserExist()) { return false; }
      return self::$PATH . $this->user->getName();
    }

    public function getUsersDirs(): array | false {
      try {
        return scandir(self::$PATH);
      } catch (Throwable $th) {
        return false;
      }
    }

    public function isUserDirExist() : bool {
      return (!(self::$PATH = $this->getUserPath())) && is_dir(self::$PATH);
    }

    public function createUserDir() : bool {
      if ((!($path = $this->getUserPath())) || is_dir($path)) { return false; }

      try {
        mkdir($path);
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function getUserDirContent() : array | false {
      try {
        return scandir($this->getUserPath());
      } catch (Throwable $th) {
        return false;
      }
    }

    public function renameUserDir(string $newName) : bool {
      // remove becaus the try / catch will do it
      if ($this->user == null) { return false; }
      if (!is_dir(self::$PATH . $this->user->getName())) { return false; }
      if ($newName == "") { return false; } // TODO: check valid name
      if (is_dir(self::$PATH . $newName)) { return false; }

      try {
        rename(self::$PATH . $this->user->getName(), $newName);
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function removeUserDir() {
      // TODO: check if user exist

      try {
        rrmdir(self::$PATH . $this->user->getName());
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function setUserImage(string $image) : bool {
      if ($this->user === null) { return false; }
      if (!file_exists($image)) { return false; }

      $extension = $_FILES['image']['type'];

      if ($extension !== "image/webp" &&
          $extension !== "image/svg" &&
          $extension !== "image/avif" &&
          $extension !== "image/png" &&
          $extension !== "image/apng" &&
          $extension !== "image/gif" &&
          $extension !== "image/jpg" &&
          $extension !== "image/jpeg" &&
          $extension !== "image/jfif" &&
          $extension !== "image/pjpeg" &&
          $extension !== "image/pjp") { return false; }

      $extension = str_replace('image/', '', $extension);

      $this->createUserDir();

      move_uploaded_file($image, $this->getUserPath() . "/" . self::$USER_IMAGE_NAME . "." . $extension);

      return true;
    }

    public function getUserImage() : string {
      // Return the default user image
      if (!($path = $this->getUserPath())) { return '/FinalPHP/images/default_user_image.svg'; }

      // Return the user image file if exist
      $imagePath = $path . "/" . self::$USER_IMAGE_NAME . ".";

      if (is_file($imagePath . "webp")) { return  $imagePath . "webp"; }
      if (is_file($imagePath . "svg")) { return   $imagePath . "svg"; }
      if (is_file($imagePath . "avif")) { return  $imagePath . "avif"; }
      if (is_file($imagePath . "png")) { return   $imagePath . "png"; }
      if (is_file($imagePath . "apng")) { return  $imagePath . "apng"; }
      if (is_file($imagePath . "gif")) { return   $imagePath . "gif"; }
      if (is_file($imagePath . "jpg")) { return   $imagePath . "jpg"; }
      if (is_file($imagePath . "jpeg")) { return  $imagePath . "jpeg"; }
      if (is_file($imagePath . "jfif")) { return  $imagePath . "jfif"; }
      if (is_file($imagePath . "pjpeg")) { return $imagePath . "pjpeg"; }
      if (is_file($imagePath . "pjp")) { return   $imagePath . "pjp"; }

      // Return the default user image
      return '/FinalPHP/images/default_user_image.svg';
    }

    public function removeUserImage() : bool {
      if ($this->name == null) { return false; }

      $image = self::$PATH . $this->name . "/" . self::$USER_IMAGE_NAME . ".";

      try {
        if (is_file($image . "webp")) { unlink($image . "webp"); }
        else if (is_file($image . "svg")) { unlink($image . "svg"); }
        else if (is_file($image . "avif")) { unlink($image . "avif"); }
        else if (is_file($image . "png")) { unlink($image . "png"); }
        else if (is_file($image . "apng")) { unlink($image . "apng"); }
        else if (is_file($image . "gif")) { unlink($image . "gif"); }
        else if (is_file($image . "jpg")) { unlink($image . "jpg"); }
        else if (is_file($image . "jpeg")) { unlink($image . "jpeg"); }
        else if (is_file($image . "jfif")) { unlink($image . "jfif"); }
        else if (is_file($image . "pjpeg")) { unlink($image . "pjpeg"); }
        else if (is_file($image . "pjp")) { unlink($image . "pjp"); }
        else { return false; }
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function setUserAbout(string $about) : bool {
      if (!($path = $this->getUserPath())) { return false; }

      $aboutFile = $path . "/" . self::$USER_ABOUT_NAME;

      $result = true;
      try {
        $fd = fopen($aboutFile, 'w');
        fwrite($aboutFile, $about);
        // echo 'bla';
      } catch (Throwable $th) {
        $result = false;
        //throw $th;
      } finally {
        fclose($fd);
      }

      return $result;
    }

    public function getUserAbout() : string {
      // Return the default user about
      if (!($path = $this->getUserPath())) { return ''; }

      $aboutFile = $path . "/" . self::$USER_ABOUT_NAME;

      if (!is_file($aboutFile)) { return ''; }

      $fd = fopen($aboutFile, 'r');
      try {
        $about = '';
        while ($line = fgets($fd)) {
          $about .= $line;
        }
        if (!feof($fd)) { return ''; }
        return $about;
      } catch (Throwable $th) {
        //throw $th;
      } finally {
        fclose($fd);
      }

      // Return the default user image
      return '';
    }

    public function removeUserAbout() : bool {
      if ($this->name == null) { return false; }

      $aboutFile = self::$PATH . $this->user->getName() . "/" . self::$USER_ABOUT_NAME;

      if (!is_file($aboutFile)) {
        return '';
      }

      try {
        unlink($aboutFile);
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    // Project

    public function isProjectExist() : bool {
      return $this->isUserExist() && $this->project != null;
    }

    public function getProjectPath() : string | false {
      if (!$this->isProjectExist()) { return false; }
      return $this->getUserPath() . '/' . $this->project->getName();
    }

    public function getProjectsDirs() : array | false {
      if (!$this->isUserExist()) { return false; }

      try {
        return scandir($this->getUserPath());
      } catch (Throwable $th) {
        return false;
      }
    }

    public function isProjectDirExist() : bool {
      return (!(self::$PATH = $this->getProjectPath())) && is_dir(self::$PATH);
    }

    public function createProjectDir() : bool {
      if ((!(self::$PATH = $this->getProjectPath())) || is_dir(self::$PATH)) { return false; }

      try {
        mkdir(self::$PATH);
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function getProjectDirContent() : array | false {
      try {
        return scandir($this->getProjectPath());
      } catch (Throwable $th) {
        return false;
      }
    }

    public function renameProjectDir(string $newName) : bool {
      // remove becaus the try / catch will do it
      if ($this->user == null) { return false; }
      if (!is_dir(self::$PATH . $this->user->getName())) { return false; }
      if ($newName == "") { return false; } // TODO: check valid name
      if (is_dir(self::$PATH . $newName)) { return false; }

      try {
        rename(self::$PATH . $this->user->getName(), $newName);
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function removeProjectDir() {
      // TODO: check if user exist

      try {
        rrmdir(self::$PATH . $this->user->getName());
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function setProjectImage(string $image) : bool {
      if ($this->user === null) { return false; }

      // $extension = pathinfo($image)["extension"];
      $extension = pathinfo($image, PATHINFO_EXTENSION)["extension"];

      if (!file_exists($image)) { return false; }

      if ($extension !== "webp" &&
          $extension !== "svg" &&
          $extension !== "avif" &&
          $extension !== "png" &&
          $extension !== "apng" &&
          $extension !== "gif" &&
          $extension !== "jpg" &&
          $extension !== "jpeg" &&
          $extension !== "jfif" &&
          $extension !== "pjpeg" &&
          $extension !== "pjp") { return false; }

      move_uploaded_file($image, self::$PATH . $this->name . "/" . self::$USER_IMAGE_NAME . "." . $extension);

      return true;
    }

    public function getProjectImage() : string {
      // Return the default user image
      if ($this->user == null) { return '/FinalPHP/images/design_services_black_48dp.svg'; }

      // Return the user image file if exist
      $imagePath = self::$PATH . $this->user->getName() . "/" . self::$USER_IMAGE_NAME . ".";

      if (is_file($imagePath . "webp")) { return  $imagePath . "webp"; }
      if (is_file($imagePath . "svg")) { return   $imagePath . "svg"; }
      if (is_file($imagePath . "avif")) { return  $imagePath . "avif"; }
      if (is_file($imagePath . "png")) { return   $imagePath . "png"; }
      if (is_file($imagePath . "apng")) { return  $imagePath . "apng"; }
      if (is_file($imagePath . "gif")) { return   $imagePath . "gif"; }
      if (is_file($imagePath . "jpg")) { return   $imagePath . "jpg"; }
      if (is_file($imagePath . "jpeg")) { return  $imagePath . "jpeg"; }
      if (is_file($imagePath . "jfif")) { return  $imagePath . "jfif"; }
      if (is_file($imagePath . "pjpeg")) { return $imagePath . "pjpeg"; }
      if (is_file($imagePath . "pjp")) { return   $imagePath . "pjp"; }

      // Return the default user image
      return '/FinalPHP/images/design_services_black_48dp.svg';
    }

    public function removeProjectImage() : bool {
      if ($this->name == null) { return false; }

      $image = self::$PATH . $this->name . "/" . self::$USER_IMAGE_NAME . ".";

      try {
        if (is_file($image . "webp")) { unlink($image . "webp"); }
        else if (is_file($image . "svg")) { unlink($image . "svg"); }
        else if (is_file($image . "avif")) { unlink($image . "avif"); }
        else if (is_file($image . "png")) { unlink($image . "png"); }
        else if (is_file($image . "apng")) { unlink($image . "apng"); }
        else if (is_file($image . "gif")) { unlink($image . "gif"); }
        else if (is_file($image . "jpg")) { unlink($image . "jpg"); }
        else if (is_file($image . "jpeg")) { unlink($image . "jpeg"); }
        else if (is_file($image . "jfif")) { unlink($image . "jfif"); }
        else if (is_file($image . "pjpeg")) { unlink($image . "pjpeg"); }
        else if (is_file($image . "pjp")) { unlink($image . "pjp"); }
        else { return false; }
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }

    public function setProjectAbout(string $about) : bool {
      if ($this->user === null) { return false; }

      $aboutFile = self::$PATH . $this->user->getName() . "/" . self::$USER_ABOUT_NAME;
      $fd = fopen($aboutFile, 'w');

      try {
        fwrite($aboutFile, $about);
      } catch (Throwable $th) {
        //throw $th;
      } finally {
        fclose($fd);
      }

      return true;
    }

    public function getProjectAbout() : string {
      // Return the default user image
      if ($this->user == null) { return ''; }

      $aboutFile = self::$PATH . $this->user->getName() . "/" . self::$USER_ABOUT_NAME;

      if (!is_file($aboutFile)) {
        return '';
      }

      $fd = fopen($aboutFile, 'r');
      try {
        $about = '';
        while (!($line = fgets($fd))) {
          $about .= $line;
        }
        if (!feof($fd)) { return ''; }
        return $about;
      } catch (Throwable $th) {
        //throw $th;
      } finally {
        fclose($fd);
      }

      // Return the default user image
      return '';
    }

    public function removeProjectAbout() : bool {
      if ($this->name == null) { return false; }

      $aboutFile = self::$PATH . $this->user->getName() . "/" . self::$USER_ABOUT_NAME;

      if (!is_file($aboutFile)) {
        return '';
      }

      try {
        unlink($aboutFile);
      } catch (Throwable $th) {
        return false;
      }

      return true;
    }
  }
?>
