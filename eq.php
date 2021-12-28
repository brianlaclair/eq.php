<?php

//									███████╗░██████╗░░░░██████╗░██╗░░██╗██████╗░
//									██╔════╝██╔═══██╗░░░██╔══██╗██║░░██║██╔══██╗
//									█████╗░░██║██╗██║░░░██████╔╝███████║██████╔╝
//									██╔══╝░░╚██████╔╝░░░██╔═══╝░██╔══██║██╔═══╝░
//									███████╗░╚═██╔═╝░██╗██║░░░░░██║░░██║██║░░░░░
//									╚══════╝░░░╚═╝░░░╚═╝╚═╝░░░░░╚═╝░░╚═╝╚═╝░░░░░
//										EQ.PHP is written by Brian LaClair
//									  brianlaclair.com/eq for help & license
//	

#region Temp Settings

$endchar = "\n";

#endregion

#region Basic HTML

/**
 * Opens the HTML document
 * @function
 * @param {string} [attributes] - Add optional attributes to the <html> tag, such as html('lang="en" xmlns="http://www.w3.org/1999/xhtml"');
 */
function html($attributes) {
	
	if ($attributes != "") {
		$attributes = " " + $attributes;
	}
	
	echo "<!DOCTYPE html>\n<html{$attributes}>";
}

/**
 * Closes the HTML document
 * @function
 */
function html_end() {
	echo "</html>";
}

/**
 * Opens the head section of the document
 * @function
 */
function head() {
	echo "<head>";
}

/**
 * Closes the head section of the document
 * @function
 */
function head_end() {
	echo "</head>";
}

/**
 * Opens the body section of the document
 * @function
 */
function body() {
	echo "<body>";
}

/**
 * Closes the body section of the document
 * @function
 */
function body_end() {
	echo "</body>";
}

/**
 * Sets the title of the document within the head section
 * @function
 * @param {string} title - String to set the title to
 */
function eq_title($title) {
	echo "<title>{$title}</title>";
}

#endregion

#region Styling Functions
/**
 * Sets CSS of the document
 * @function
 * @param {string} style - link to stylesheet or a string containing CSS
 */
function eq_style($stylesheet) {
	
	// If there is a space, we can assume it's not a link
	if (substr_count($stylesheet, " ")) {
		echo "<style>{$stylesheet}</style>" . "\n";
	} else {
		echo "<link rel=\"stylesheet\" href=\"{$stylesheet}\">" . "\n";
	}
	
	
}
#endregion

#region Foundational Functions

function url_exists($url) {
	
	$headers = @get_headers($url);
  
	if($headers && strpos( $headers[0], '200')) {
		return true;
	}
	
	return false;
	
}

// returns an HTML formatted string for class and id declarations
function prefix($class, $id) {
	
	$_class = "";
	$_id 	= "";
	
	if ($class != -1) {
		$_class = " class=\"{$class}\""; 
	}
	
	if ($id != -1) {
		$_id = " id=\"{$id}\""; 
	}
	
	return "{$_class}{$_id}";
	
}
#endregion

#region Script Functions

/**
 * Link or type JS elements
 * @function
 * @param {string} script - link to JS or a string containing JS
 */
function eq_script($script) {
	
	// Dynamically check if the script is going to be included by the browser, or if it's written on the page
	if (url_exists($script)) {
		echo "<script src=\"{$script}\"></script>" . "\n";
		echo "<!-- Found Script Automagically -->";
	} else {
		echo "<script>{$script}</script>" . "\n";
	}
	
}

#endregion

#region Text functions

/**
 * Output text (or HTML) to the page
 * @function
 * @param {string} text - The string to output
 * @param {string} [type] - The tag to enclose with, defaults to "p"
 * @param {string} [class] - The class to set the text to
 */
function eq_text($text = "", $type = "p", $class = -1) {
	$_class = "";
	if ($class != -1) {
		$_class = " class=\"{$class}\"";
	}
	
	if (is_array($text)) {
		foreach ($text as $_text) {
			echo "<{$type}{$_class}>{$_text}</{$type}>";
		}
	} else {
		echo "<{$type}{$_class}>{$text}</{$type}>";
	}

}

#endregion

#region Div Functions

/**
 * Open a new div
 * @function
 * @param {string} [class] - The class to set the div to
 * @param {string} [id] - The ID of the div
 */
function eq_div($class = -1, $id = -1) {
	
	echo "<div" . prefix($class, $id) . ">" . "\n";
	
}

/**
 * Closes the currently open div
 * @function
 */
function eq_div_end() {
	
	echo "</div>" . "\n";
	
}

#endregion
																
#region Table functions

/**
 * Open a new table
 * @function
 * @param {string} [class] - The class to set the table to
 * @param {string} [id] - The ID of the table
 */
function eq_table($class = -1, $id = -1) {
	
	echo "<table" . prefix($class, $id) . ">" . "\n";
	
}

/**
 * Add a row to the open table
 * @function
 * @param {...string} [cell_value] - value of the cell
 */
function eq_table_row() {
	$_numArgs = func_get_args();
	
	echo "<tr>";
	
	foreach ($_numArgs as $arg) {
		echo "<td>{$arg}</td>";
	}
	
	echo "</tr>" . "\n";
	
}

/**
 * Closes the open table
 * @function
 */
function eq_table_end() {
	
	echo "</table>" . "\n";
	
}
#endregion