<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: okaymon-edit-form.php");
}

/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/index.php
 * DESCRIPTION - an html login form for Okaymon trainer database with sessions
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
<title>Trainer Login hw-ec2</title>
<link href="form.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main" class="fieldset-auto-width">
<fieldset><h1>Trainer Login </h1></fieldset>
<br/><br/><div id="login" ><fieldset>
hint: oakie/oakie<br/><form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" type="text"/>
<label>Password :</label>
<input id="password" name="password"  type="password"/>
<br/>
<button name="submit" type="submit" value=" Login ">Login</button>&nbsp;or&nbsp;
<a href="register.php">

<!-- user can register to a full fledged database that tracks users 
		instead of using provided name and pass-->

<button name="register" type="button" value=" Register" >Register</button>
</a><br/>
<div class="fieldset-auto-width"><?php echo $error; ?></div>
</form></fieldset>
</div>
</div>

<br /><br />
<br /><br />
<br /><br />
<br /><br />

	<fieldset>
		<h2>
			<a href="https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php">Visit
				the Okaymon database summary</a>
		</h2>
	</fieldset>
	
<br /><br />
<br /><br />
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