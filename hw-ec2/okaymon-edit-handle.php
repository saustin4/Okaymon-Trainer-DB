<?php
error_reporting ( E_ALL );
require_once ('dbUserPass.php');

/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/okaymon-edit-handle.php
 * DESCRIPTION - an html form handler with SS validation for "Okaymon" database entry
 * SOURCES & CREDITS - Dr. Barland, w3schools.com, php.net, stackoverflow.com,
 * PHP for The Web by Larry Ullman
 */

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"", "\n";
echo "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">", "\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">", "\n";
echo "  <head>", "\n";
echo "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>", "\n";
echo "   <title>Okaymon Info hw-ec2</title>", "\n";
echo "   <link href=\"form.css\" rel=\"stylesheet\" type=\"text/css\" />", "\n";
echo "  </head>", "\n";
echo " <body>", "\n";
echo "  <fieldset>", "\n";
echo "   <h1>Okaymon Info Handler</h1>", "\n";
echo "    <font size=\"-1\">(server-side validation)</font>", "\n";
echo "  </fieldset>", "\n";
echo "<br/>", "\n";

// connecting to db
if ($dbc = @mysqli_connect ( 'localhost', user, pass, user )) {
	print '<font size="-2">connection successful.</font>';
} else {
	print 
			'<font size="-2" style="color:red;">connection unsuccessful:<br />' .
					 mysqli_error ( $dbc ) . '.</font>';
}

echo "<br/><br/>", "\n";
echo "  <fieldset class=\"fieldset-auto-width\">", "\n";
echo "   <span>", "\n";
echo "    <strong>\"Gotta catch several of 'em\"</strong><br/>", "\n";
echo "      &nbsp;Here is the information that was entered into the database:&nbsp;", "\n";
echo "   </span>", "\n";
echo "<br/><br/>", "\n";

$energy = $_POST ['energy'];
$units = $_POST ['units'];
$clover = $_POST ['clover'];
$candle = $_POST ['candle'];
$puddle = $_POST ['puddle'];
$spark = $_POST ['spark'];
$thinkin = $_POST ['thinkin'];
$agree = $_POST ['agree'];

/*
 * check whether or not the server is configured to auto-add slashes,
 * via get_magic_quotes_gpc, and only call stripslashes in that case
 * calling mysqli_real_escape_string on user provided text to guard against SQL injection
 */

if (get_magic_quotes_gpc ()) {
	$name = mysqli_real_escape_string ( stripslashes ( $_POST ['name'] ) );
} else {
	$name = mysqli_real_escape_string ( $_POST ['name'] );
}
if (get_magic_quotes_gpc ()) {
	$species = mysqli_real_escape_string ( stripslashes ( $_POST ['species'] ) );
} else {
	$species = mysqli_real_escape_string ( $_POST ['species'] );
}

if (get_magic_quotes_gpc ()) {
	$pounds = mysqli_real_escape_string ( stripslashes ( $_POST ['pounds'] ) );
} else {
	$pounds = mysqli_real_escape_string ( $_POST ['pounds'] );
}

if (get_magic_quotes_gpc ()) {
	$flavor = mysqli_real_escape_string ( stripslashes ( $_POST ['flavor'] ) );
} else {
	$flavor = mysqli_real_escape_string ( $_POST ['flavor'] );
}

// server side validation

$nameErr = $speciesErr = "";
$name = $species = "";

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	// check name for empty field
	if (empty ( $_POST ["name"] )) {
		$nameErr = "<br/><b>*ERROR*</b><em>Name is required</em><b>*ERROR*</b>";
	} else {
		$name = test_input ( $_POST ["name"] );
		// check if name contains letters, numbers, no spaces and less than 100 char
		if (! preg_match ( "/^[a-zA-Z0-9]*$/", $name )) {
			$nameErr = "<br/><b>*ERROR*</b><em>Letter & numbers only and no spaces please</em>
							 <b>*ERROR*</b>";
		} else if (strlen ( $name ) > 100) {
			$nameErr = "<br/><b>*ERROR*</b><em> Must be no more than 30 characters</em>
							 <b>*ERROR*</b>";
		}
	} // check species for empty field
	if (empty ( $_POST ["species"] )) {
		$speciesErr = "<br/><b>*ERROR*</b><em>Species is required</em><b>*ERROR*</b>";
	} else {
		$species = test_input ( $_POST ["species"] );
		// check if species contains at least 1 letter, no spaces and less than 100 char
		if (! preg_match ( "/^(?=.*[a-zA-Z])([a-zA-Z0-9])*$/", $species )) {
			$speciesErr = "<br/><b>*ERROR*</b>
					<em>Must contain at least 1 letter but no spaces please</em>
								<b>*ERROR*</b>";
		} else if (strlen ( $species ) > 100) {
			$speciesErr = "<br/><b>*ERROR*</b><em> Must be no more than 100 characters</em>
							    <b>*ERROR*</b>";
		}
	}
	if (empty ( $_POST ["pounds"] )) {
		$poundsErr = "<br/><b>*ERROR*</b><em>Weight required</em><b>*ERROR*</b>";
	} else {
		$pounds = test_input ( $_POST ["pounds"] );
		// check if weight only contains 0-9999
		if (! preg_match ( "/^[0-9]*$/", $pounds )) {
			$poundsErr = "<br/><b>*ERROR*</b><em>Weight must be between 0-9999</em><b>*ERROR*</b>";
		} else if (strlen ( $pounds ) > 4) {
			$poundsErr = "<br/><b>*ERROR*</b><em>Weight must be between 0-9999</em><b>*ERROR*</b>";
		}
	}
	if (empty ( $_POST ["flavor"] )) {
		$flavorErr = "";
	} else {
		$flavor = test_input ( $_POST ["flavor"] );
	}
	
	// successful server side validation of checkbox commented out
	// until client side validation devlopment is completed
	/*
	 * if (empty($_POST["agree"])) {
	 * $agreeErr = "<br/><b>*ERROR*</b><em>Checkbox required</em><b>*ERROR*</b>";
	 * } else {
	 * $agree = test_input($_POST["agree"]);
	 * }
	 */
}
// sanitizes field input@param $data is the fields string input
function test_input($data) {
	$data = trim ( $data );
	$data = htmlspecialchars ( $data );
	return $data;
}

