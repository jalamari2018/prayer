<?php

include "db.class.php";


$database = new JDB();


$result = $database->runQuery("SELECT * FROM customers");
if ($result) {
	$result = $database->formatAsAssoc($result);
	sleep(5);
	echo json_encode($result);

}else{
	echo "error getting the data from the server";
}

