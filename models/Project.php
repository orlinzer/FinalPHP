<?php
  declare(strict_types = 1);

  class Project {

    protected string $name;
    protected int $views;
    protected int $copies;

    public function setName(string $name) : User {
      $this->$name = $name;
      return $this;
    }

    public function getName() : string {
      return $this->$name;
    }

    public function setViews(int $views): User {
      $this->$views = $views;
      return $this;
    }

    public function getViews(): int {
      return $this->$views;
    }

    public function setCopies(int $copies): User {
      $this->$copies = $copies;
      return $this;
    }

    public function getCopies(): int {
      return $this->$copies;
    }

    public function __toString() : string {
      return "{ name: '$name', views: '$views', copies: '$copies' }";
    }
  }
?>