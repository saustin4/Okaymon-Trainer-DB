<?php
error_reporting ( E_ALL );

require_once ('utils.php');
include('session.php');

/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/okaymon-edit-form.php
 * DESCRIPTION - an html form for Okaymon database entry with client side validation via form.js
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
<title>Okaymon Info Entry hw-ec2</title>
<link href="form.css" rel="stylesheet" type="text/css" />
</head>
<body>

<br/><br/>
	<!-- client side form validation script -->
	<script type="text/javascript" src="form.js"> </script>
	<fieldset>
		<h1>Okaymon Info entry form</h1>
		<font size="-1">(client-side validation)</font>
	</fieldset>
	<br />
	<br />
	
		<!-- session logout added -->
	
	
	&nbsp; Welcome back <i><?php echo $login_session; ?></i>, click here to&nbsp;
<b id="logout"></b>
<form action="logout.php">
    <input type="submit" value="LOGOUT" />
</form> 
	<br />
	<fieldset class="fieldset-auto-width">
		<div>
			<h3>
				<i>"Gotta catch several of 'em"</i>
			</h3>
			<p>
				&nbsp;Enter info for new Okaymon into our database! <br /> <font
					size="-1"> <em>required fields *</em>
				</font>
			</p>
		</div>
		<br />
		<div>
			<form name="form" action="okaymon-edit-handle.php" method="post"
				onsubmit="return validateAll()" onreset="return clearErrs()">
				Discovering Trainer: <input type="text" id="name" name="name"
					maxlength="100" onchange="return validateName()" />*
				<p id="nameErr"></p>
				Okaymon Species: <input type="text" id="species" name="species"
					maxlength="100" onchange="return validateSpecies()" />*
				<p id="speciesErr"></p>
				Weight: <input type="text" id="pounds" name="pounds" size="5"
					maxlength="5" onchange="return validatePounds()" />*
				<p id="poundsErr"></p>
<?php
echo " Weight-Units: ", dropdown ( "units", array ("kg","lbs" 
) ), "\n";
echo "<br/>", "\n";
echo "Energy Type: ", dropdown ( "energy", array ("clover","candle","puddle","spark","thinkin" 
) ), "\n";
echo "<br/>", "\n";
echo "  Flavor Text: <textarea name=\"flavor\" rows=\"2\" cols=\"30\"></textarea>", "\n";
echo "<br/>", "\n";
echo "   ", radioTable ( array ("clover","candle","puddle","spark","thinkin" 
), array ("weak-to","neutral","resistant" 
) ), "\n";
?>
	<p id="agreeErr"></p>
				<p>
					<input type="checkbox" id="agree" name="agree" /><font size="-2">I
						understand that by submitting this form,<br />I am transferring
						any copyright or intellectual property rights to the forms owner,<br />
						that I have the right to do so,<br />and that my submission is not
						infringing on other peoples rights.
					</font>
				</p>
				<input type="submit" value="submit" /> <input type="reset"
					value="reset" />
			</form>
		</div>
	</fieldset>
	<br />
	<br />

	<fieldset>
		<h2>
			<a href="https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php">Visit
				the Okaymon database summary</a>
		</h2>
	</fieldset>
	<hr />
	<fieldset>
		<font size="-1"> Please address problems to <a
			href="mailto:saustin4@radford.edu"> saustin4@radford.edu</a>
		</font>
	</fieldset>
</body>
</html>