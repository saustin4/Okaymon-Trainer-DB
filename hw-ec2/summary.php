<?php
error_reporting ( E_ALL );
require_once ('dbUserPass.php');

/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw-ec2/summary.php
 * DESCRIPTION - A summary page showing all Okaymon entered via entry form page
 * SOURCES & CREDITS - Dr. Barland, w3schools.com, php.net, stackoverflow.com,
 * PHP for The Web by Larry Ullman
 * UPDATES - added editing for each Oakymon, redirects to update form for with populated info
 */

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"", "\n";
echo "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">", "\n";
echo " <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">", "\n";
echo "   <head>", "\n";
echo "   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>", "\n";
echo "   <meta name=\"viewport\" content=\"width=590\" />", "\n";
echo "   <title>Okaymon Database Summary hw-ec2</title>", "\n";
echo "   <link href=\"form.css\" rel=\"stylesheet\" type=\"text/css\" />", "\n";
echo "   </head>", "\n";
echo "  <body>", "\n";
echo "   <fieldset><h1>Summary of Okaymon Database</h1></fieldset>", "\n";
echo "<br/>", "\n";

// connecting to db with meassage for confirmation
if ($dbc = @mysqli_connect ( 'localhost', user, pass, user )) {
	print '<font size="-2">connection successful.</font>';
} else {
	print 
			'<font size="-2" style="color:red;">connection unsuccessful:<br />' .
					 mysqli_error ( $dbc ) . '.</font>';
}
echo "<br/><br/>", "\n";
echo "<br/><br/>", "\n";

echo "   <fieldset class=\"fieldset-auto-width\">", "\n";
echo "<br/>", "\n";
echo "    <table align=\"center\">", "\n";
echo "     <tr>", "\n";
echo "      <th>Species</th> ", "\n";
echo "      <th>Energy</th> ", "\n";
echo "      <th>Weight</th>", "\n";
echo "      <th>Units</th>", "\n";
echo "      <th>Edit</th>", "\n";
echo "     </tr>", "\n";

// database query for all Okaymon
// calling htmlspecialchars on user provided text to guard against HTML/script injection

$sql = htmlspecialchars ( "SELECT * FROM okaymon ORDER BY species ASC" );
$allmon = mysqli_query ( $dbc, $sql );

echo " <!--output of each onemon looping over the results of the database query-->", "\n";
while ( $onemon = mysqli_fetch_array ( $allmon ) ) {
	$id = $onemon ['species']; // linking to same details page reguardless of the onemon chosen
	echo "     <tr>\n      <td>" . "<a href=\"./okayDetails.php?species=$id \">" . $id .
			 "</a></td>\n      <td>" . $onemon ["energy"] . "</td>\n      <td>" . $onemon ["pounds"] .
			 "</td>\n      <td>" . $onemon ["units"] .
			 "</td><td><a href=\"./okaymon-edit-form2.php?species=$id \">EDIT</a></td>\n   </tr>\n";
}
echo "    </table>", "\n";
echo "<h2>&nbsp;<a href=\"https://php.radford.edu/~saustin4/itec325/hw-ec2/okaymon-edit-form.php\" >
		   Visit the Okaymon entry form</a>&nbsp;</h2>", "\n";

echo "    <font size=\"-1\">to enter info for new Okaymon!</font>", "\n";
echo "   </fieldset>", "\n";

echo "<br/><br/>", "\n";

// closing db connection
mysqli_close ( $dbc );

echo "      <hr />", "\n";
echo "   <fieldset>", "\n";
echo "	  <font size=\"-1\">Please address problems to<a href=\"mailto:saustin4@radford.edu\">
	      saustin4@radford.edu</a></font>", "\n";
echo "   </fieldset>", "\n";
echo "  </body>", "\n";
echo " </html>", "\n";

?>