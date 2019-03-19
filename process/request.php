<?php


if (isset($_POST["name"])) {
    $name = $_POST["name"]; 
    $phone = $_POST["phone"];
    $desc = $_POST["desc"];
    include 'db.class.php';
	include 'functions.php';
    $database = new JDB();
    $result = $database->runQuery("INSERT INTO requests (name,information,phone) values ('$name','$desc','$phone')");
    if($result){
       header("Location: ../request.php?rstatus=ok");
    }else {
       header("Location: ../request.php?rstatus=error");
    }
}else {
    header("Location: ../");
}