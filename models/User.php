<?php
  declare(strict_types = 1);

  class User {

    protected string $name;
    protected string $email;
    protected string $phone;
    protected string $role;

    protected array $students; // TODO: use Set instead
    protected array $teachers; // TODO: use Set instead
    protected array $projects;

    // public function __construct(string $name = "", string $email = "", string $phone = "", string $role = "USER") {
    public function __construct() {
      $this->role = "USER";
      $this->students = array();
      $this->teachers = array();
      $this->projects = array();
    }

    public function setName(string $name) : User {
      $this->name = $name;
      return $this;
    }

    public function getName() : string {
      return $this->name;
    }

    public function setEmail(string $email) : User {
      $this->email = $email;
      return $this;
    }

    public function getEmail() : string {
      return $this->email;
    }

    public function setPhone(string $phone) : User {
      $this->phone = $phone;
      return $this;
    }

    public function getPhone() : string {
      return $this->phone;
    }

    public function setRole(string $role) : User {
      $this->role = $role;
      return $this;
    }

    public function getRole() : string {
      return $this->role;
    }

    public function setStudents(array $students) {
      $this->students = $students;
    }

    public function getStudents() : array {
      return $this->students;
    }

    public function addStudent(string $user) {
      $this->students[$user] = $user;
    }

    public function removeStudent(string $user) {
      unset($this->students[$user]);
    }

    public function setTeachers(array $teachers) {
      $this->teachers = $teachers;
    }

    public function getTeachers() : array {
      return $this->teachers;
    }

    public function setProjects(array $projects) {
      $this->projects = $projects;
    }

    public function getProjects() : array {
      return $this->projects;
    }

    public function __toString() : string {
      return "{ name: '" . $this->getName() . "', image: '" . $this->getImage() . "', email: '" . $this->getEmail() . "', phone: '" . $this->getPhone() . "'}";
    }

    public function setImage(string $fileName) {
      // TODO: make it multi extension file
      if (file_exists($fileName)) {
        move_uploaded_file($fileName, "/users/$this->name/profileImage.svg");
      }
    }

    public function getImage() : string {
      // TODO: make it multi extension file
      // Return the user image file if exist
      $path = "/users/$this->name/user_image.";
      if (is_file(".." . $path . "webp")) { return  "/FinalPHP" . $path . "webp"; }
      if (is_file(".." . $path . "svg")) { return   "/FinalPHP" . $path . "svg"; }
      if (is_file(".." . $path . "avif")) { return  "/FinalPHP" . $path . "avif"; }
      if (is_file(".." . $path . "png")) { return   "/FinalPHP" . $path . "png"; }
      if (is_file(".." . $path . "apng")) { return  "/FinalPHP" . $path . "apng"; }
      if (is_file(".." . $path . "gif")) { return   "/FinalPHP" . $path . "gif"; }
      if (is_file(".." . $path . "jpg")) { return   "/FinalPHP" . $path . "jpg"; }
      if (is_file(".." . $path . "jpeg")) { return  "/FinalPHP" . $path . "jpeg"; }
      if (is_file(".." . $path . "jfif")) { return  "/FinalPHP" . $path . "jfif"; }
      if (is_file(".." . $path . "pjpeg")) { return "/FinalPHP" . $path . "pjpeg"; }
      if (is_file(".." . $path . "pjp")) { return   "/FinalPHP" . $path . "pjp"; }

      // Return the default user image
      return "/FinalPHP/images/default_user_image.svg";
    }

    public function setAbout(string $about) {
      try {
        $fd = fopen("/users/$this->name/profileAbout.txt", "w");
        if ($fd) {
          fputs($fd, $about);
        }
      } catch (Exception $e) {
        // TODO: handle
      } finally {
        fclose($fd);
      }

    }

    public function getAbout() : string {
      $result = "";

      // Return the user about file if exist
      if (is_file("/users/$this->name/profileAbout.txt")) {
        try {
          $fd = fopen("/users/$this->name/profileAbout.txt", "r");
          if ($fd) {
            while (!feof($fd)) {
              $result += fgets($fd, 1024);
            }
          }
        } catch (Exception $e) {
          // TODO: handle
        } finally {
          fclose($fd);
        }
      }

      return $result;
    }

    public static function UsersToJSON(array $users) {
      $result = "[";

      foreach ($users as $user) {
        $result .= $user->__toString() . ",";
      }

      return $result . "]";
    }
  }
?>