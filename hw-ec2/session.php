<?php
require_once ('dbUserPass.php');

// connecting to db
$connection = mysql_connect ( "localhost", "$user", "$pass" );

// selecting db
$db = mysql_select_db ( "$user", $connection );
session_start (); // Starting Session

// set time-out period (in seconds)
$inactive = 60;

// check to see if $_SESSION["timeout"] is set
if (isset($_SESSION["timeout"])) {
    
    // calculate time remaining
    $sessionTR = time() - $_SESSION["timeout"];
    if ($sessionTR > $inactive) {
        session_destroy();
        header("Location: logout.php");
    }
}

$_SESSION["timeout"] = time();
 


// Storing Session
$user_check = $_SESSION ['login_user'];

// query to retrieve user info
$ses_sql = mysql_query ( "select username from login where username='$user_check'", $connection );
$row = mysql_fetch_assoc ( $ses_sql );
$login_session = $row ['username'];
if (! isset ( $login_session )) {
	mysql_close ( $connection ); // closing db connection
	
	header ( 'Location: index.php' ); // redirection to Home 
}


?> 