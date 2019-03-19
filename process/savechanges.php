<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin') {
	$name = $_POST['name'];
	$product = $_POST['product'];
	$total_price = $_POST['total_price'];
	$paid = $_POST['paid'];
	$debt = $_POST['debt'];
	$monthly_payment = $_POST['monthly_payment'];
	$purchase_date = $_POST['purchase_date'];
	$last_payment_date = $_POST['last_payment_date'];
	$id = $_POST['id'];
	$phone = $_POST['phone'];
	//implement difference here to calculate late days
	// $difference = calculate_date_difference($_POST["last_payment_date"];
	// $previousDays = $difference - 31; 
	// if ($previousDays < 0) {
	// 	$previousDays =0;
	// }
	//print_r($_POST);

	include 'db.class.php';
	include 'functions.php';
	$database = new JDB();

	$result = $database->runQuery("UPDATE customers SET name='$name', product='$product', total_price='$total_price', paid='$paid', debt='$debt', monthly_payment='$monthly_payment', purchase_date='$purchase_date', last_payment_date='$last_payment_date', phone='$phone' WHERE serial='$id'");

	if ($result) {
		header("Location: ../details.php?id=$id");
	}else{
		header("Location: ../error.php");
	}

	// var_dump($result);

}

?>