<?php
require_once ('dbUserPass.php');

session_start (); // Starting Session


//Assign the current timestamp as the user's
//latest activity
$_SESSION['last_action'] = time();


$error = ''; // Variable for error msg
if (isset ( $_POST ['submit'] )) {
	if (empty ( $_POST ['username'] ) || empty ( $_POST ['password'] )) {
		$error = "Username or Password is required";
	} else {
		$username = $_POST ['username'];
		$password = $_POST ['password'];
		// connection to server
		$connection = mysql_connect ( "localhost", "$user", "$pass" );
		// SQL injection protection
		$username = stripslashes ( $username );
		$password = stripslashes ( $password );
		$username = mysql_real_escape_string ( $username );
		$password = mysql_real_escape_string ( $password );
		// Selecting Database
		$db = mysql_select_db ( "$user", $connection );
		// query to retrieve information of registered user
		$query = mysql_query ( 
				"select * from login where password='$password' AND username='$username'", 
				$connection );
		$rows = mysql_num_rows ( $query );
		if ($rows == 1) {
			$_SESSION ['login_user'] = $username; // Initializing Session
			header ( "location: okaymon-edit-form.php" );
		} else {
			$error = "Username or Password is invalid";
		}
		mysql_close ( $connection ); // Closing Connection
	}
}
?>
