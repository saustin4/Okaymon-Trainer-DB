<?php
require_once ('dbUserPass.php');


/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/register.php
 * DESCRIPTION - an html trainer user/pass registration form
 * SOURCES & CREDITS - Dr. Barland, w3schools.com, php.net, stackoverflow.com
 * PHP for The Web by Larry Ullman
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=620" />
<title>Registration hw-ec2</title>
<link href="form.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="main" class="fieldset-auto-width">
		<fieldset>
			<h1>Trainer Registration</h1>
		</fieldset>
		<br />
<?php
// connecting to db
if ($dbc = @mysqli_connect ( 'localhost', user, pass, user )) {
	print '<font size="-2">connection successful.</font>';
} else {
	print 
			'<font size="-2" style="color:red;">connection unsuccessful:<br />' .
					 mysqli_error ( $dbc ) . '.</font>';
}
?><br /> <br />
		<fieldset>
			<div id="login">
				<form method="post" action="register.php">
					<label>UserName :</label> <input type="text" id="username"
						name="u" /> <label>Password :</label> <input
						type="password" id="password" name="p" /> <br /> <input
						type="submit" value="Register" />
					<div class="fieldset-auto-width"><?php echo $error; ?></div>
				</form>
			</div>
		</fieldset><br/>
		<?php

// Define $username and $password
$username = $_POST ['u'];
$password = $_POST ['p'];

$inCommand = htmlspecialchars ( 
		"INSERT INTO login(username,password)
   VALUES('$username','$password')" );

echo"<br/>";
if ($insert = mysqli_query ( $dbc, $inCommand )) {
	print '<font size="-1">submission successful.</font>';
} else {
	print '<font size="-1">submission UNsuccessful:<br/>' . mysqli_error ( $dbc ) . '</font>';
}

mysqli_close ( $dbc ); // closing db connection
?>	
	</div>
	<br /><br />
	<br /><br />
	<br /><br />
	<br /><br />

	<fieldset>
		<h2>
			&nbsp;<a
				href="https://php.radford.edu/~saustin4/itec325/hw-ec2/index.php">
				Back to login page</a>&nbsp;
		</h2>
	</fieldset>
	<br />
	<br />

	<fieldset>
		<h2>
			<a
				href="https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php">Visit
				the Okaymon database summary</a>
		</h2>
	</fieldset>

	<br /><br />
	<br /><br />


<hr />
	<fieldset>
		<font size="-1"> Please address problems to <a
			href="mailto:saustin4@radford.edu"> saustin4@radford.edu</a>
		</font>
	</fieldset>
</body>
</html>