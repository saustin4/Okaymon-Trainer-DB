<?php
error_reporting ( E_ALL );
require_once ('dbUserPass.php');

require_once ('utils.php');
include('session.php');

/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/okaymon-edit-form2.php
 * DESCRIPTION - an html form for Okaymon database update form with 
 *							  client side validation and populated info
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
<title>Update Okaymon hw-ec2</title>
<link href="form.css" rel="stylesheet" type="text/css" />
</head>
<body>

<br/><br/>
	<!-- client side form validation script -->
	<script type="text/javascript" src="form.js"> </script>
	<fieldset>
		<h1>Okaymon Info Update</h1>
		<font size="-1">(client-side validation)</font>
	</fieldset>
	<br/>
<?php	// connecting to db with meassage for confirmation
if ($dbc = @mysqli_connect ( 'localhost', user, pass, user )) {
	print '<font size="-2">connection successful.</font>';
} else {
	print 
			'<font size="-2" style="color:red;">connection unsuccessful:<br />' . mysqli_error ( 
					$dbc ) . '.</font>';
}
?>
	<br />
	<br />
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
				&nbsp;Update info for your Okaymon in our database!<br /> <font
					size="-1"> <em>required fields *</em>
				</font>
			</p>
		</div>
		<?php

// retrieving the chosen row from db summary page
$idd = $_GET ['species'];

// database query for said row
$allmon = mysqli_query ( $dbc, "SELECT * FROM okaymon WHERE species = '" . $idd . "'" );
while ( $onemon = mysqli_fetch_array ( $allmon ) ) {
	echo "    <!--output data of selected onemon from db summary--> ", "\n";
	
$n=htmlspecialchars ( $onemon ["name"] );
$s=htmlspecialchars ( $onemon ["species"] );
$p=htmlspecialchars ( $onemon ["pounds"] );
$f=htmlspecialchars ( $onemon ["flavor"] );
$u=htmlspecialchars ( $onemon ["units"] );
$e=htmlspecialchars ( $onemon ["energy"] );

	echo "    <form name=\"form\" action=\"okaymon-edit-handle.php\" method=\"post\"
				onsubmit=\"return validateAll()\" onreset=\"return clearErrs()\">
				Trainer Name: <input type=\"text\" id=\"name\" name=\"name\"
					maxlength=\"100\" onchange=\"return validateName()\" value=\"$n\" />* 
									<p id=\"nameErr\"></p>
Species Name: <input type=\"text\" id=\"species\" name=\"species\"
					maxlength=\"100\" onchange=\"return validateSpecies()\" value=\"$s\" />*
				<p id=\"speciesErr\"></p>
Wieght: <input type=\"text\" id=\"pounds\" name=\"pounds\" size=\"5\"
					maxlength=\"5\" onchange=\"return validatePounds()\" value=\"$p\" />*
									<p id=\"poundsErr\"></p>
Weight-Units:". dropdown ( "units", array ("$u", "kg","lbs" 
) )."<br/>Energy Type:". dropdown ( "energy", array ("$e", "clover","candle","puddle","spark","thinkin" 
) )."
<br/>
<br/>
Flavor Text: <textarea name=\"flavor\" rows=\"4\" cols=\"30\"  >$f</textarea><br/>", "\n";
"\n";

echo "   ", radioTable ( array ("clover","candle","puddle","spark","thinkin" 
), array ("weak-to","neutral","resistant" 
) ), "\n";


	echo "<br/><br/>", "\n";

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
	<?php		} ?>
			</fieldset>
	<br />
	<br />
<?php

echo "  <br/>", "\n";
echo "  <br/>", "\n";

echo "  <fieldset>", "\n";


echo "   <h2><a href=\"https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php\" >
		     Back to the database</a></h2>", "\n";
echo "    <font size=\"-1\">of all Okaymon!</font>", "\n";
echo "  </fieldset>", "\n";
echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";

mysqli_close ( $dbc ); // closing db connection

?>
	<hr />
	<fieldset>
		<font size="-1"> Please address problems to <a
			href="mailto:saustin4@radford.edu"> saustin4@radford.edu</a>
		</font>
	</fieldset>
</body>
</html>