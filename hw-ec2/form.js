/*
StacyAustin 
ITEC325
Fall2015
URL - https://php.radford.edu/~saustin4/itec325/hw04/form.js
DESCRIPTION - javascript functions for html form validation of "okaymon" data entry
SOURCES & CREDITS - Dr. Barland, w3schools.com, php.net & stackoverflow.com

/*inserts "error message" string into an otherwise empty DOM node by replacing the innerHTML
 @param "id" is the receiving nodes id attributes value
 @param "msg" is what will be the receiving nodes new innerHTML / error message
 */
function reportError(id, msg) {
	var id = id;
	document.getElementById(id).innerHTML = msg;
}

// clears all DOM err nodes simultaneously by replacing them with empty strings
function clearErrs() {
	document.getElementById("nameErr").innerHTML = "";
	document.getElementById("speciesErr").innerHTML = "";
	document.getElementById("poundsErr").innerHTML = "";
	// document.getElementById("agreeErr").innerHTML = ""; currently in
	// development
}

// validates entire form by calling each individual fields validation function
function validateAll() {
	validateName();
	validateSpecies();
	return validatePounds();
	// return validateAgree();

}

/*
 * validates name field for empty, numbers & letters only , max length, no
 * spaces, and also trims whitespace from edges of input string
 */
function validateName() {
	var regex = new RegExp("[^0-9|a-z|A-Z]");
	if (regex.test(document.getElementById("name").value.trim())) {
		reportError("nameErr", "NO SPACES and LETTERS or NUMBER ONLY PLEASE");
		return false;
	}
	var x = document.forms["form"]["name"].value;
	if (x == null || x == "") {
		reportError("nameErr", "NAME REQUIRED PLEASE");
		return false;
	}
	var fieldLength = document.getElementById('name').value.length;
	if (fieldLength >= 101) {

		reportError("nameErr", "100 OR LESS CHARACTERS PLEASE");
		return false;

	} else {
		reportError("nameErr", "");
		return true;
	}
}

/*
 * validates species field for empty, numbers & letters only , max length, no
 * spaces, and also trims whitespace from edges of input string
 */
function validateSpecies() {
	var regex = new RegExp("[^0-9|a-z|A-Z]");
	if (regex.test(document.getElementById("species").value.trim())) {
		reportError("speciesErr", "NO SPACES and LETTERS or NUMBER ONLY PLEASE");
		return false;
	}
	var x = document.forms["form"]["species"].value;
	if (x == null || x == "") {
		reportError("speciesErr", "SPECIES REQUIRED PLEASE");
		return false;
	}
	var fieldLength = document.getElementById('name').value.length;
	if (fieldLength >= 101) {

		reportError("speciesErr", "100 OR LESS CHARACTERS PLEASE");
		return false;

	} else {
		reportError("speciesErr", "");
		return true;
	}
}

/*
 * validates weight field for empty, numbers only , max length, no spaces, and
 * also trims whitespace from edges of input string
 */
function validatePounds() {
	var regex = new RegExp("[^0-9]");
	if (regex.test(document.getElementById("pounds").value.trim())) {
		reportError("poundsErr", "NO SPACES, 0-9999 NUMBERS ONLY PLEASE");
		return false;
	}
	var x = document.forms["form"]["pounds"].value;
	if (x == null || x == "" || x > 9999) {
		reportError("poundsErr", "NO SPACES, 0-9999 NUMBERS ONLY PLEASE");
		return false;
	} else {
		reportError("poundsErr", "");
		return true;
	}
}

// checkbox validation currently in development on client side
/*
 * function validateAgree() { var x = document.forms["form"]["agree"].checked;
 * if (x == false) { reportError("agreeErr", "CHECKBOX REQUIRED PLEASE"); return
 * false; } else { reportError("agreeErr", ""); return true; } }
 */