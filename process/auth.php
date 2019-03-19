<?php

session_start();

include 'db.class.php';

$database = new JDB;

if (isset($_POST['username']) && isset($_POST["password"])) {
  $password = $_POST['password'];
  $username = $_POST['username'];

  $result= $database->runQuery("SELECT * FROM admins WHERE password=$password");

  if ($result) {
    if ($result->num_rows> 0) {
        $_SESSION['admin'] = 'admin';
        header("Location: ../admin.php");
    }else{
        header("Location: ../error.php");
    }
  }else{
   header("Location: ../admin.php?msg=error");
  }
  
}else{
  header("Location: ../admin.php");
}