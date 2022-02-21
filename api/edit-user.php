
<form action="" method="post">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name"><br>
  <label for="new-name">New Name:</label>
  <input type="text" name="new-name" id="new-name"><br>
  <label for="email">Email:</label>
  <input type="email" name="email" id="email"><br>
  <label for="phone">Phone:</label>
  <input type="text" name="phone" id="phone"><br>
  <label for="password">Password:</label>
  <input type="password" name="password" id="password"><br>
  <label for="role">Role:</label>
  <input type="text" name="role" id="role"><br>
  <input type="submit" value="Get">
</form>

<?php

  $host = "localhost";
  $db = "ypo_ide";
  $charset = "utf8";
  $dns = "mysql:host=$host;dbname=$db;charset=$charset";

  $user = "root";
  $pass = "";

  $opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') { exit; }

  $request = "UPDATE `users`";
  $update = "";

  /**
   * Adding a filter to the request
   */
  function addUpdate ($name, $value) {
    global $update;

    if ($update === "") {
      $update = " SET ";
    } else {
      $update .= ", ";
    }

    $update .= "`$name` = '$value'";
  }

  if (!isset($_POST['name']) || $_POST['name'] === "") { exit; }

  $name = $_POST['name'] === "";

  if (isset($_POST['new-name'])) {
    $newName = $_POST['new-name'];
    if ($newName !== "") {
      addUpdate("name", $newName);
    }
  }

  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if ($email !== "") {
      addUpdate("email", $email);
    }
  }

  if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
    if ($phone !== "") {
      addUpdate("phone", $phone);
    }
  }

  if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password !== "") {
      addUpdate("password", $password);
    }
  }

  if (isset($_POST['role'])) {
    $role = $_POST['role'];
    if ($role !== "") {
      addUpdate("role", $role);
    }
  }

  if ($update === "") { exit; }

  $request .= $update . " WHERE `users`.`name` = '$name';";

  $connection = new PDO($dns, $user, $pass, $opt);

  // echo $request . "<br>"; // DBG

  $result = $connection->exec($request);

  // echo $affectedRows;
  $connection=null;

  // print_r($_POST);
  // $userName = $_POST['name'];

?>