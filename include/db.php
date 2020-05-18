<?php
// Create database connection
$dbhost = "localhost";
$dbuser = "admin";
$dbpass = "\$P\$Be3VYh3GPDCAhNlWRXwFy5QOJR6X0q/";
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