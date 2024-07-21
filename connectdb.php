<?php
	function openConnection(){
		$host="localhost";
		$user="root";
		$pw="";
		$db="supplychain";

		$conn = new mysqli($host, $user, $pw, $db,) or die("Connect failed: %s\n". $conn -> error);
		return $conn; 
	}

	function closeConnection($conn){
		$conn -> close();
	}
?>
