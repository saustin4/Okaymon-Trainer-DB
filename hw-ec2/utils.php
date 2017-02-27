<?php
/*
 * StacyAustin
 * ITEC325
 * Fall2015
 * URL - https://php.radford.edu/~saustin4/itec325/hw03/okaymon-edit-form2.php
 * DESCRIPTION - utilities file of many useful web development functions
 * SOURCES & CREDITS - Dr. Barland, w3schools.com, php.net, stackoverflow.com,
 * PHP for The Web by Larry Ullman
 * UPDATES --- program still in development to add errors array from hw02
 *
 */
error_reporting ( E_ALL );
define ( "PRINT_ON_SUCCESS", true );
define ( 'SHOW_SUCCESSFUL_TEST_OUTPUT', true );
/*
 * test()
 * returns the results of a string comparison test in the form of a printed message
 * @param $actual is the actual result producing function to be tested
 * @param $expect is the expected results
 * ---function still in development to apply trim()
 */
function test($actual, $expect) {
	$actual = preg_replace ( '/\s+/', '', $actual );
	$expect = preg_replace ( '/\s+/', '', $expect );
	if ($actual === $expect) {
		if (PRINT_ON_SUCCESS) {
			print ".";
		}
	} else {
		print " FAILED";
	}
}

// sourced from Ian Barland
/**
 * Return the html for a drop-down menu.
 *
 * @param $groupName the
 *        	name and id for the drop-down.
 * @param $entries an
 *        	array of the drop-down options.
 *        	The value is what will be returned in the form;
 *        	the visible menu will use the key (if non-numeric),
 *        	or will also use the value (if key is numeric).
 * @param $intro (optional)
 *        	An initial, visible entry.
 * @return the html for a drop-down menu.
 */
function dropdown($groupName, $entries, $intro = null) {
	$rowsSoFar = "";
	if (isset ( $intro ))
		$rowsSoFar .= "  <option value=''>$intro</option>\n";
	foreach ( $entries as $key => $val ) {
		$rowsSoFar .= "  <option value='$val'>" . (is_numeric ( $key ) ? $val : $key) . "</option>\n";
	}
	return "<select name='$groupName' id='$groupName'>\n$rowsSoFar</select>";
}

// sourced from Ian Barland
/*
 * radioTable : array-of-string, array-of-string, string → string
 * The argument `$indentaion` is a string we'll prepend to each line of our output;
 * we'll further add a couple extra spaces more in the interior for tags *inside* the `table` tag.
 */
function radioTable($rowNames, $colNames, $tableName = false, $indention = "") {
	$indentionInsideTable = $indention . "  ";
	$headerRow = $indentionInsideTable . tableHeaderRow ( $colNames, false, true );
	$rowsSoFar = "";
	foreach ( $rowNames as $rowName ) {
		$rowsSoFar .= $indentionInsideTable . radioTableRow ( $rowName, $colNames, $tableName ) .
				 "\n";
	}
	return "<table>\n$headerRow\n$rowsSoFar</table>\n";
}

/*
 * radioTableRow : string, array-of-string → string
 * Return a tr of td's containing a input:radio-button;
 * the input's `name` attribute is ...
 */
function radioTableRow($rowName, $colNames, $tableName = false) {
	$rowSoFar = "";
	foreach ( $colNames as $colName ) {
		$nameAttr = ($tableName ? "$tableName" . "[$rowName]" : $rowName);
		$idAttr = ($tableName ? "$tableName-" : "") . "$rowName-$colName";
		$rowSoFar .= "  <td><input type='radio' id='$idAttr' name='$nameAttr' value='$colName'/></td>\n";
	}
	$rowSoFar .= "  <th>$rowName</th>\n";
	return "<tr>\n$rowSoFar  </tr>\n\n";
}

/*
 * tableHeaderRow : array-of-string, boolean, boolean → string
 * Return a tr of th's, using each name as an element.
 * Include a blank th on the left(right) side if $includeUnlabeledLeftColumn
 * ($includeUnlabeledRightColumn) is true.
 */
function tableHeaderRow($colNames, $includeUnlabeledLeftColumn = false, 
		$includeUnlabeledRightColumn = false) {
	$rowSoFar = "";
	if ($includeUnlabeledLeftColumn) {
		$rowSoFar .= "<th></th> ";
	}
	foreach ( $colNames as $colName ) {
		$rowSoFar .= "<th>$colName</th> ";
	}
	if ($includeUnlabeledRightColumn) {
		$rowSoFar .= "<th></th> ";
	}
	return "<tr> $rowSoFar</tr>\n";
}

/**
 * Return $_POST[$fieldname] (removing magically-introduced slashes if any were added).
 */
function getInput($fieldname) {
	return get_magic_quotes_gpc () ? stripslashes ( $_POST [$fieldname] ) : $_POST [$fieldname];
}
// end sourced from Barland

/*
 * function allErrorMessages () {
 * takes an array of form-info, and returns an array of error-messages.
 * }
 * helpers
 * rangeErrorMessage : string, number, number → string-or-false which makes sure an input
 * is a number in the expected range
 */

?>
