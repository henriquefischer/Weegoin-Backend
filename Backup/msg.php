<?php
  require_once("db_con.inc");

  $email = $_POST['email'];

  $sql = "INSERT INTO `weego`.`email` (
      `email`
    ) VALUES(
    '".$email."'
    ); ";

  $query = $db->query($sql);
  header("Location: ../index.html");
?>