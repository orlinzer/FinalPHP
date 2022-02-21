<?php
  declare(strict_types = 1);

  require_once "../models/User.php";
  require_once "../models/Project.php";

  class DB {
    private static $host;
    private static $db;
    private static $charset;

    private static $user;
    private static $pass;

    private static $opt = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    private static $connection;
    private static $obj;

    private function __construct(
      string $host = "localhost",
      string $db = "ypo_ide",
      string $charset = "utf8",
      string $user = "root",
      string $pass = "") {

      self::$host = $host;
      self::$db = $db;
      self::$charset = $charset;
      self::$user = $user;
      self::$pass = $pass;
    }

    public static function GetInstance(): DB {
      if (self::$obj == null) {
        self::$obj = new DB();
      }
      return self::$obj;
    }

    private function connect() {
      // TODO: try catch
      $dns = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset;
      self::$connection = new PDO($dns, self::$user, self::$pass, self::$opt);
    }

    public function disconnect() {
      self::$connection = null;
    }

    public function addUser(User $user, string $password) {
      self::connect();
      $statement = self::$connection->prepare("INSERT INTO `users` (`name`, `email`, `phone`, `password`, `role`) VALUES (:name, :email, :phone, :password, :role)");
      $statement->execute([
        ':name' => $user->getName(),
        ':email' => $user->getEmail(),
        ':phone' => $user->getPhone(),
        ':role' => $user->getRole(),
        ':password' => $password
      ]);
      self::disconnect();
    }

    public function getUsers() : array {
      self::connect();
      $usersArray = array();
      $result = self::$connection->query("SELECT * FROM `users`");

      while($row = $result->fetchObject('User')) {
        $usersArray[] = $row;
      }

      self::disconnect();
      return $usersArray;
    }

    public function getUser(string $name) : User {
      self::connect();

      $statement = self::$connection->prepare("SELECT `name`,`email`,`phone`,`role` FROM `users` WHERE `name` = :name");
      $statement->execute([ ':name' => $name ]);
      $result = $statement->fetchObject("User"); // TODO

      self::disconnect();
      return $result;
    }

    public function getUserPassword(string $name) : string {
      self::connect();

      $statement = self::$connection->prepare("SELECT `password` FROM `users` WHERE `name` = :name");
      $statement->execute([ ':name' => $name ]);
      $result = $statement->fetch();

      self::disconnect();
      if (is_array($result)) {
        return $result["password"];
      } else {
        return "ERROR";
      }
    }

    public function isUserExist(string $name) : bool {
      self::connect();

      $statement = self::$connection->prepare("SELECT `name` FROM `users` WHERE `name` = :name");
      $statement->execute([ ':name' => $name ]);
      $result = $statement->fetch();

      self::disconnect();
      // echo isset($result);
      // echo is_array($result);
      // echo count($result);
      // print_r($result);
      // echo ($result != null);
      return $result != null;
    }

    public function deleteUser (string $name) : bool {
      self::connect();

      $result = false;
      try {
        $statement = self::$connection->prepare("DELETE FROM `users` WHERE `users`.`name` = :name");
        $statement->execute([ ':name' => $name ]);
        $statement->fetch();
        $result = true;
      } catch (Throwable $th) {
        echo $th . "<br>";
        //throw $th;
      } finally {
        self::disconnect();
        return $result;
      }
    }

    public function updateUserPhone(string $name, string $newPhone) {
      self::connect();

      try {
        $statement = self::$connection->prepare("UPDATE `users` SET `phone` = :newPhone WHERE `users`.`name` = :name");
        $statement->execute([ ':newPhone' => $newPhone,
                              ':name' => $name ]);
        $statement->fetch();
      } catch (Throwable $th) {
        echo $th . "<br>";
        //throw $th;
      } finally {
        self::disconnect();
      }
    }

    public function updateUserEmail(string $name, string $newEmail) {
      self::connect();

      try {
        $statement = self::$connection->prepare("UPDATE `users` SET `email` = :newEmail WHERE `users`.`name` = :name");
        $statement->execute([ ':newEmail' => $newEmail,
                              ':name' => $name ]);
        $statement->fetch();
      } catch (Throwable $th) {
        echo $th . "<br>";
        //throw $th;
      } finally {
        self::disconnect();
      }
    }

    public function updateUserPassword(string $name, string $newPassword) {
      self::connect();

      try {
        $statement = self::$connection->prepare("UPDATE `users` SET `password` = :newPassword WHERE `users`.`name` = :name");
        $statement->execute([ ':newPassword' => $newPassword,
                              ':name' => $name ]);
        $statement->fetch();
      } catch (Throwable $th) {
        echo $th . "<br>";
        //throw $th;
      } finally {
        self::disconnect();
      }
    }

    public function calculateProjectsFromEveryUser() {
      self::connect();
      $projectArr = array();
      $result = self::$connection->query("SELECT COUNT(*) as `P` FROM `project`");
      $projectCount = $result->fetch(PDO::FETCH_ASSOC);

      for ($i = 0; $i < $projectCount['P']; $i++)
      {
        $statement = self::$connection->prepare("SELECT COUNT(`users`.`name`) as `count`, `projects`.`user`
        FROM `projects`, `users` WHERE `projects`.`name`=:name and `projects`.`user` = `users`.`user` GROUP BY `projects`.`user`");
        $statement->execute([ ':name' => $i ]);
        $projectsArr[] = $statement->fetch(PDO::FETCH_ASSOC);
      }

      self::disconnect();
      return $projectsArr;
    }
  }
?>