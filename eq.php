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

$_eq_version = "1.0";

#region Basic HTML

/**
 * Opens the HTML document
 * @function
 * @param {string} [attributes] - Add optional attributes to the <html> tag, such as html('lang="en" xmlns="http://www.w3.org/1999/xhtml"');
 */
function html($attributes = "") {
	
	if ($attributes != "") {
		$attributes = " " + $attributes;
	}
	
	echo "<!DOCTYPE html>\n<html{$attributes}>" . "\n";
}

/**
 * Closes the HTML document
 * @function
 */
function html_end() {
	echo "</html>" . "\n";
}

/**
 * Opens the head section of the document
 * @function
 */
function head() {
	echo "<head>" . "\n";
}

/**
 * Closes the head section of the document
 * @function
 */
function head_end() {
	echo "</head>" . "\n";
}

/**
 * Opens the body section of the document
 * @function
 */
function body() {
	echo "<body>" . "\n";
}

/**
 * Closes the body section of the document
 * @function
 */
function body_end() {
	echo "</body>" . "\n";
}

/**
 * Sets the title of the document within the head section
 * @function
 * @param {string} title - String to set the title to
 */
function eq_title($title) {
	echo "<title>{$title}</title>" . "\n";
}

function eq_meta($name = "", $content = "") {
	
	$_first 	= "name=";
	$_second 	= "content=";
	
	$_charset_array 	= ["ascii", "ansi", "8859-1", "utf-8"];
	$_ht_equ_array 		= ["content-security-policy", "content-type", "default-style", "refresh"];
	$_social_array		= ["og:", "fb:", "article:"]; // Just a quick note that this is very dumb - Twitter gets it right though and deserves lots of clapping
	
	// If our type is in the header array
	if (in_array(strtolower($name), $_ht_equ_array)) {
		// We can assume we're setting via http-equiv
		$_first = "http-equiv=";
	}
	
	// If our type is in the charset array
	if (in_array(strtolower($name), $_charset_array)) {
		// We can assume we're setting via charset
		$_first = "charset=";
	}
	
	// Check for social tags that need modification - again, this is so dumb. 
	foreach($_social_array as $_social) {
		if (substr_count(strtolower($name), $_social)) {
			$_first = "property=";
		}
	}
	
	echo "<meta {$_first}\"{$name}\"";
	
	if ($content !== "") {
		echo " {$_second}\"{$content}\"";
	}
	
	echo ">\n";
	
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

#region Optimized HTML

/**
 * Automated opening of HTML document
 * @function
 * @param {...string} attributes - include links to stylesheets, javascript, etc
 */
function eq_start() {
	$_numArgs = func_get_args();
	
	html();
	head();
	
	// Loop through attributes
	foreach ($_numArgs as $args) {
		// Match and do function
		if (is_array($args)) {
			$_pass = "";
			if (isset($args[1])) {
				$_pass = $args[1];
			}
			eq_meta($args[0], $_pass);
		} else if (substr_count($args, "title=")) {
			eq_title(explode("=", $args)[1]);
		} else if (substr_count($args, ".css")) {
			eq_style($args);
		} else if (substr_count($args, ".js")) {
			eq_script($args);
		}
	}
	
	head_end();
	
}

function eq_end() {
	html_end();
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
	if (url_exists($script) || file_exists($script)) {
		echo "<script src=\"{$script}\"></script>" . "\n";
	} else {
		echo "<script>{$script}</script>" . "\n";
	}
	
}

#endregion

#region Content Functions

/**
 * Output text (or HTML) to the page
 * @function
 * @param {string} text - The string to output, can be an array
 * @param {string} [type] - The tag to enclose with, defaults to "p"
 * @param {string} [class] - The class to set the text to
 */
function eq_text($text = "", $type = "p", $class = -1) {
	$_class = "";
	if ($class != -1) {
		$_class = " class=\"{$class}\"";
	}
	
	if (!is_array($text)) {
		$text = [$text];
	}
	
	if (!is_array($type)) {
		$type = [$type];
	}
	
	// Set up the type vars
	$_typeStart = "";
	$_typeEnd	= "";
	foreach ($type as $t) {
		$_typeStart .= "<{$t}{$_class}>";
		$_typeEnd	= "</{$t}>" . $_typeEnd;
	}
	
	foreach ($text as $_text) {
		echo "{$_typeStart}{$_text}{$_typeEnd}" . "\n";
	}

}

/**
 * Embed image onto the page
 * @function
 * @param {string} URL - The url of the image
 * @param {string} [class] - the class of the image
 * @param {string} [addt] - additional <img> attributes
 */
function eq_image($url = "", $class = -1, $addt = -1) {
	$_class = "";
	if ($class != -1) {
		$_class = " class=\"{$class}\"";
	}
	
	$_addt = "";
	if ($addt != -1) {
		$_addt = " " . $addt;
	}
	
	echo "<img src=\"{$url}\"{$_class}{$_addt}>";

}

function eq_button($text = "", $action = -1, $class = -1) {
	
	$_class = "";
	if ($class != -1) {
		$_class = " class=\"{$class}\"";
	}
	
	echo "<button{$_class}>{$text}</button>";
	
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


// A message that appears only if you browse to this file
if (count(get_included_files()) == 1) {
	echo "
									███████╗░██████╗░░░░██████╗░██╗░░██╗██████╗░<br>
									██╔════╝██╔═══██╗░░░██╔══██╗██║░░██║██╔══██╗<br>
									█████╗░░██║██╗██║░░░██████╔╝███████║██████╔╝<br>
									██╔══╝░░╚██████╔╝░░░██╔═══╝░██╔══██║██╔═══╝░<br>
									███████╗░╚═██╔═╝░██╗██║░░░░░██║░░██║██║░░░░░<br>
									╚══════╝░░░╚═╝░░░╚═╝╚═╝░░░░░╚═╝░░╚═╝╚═╝░░░░░{$_eq_version}<br>
									this site uses eq.php - an easy way to markup pages within PHP scripts<br>
									goto <a href=\"https://brianlaclair.com/eq\">https://brianlaclair.com/eq</a> to learn more!
	";
}
