<?php
  declare(strict_types = 1);

  require_once('utils/FS.php');

  class User {

    protected string $name;
    protected string $email;
    protected string $phone;
    protected string $role;

    // protected array $students; // TODO: use Set instead
    // protected array $teachers; // TODO: use Set instead
    // protected array $projects;

    // public function __construct(string $name = "", string $email = "", string $phone = "", string $role = "USER") {
    public function __construct() {}

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

    // public function getTeachers() : array {
    //   getTeachers
    //   // TODO
    //   return $this->teachers;
    // }

    public function setProjects(array $projects) {
      $this->projects = $projects;
    }

    public function getProjects() : array {
      return $this->projects;
    }

    public function __toString() : string {
      return "{ name: '" . $this->getName() . "', image: '" . $this->getImage() . "', email: '" . $this->getEmail() . "', phone: '" . $this->getPhone() . "'}";
    }

    public function isEqual(User $other) : bool {
      return $this->name == $other->name;
    }

    public function setImage(string $fileName) : bool {
      $fs = new FS($this);
      return $fs->setUserImage($fileName);
    }

    public function getImage() : string {
      $fs = new FS($this);
      return $fs->getUserImage();
    }

    public function setAbout(string $about) {
      $this->about = $about;
    }

    public function getAbout() : string {
      $fs = new FS($this);
      return $fs->getUserAbout();
    }

    public function setAboutFile(string $about) {
      $fs = new FS($this);
      if ($fs->setUserAbout($about)) {
        $this->setAbout($fs->getUserAbout());
      }
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