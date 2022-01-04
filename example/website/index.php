<?php
	require "../../eq.php";
	
$first_example = ['html' => '<!--<!DOCTYPE html>
<html>
<head>
<title>eq.php</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="prism.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
</body>
</html>-->', 
'eq' => 'eq_start("eq_title=eq.php", "style.css", "prism.css", "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js");
eq_end();'];
	
	eq_start("eq_title=eq.php", "style.css", "prism.css", "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js");
	$tagline = "better- markup- with- php";
	
	eq_div("header");
	
		eq_text("🎯eq<sub>.php</sub>", "h1", "center");
		eq_text(explode("-", $tagline), "t");
		
	eq_div_end();
	
	eq_script("function copy_composer() {
	var text = '\"brianlaclair/eq\": \"1.*.*\"';
	navigator.clipboard.writeText(text);
	}");
	
	eq_div("content");
	
	eq_div("grid");
		eq_div("box");
			eq_text("There's a better way to write HTML", "h2", "center");
			eq_text(["eq.php is a php library that exists to make your life easier", "Why focus on ever-changing, messy, and randomly deviating markup within your code?", "<b>eq.php takes the trial-and-error out of markup and allows you to make your page beautiful with simple, sensible functions</b>"], "p", "center");
		eq_div_end();
		eq_div_end("box");
		eq_div("box");
			$buttons = [eq_link("#get", "📁 get eq.php", "button"), eq_link("", "📖 learn eq.php", "button"), eq_link("", "💸 donate", "button")];
			eq_text($buttons, "butt_list");
		eq_div_end();
	eq_div_end();
	
	eq_div("grid", "get");
		eq_div("box");
			eq_text("get eq.php", "h2", "center");
			eq_text(["I suggest using " . eq_link("https://getcomposer.org/","Composer") . " to install eq in your project, as it will help you stay up-to-date with new versions", "Alternatively, you may download the current version of the library from the link to the right, and view previous releases on the github"], "p", "center");
		eq_div_end();
		eq_div_end("box");
		eq_div("box");
			$buttons = [eq_link('!onclick=copy_composer();', '"brianlaclair/eq": "1.*.*"</br>copy to clipboard', "button"), eq_link("", "📁 download {$version} php", "button"), eq_link("", "🔭 older versions", "button")];
			eq_text($buttons, "butt_list");
		eq_div_end();
	eq_div_end();
	
	eq_div("grid");

	eq_text($first_example['html'], ["div class='box'","pre", "code"], "language-html");
	
	eq_text("eq ➡️", ["div class='box'", "h2"], "middle");

	eq_text($first_example['eq'], ["div class='box'", "pre", "code"], "language-php");

	eq_div_end(2);

	
	
	eq_script("prism.js");
	eq_end();
?>