<?php
error_reporting ( E_ALL );
require_once ('dbUserPass.php');

/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/okayDetails.php
 * DESCRIPTION - Handler to display Okaymon details based row selected from db summary page
 * SOURCES & CREDITS - Dr. Barland, w3schools.com, php.net, stackoverflow.com,
 * PHP for The Web by Larry Ullman
 */

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"", "\n";
echo " \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">", "\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">", "\n";
echo " <head>", "\n";
echo "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>", "\n";
echo "   <meta name=\"viewport\" content=\"width=720\"/>", "\n";
echo "   <title>Okaymon Details hw-ec2</title>", "\n";
echo "   <link href=\"form.css\" rel=\"stylesheet\" type=\"text/css\" />", "\n";
echo " </head>", "\n";
echo " <body>", "\n";
echo "  <fieldset><h1>Okaymon Details</h1></fieldset>", "\n";
echo "<br/>", "\n";

// connecting to db with meassage for confirmation
if ($dbc = @mysqli_connect ( 'localhost', user, pass, user )) {
	print '<font size="-2">connection successful.</font>';
} else {
	print 
			'<font size="-2" style="color:red;">connection unsuccessful:<br />' . mysqli_error ( 
					$dbc ) . '.</font>';
}

echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";

// retrieving the chosen row from db summary page
$idd = $_GET ['species'];

// database query for said row
$allmon = mysqli_query ( $dbc, "SELECT * FROM okaymon WHERE species = '" . $idd . "'" );
while ( $onemon = mysqli_fetch_array ( $allmon ) ) {
	echo "  <fieldset>", "\n";
	echo "   <span>", "\n";
	echo "    <!--output data of selected onemon from db summary--> ", "\n";
	
	// calling htmlspecialchars on user provided text to guard against HTML/script injection
	echo "    <strong>Trainer Name: </strong>" . htmlspecialchars ( $onemon ["name"] ) .
			 " <br/><strong> Flavor Text: </strong>" . htmlspecialchars ( $onemon ["flavor"] ) . "", "\n";
	echo "   </span>", "\n";
	echo "<br/><br/>", "\n";
	echo "  <table border='1' cellpadding='5'>", "\n";
	echo "   <tr>  ", "\n";
	echo "    <th>Species</th> ", "\n";
	echo "    <th>Energy</th> ", "\n";
	echo "    <th>Weight</th>", "\n";
	echo "    <th>Units</th>", "\n";
	echo "    <th style=\"color:green\">Clover</th>", "\n";
	echo "    <th style=\"color:orange\">Candle</th>", "\n";
	echo "    <th style=\"color:blue\">Puddle</th>", "\n";
	echo "    <th style=\"color:yellow\">Spark</th>", "\n";
	echo "    <th style=\"color:grey\">Thinkin</th>", "\n";
	echo "   </tr>", "\n";
	
	// energy-biases inlcuded
	echo "   <tr>\n    <td>" . htmlspecialchars ( $onemon ["species"] ) . "</td>\n    <td>" .
			 $onemon ["energy"] . "</td>\n    <td>" . htmlspecialchars ( $onemon ["pounds"] ) .
			 "</td>\n    <td>" . $onemon ["units"] . "</td>\n    <td>" . $onemon ["clover"] .
			 "</td>\n    <td>" . $onemon ["candle"] . "</td>\n    <td>" . $onemon ["puddle"] .
			 "</td>\n    <td>" . $onemon ["spark"] . "</td>\n    <td>" . $onemon ["thinkin"] .
			 "</td>\n   </tr>" . "\n";
	
	echo "  </table>", "\n";
	$id = $onemon ['species'];
	echo "   <h2><a href=\"./okaymon-edit-form2.php?species=$id \">
		     To the update form</a></h2>", "\n";
	echo "    <font size=\"-1\">to edit this Okaymon!</font>", "\n";
	echo "   <h2><a href=\"https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php\" >
		     Back to the database</a></h2>", "\n";
	echo "    <font size=\"-1\">of all Okaymon!</font>", "\n";
	
	echo "  </fieldset>", "\n";
}
echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";

mysqli_close ( $dbc ); // closing db connection

echo "   <hr />", "\n";
echo "  <fieldset>", "\n";
echo "   <font size=\"-1\">Please address problems to <a href=\"mailto:saustin4@radford.edu\" >
		  saustin4@radford.edu</a>", "\n";
echo "   </font>", "\n";
echo "  </fieldset>", "\n";
echo " </body>", "\n";
echo "</html>", "\n";

?>