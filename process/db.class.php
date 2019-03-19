<?php

/**
* Opens connection to the database and excutes commands and return results to the caller
* By Jebreel
*/
class JDB extends mysqli
{
	private $classDesc = "This is database class that extends mysqli---- OK<br>";	
	private $server = "localhost";
	private $database ="etejar";
	private $user ="root";
	private $password = "125600bczz";
	private $conn;
	private $query1;

	function __construct(){
		$this->makeConnection();
		$this->set_charset("utf8");
	}

	//__toString class must return a String 
	function __toString(){
		return $this->classDesc;
	}
	public function setData($param,$client_midnight_timestamp,$event_type){



	}
	public function getData($param){

	}



	private function makeConnection(){
		//used $this instead of mysqli
		$this->conn = $this->connect($this->server,$this->user,$this->password,$this->database);
		if(mysqli_connect_error()){
			die('Connect Error (' . mysqli_connect_errno() . ') '
			. mysqli_connect_error());
		}else{
			// $this->showMessage("database connection ----OK","makeConnection");	
		}
	}
	private function endConnection(){
			mysqli_close($this->conn);
	}
	public function runQuery($query_string){
		//we run query string and return the result.

		//Note: we do not need to pass the connection because its already a property of mysqli that is already inhereted by JDB
		return  $this->query($query_string);
	}
	public function formatAsAssoc(&$trans){
		//format data as an associative array 
		$clean = array();
		while ($row = $trans->fetch_assoc()) {
			array_push($clean, $row);
		}
		return $clean;
	}
	//to check whether somthing excuted succssfully.
	private function isOK($somthing){
		if ($somthing) {
			return true;
		}
		return false;
	}
	private function showMessage($message,$caller){
		echo "<br>".$message." from function[".$caller."]"."<br>";
	}

	function __destruct(){
		//in case we forgot to close connection we close it here
		if($this->conn){
			mysqli_close($this->conn);
		}



	}
}




?>