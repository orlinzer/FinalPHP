<?php
  declare(strict_types = 1);

  require_once("../utils/DB.php");
  require_once("../models/User.php");

  $instance = DB::GetInstance();

  // print_r($instance->getUsers());
  echo User::UsersToJSON($instance->getUsers());
  // echo json_encode($instance->getUsers());
?>