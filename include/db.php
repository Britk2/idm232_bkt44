<?php
// Create database connection
$dbhost = "localhost";
$dbuser = "btudesig_WPUAG";
$dbpass = "h3a4A248XugO";
$dbname = "btudesig_cookbook";
$port = "3306";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check the connection is good with no errors
if (mysqli_connect_errno()) {
		die ("Database connection failed: " .
				mysqli_connect_error() .
				" (" . mysqli_connect_errno() . ")"
		);
}
?>