echo " <!-- received data  -->", "\n";
// Print the received data:
echo "   <div>", "\n";
echo $agreeErr;
echo "    <p>\n      <b>Trainer</b>: $name", "\n";
echo $nameErr;
echo "<br/>", "\n";
echo "      <b>Species</b>: $species", "\n";
echo $speciesErr;
echo "<br/>", "\n";
echo "      <b>Weight</b>: $pounds", "\n";
echo $poundsErr;
echo "<br/>", "\n";
echo "      <b>Weight-Units</b>: $units", "\n";
echo "<br/>", "\n";
echo "      <b>Energy</b>: $energy", "\n";
echo "<br/>", "\n";
echo "      <b>Flavor Text</b>: $flavor</p>", "\n";
echo "   <ul style=\"list-style-type:none\">", "\n";
echo "    <li><b>Clover</b>: $clover</li>", "\n";
echo "    <li><b>Candle</b>: $candle</li>", "\n";
echo "    <li><b>Puddle</b>: $puddle</li>", "\n";
echo "    <li><b>Spark</b>: $spark</li>", "\n";
echo "    <li><b>Thinkin'</b>: $thinkin</li>", "\n";
echo "   </ul>", "\n";
echo "  </div>", "\n";
echo "<br/>", "\n";
echo "  <div>", "\n";
echo "	 <h3>", "\n";
echo "    <a href=\"https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php\">
		Visit the Okaymon database summary</a>", "\n";
echo "	 </h3>", "\n";
echo "  <font size=\"-1\">to see how your Okaymon stacks up against the others!</font>", "\n";
echo "	</div>", "\n";
echo "    <div>", "\n";
echo "    <h3>", "\n";
echo "     <a href=\"https://php.radford.edu/~saustin4/itec325/hw-ec2/okaymon-edit-form.php\">
		Back to the form</a>", "\n";
echo "    </h3>", "\n";
echo "<font size=\"-1\">to enter a new Okaymon</font>", "\n";
echo "    </div>", "\n";
echo "  </fieldset>", "\n";
echo "<br/><br/>", "\n";
echo "  <fieldset class=\"fieldset-auto-width\">", "\n";
echo "   <span>", "\n";
/*
 * SQL REPLACE used instead of INSERT
 * to overwrite existing data for rows with same unique index (species)
 * energy resistances/weaknesses also included
 * calling htmlspecialchars on user provided text to guard against HTML/script injection
 */
$inCommand = htmlspecialchars ( 
		"REPLACE INTO okaymon(name,species,pounds,units,flavor,energy,clover,candle,puddle,spark,thinkin)
   VALUES('$name','$species','$pounds','$units','$flavor','$energy','$clover','$candle','$puddle',
		'$spark','$thinkin')" );

echo " <font size=\"-1\">SQL <strike>INSERT</strike> REPLACE command:<br/>\n  <code>\n" . $inCommand, "\n  </code>\n </font>\n<br/>\n";
if ($insert = mysqli_query ( $dbc, $inCommand )) {
	print '<font size="-2">submission successful.</font>';
} else {
	print '<font size="-2">submission UNsuccessful:<br/>' . mysqli_error ( $dbc ) . '</font>';
}
echo " </span>", "\n";

mysqli_close ( $dbc ); // closing db connection

echo "  </fieldset>", "\n";
echo "<br/><br/>", "\n";
echo "    <hr />", "\n";
echo "  <fieldset><font size=\"-1\">Please address problems to 
		   <a href=\"mailto:saustin4@radford.edu\" >saustin4@radford.edu</a></font>
		</fieldset>", "\n";
echo " </body>", "\n";
echo "</html>", "\n";
?>