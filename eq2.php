<?php
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░███████╗░██████╗░░░░██████╗░██╗░░██╗██████╗░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░██╔════╝██╔═══██╗░░░██╔══██╗██║░░██║██╔══██╗░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░█████╗░░██║██╗██║░░░██████╔╝███████║██████╔╝░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░██╔══╝░░╚██████╔╝░░░██╔═══╝░██╔══██║██╔═══╝░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░███████╗░╚═██╔═╝░██╗██║░░░░░██║░░██║██║░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░╚══════╝░░░╚═╝░░░╚═╝╚═╝░░░░░╚═╝░░╚═╝╚═╝░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░EQ.PHP is written by Brian LaClair░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░brianlaclair.com/eq for help & license░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
//░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

function eq_start() {
	
	// Create the buffer for all future EQ commands
	global $__eq_buffer, $__eq_html_attr;
	$__eq_buffer = ['head' => [], 'body' => []];
	$__eq_html_attr;
	
}

function eq_end($return = false) {
	
	// Finalize the EQ buffer and echo
	global $__eq_buffer, $__eq_html_attr;
	
	$_head 			= "";
	$_body 			= "";
	$_attributes 	= "";
	
	foreach ($__eq_buffer['head'] as $head) {
		$_head .= "\n" . $head;
	}
	
	foreach ($__eq_buffer['body'] as $body) {
		$_body .= "\n" . $body;
	}
	
	$_final = 
"<!DOCTYPE html>
<html{$_attributes}>
<head>{$_head}
</head>
<body>{$_body}
</body>
</html>";

	if (!$return) {
		echo $_final;
	} else {
		return $_final;
	}
	
}

#region Internal Functions

function _eq_add_head($ln) {
	
	global $__eq_buffer;
	array_push($__eq_buffer['head'], $ln);
	
}

function _eq_add_body($ln) {
	
	global $__eq_buffer;
	array_push($__eq_buffer['body'], $ln);
	
}

#endregion

#region Head Functions

function eq_title($title) {
	
	_eq_add_head("<title>{$title}</title>");
	
}

function eq_meta($name = "", $content = "") {
	
	$_first 			= "name=";
	$_second 			= "content=";
	
	$_ht_equ_array 		= ["content-security-policy", "content-type", "default-style", "refresh"];
	$_charset_array 	= ["ascii", "ansi", "8859-1", "utf-8"];
	$_social_array		= ["og:", "fb:", "article:"]; // Just a quick note that this is very dumb - Twitter gets it right though and deserves lots of clapping
	
	// If our type is in the header array
	if (in_array(strtolower($name), $_ht_equ_array)) {
		// We can assume we're setting http-equiv
		$_first = "http-equiv=";
	}
	
	// If our type is in the charset array
	if (in_array(strtolower($name), $_charset_array)) {
		// We can assume we're setting charset
		$_first = "charset=";
	}
	
	// Check for social tags that need modification - again, this is so dumb. 
	foreach($_social_array as $_social) {
		if (substr_count(strtolower($name), $_social)) {
			$_first = "property=";
		}
	}
	
	$_hold = "meta {$_first}\"{$name}\"";
	
	if ($content !== "") {
		$_hold .= " {$_second}\"{$content}\"";
	}
	
	_eq_add_head("<{$_mhold}>");
	
}

#endregion

#region Styling and Scripts

function eq_style($stylesheet, $head = true) {
	
	// If there is a space, we can assume it's not a link
	if (substr_count($stylesheet, " ")) {
		$_hold = "<style>{$stylesheet}</style>";
	} else {
		$_hold = "<link rel=\"stylesheet\" href=\"{$stylesheet}\">";
	}
	
	if ($head) {
		_eq_add_head($_hold);
	} else {
		_eq_add_body($_hold);
	}
	
}

#endregion

function eq_div($class = NULL, $id = NULL, $attr = NULL) {
	
	$_class = "";
	$_id	= "";
	$_attr  = "";
	
	if (isset($class)) {
		$_class = " class=\"{$class}\"";
	}
	
	if (isset($id)) {
		$_id = " id=\"{$id}\"";
	}
		
	if (isset($attr)) {
		$_attr = " " . $attr;
	}
	
	_eq_add_body("<div{$_id}{$_class}{$_attr}>");
	
}

function eq_div_end($ittr = 1) {
	for($i = 0; $i < $ittr; $i++) {
		_eq_add_body("</div>");
	}
}

function eq_text($text = "", $type = NULL, $class = NULL) {
	$_class = "";
	$_typeStart = "";
	$_typeEnd	= "";
	
	if (isset($class)) {
		$_class = " class=\"{$class}\"";
	}
	
	if (!is_array($text)) {
		$text = [$text];
	}
	
	if (isset($type) || isset($class)) {
		if (!is_array($type)) {
			$type = [$type];
		}
		
		// Set up the type vars
		foreach ($type as $t) {
			$_typeStart .= "<{$t}{$_class}>";
			$_tMod 		= explode(" ", $t)[0];
			$_typeEnd	= "</{$_tMod}>" . $_typeEnd;
		}
	}
	
	foreach ($text as $_text) {
		_eq_add_body("{$_typeStart}{$_text}{$_typeEnd}");
	}

}

?>