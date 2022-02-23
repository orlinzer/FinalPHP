<?php
  declare(strict_types = 1);

  require_once "models/User.php";

  class Project {

    protected string $name;
    protected int $views;
    protected int $copies;

    public function __construct() {
      $this->name = "";
      $this->views = 0;
      $this->copies = 0;
    }

    public function setName(string $name) : Project {
      $this->name = $name;
      return $this;
    }

    public function getName() : string {
      return $this->name;
    }

    public function setViews(int $views): Project {
      $this->views = $views;
      return $this;
    }

    public function getViews(): int {
      return $this->views;
    }

    public function setCopies(int $copies): Project {
      $this->copies = $copies;
      return $this;
    }

    public function getCopies(): int {
      return $this->copies;
    }

    public function __toString() : string {
      return "{ name: '$this->name', views: '$this->views', copies: '$this->copies' }";
    }

    public function setImage(User $user, string $fileName) : bool {
      $fs = new FS($user, $this);
      return $fs->setProjectImage($fileName);
    }

    public function getImage(User $user) : string {
      $fs = new FS($user, $this);
      return $fs->getProjectImage();
    }

  }
?>
