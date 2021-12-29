<?php
	require "../eq.php";
	eq_start("title=eq.php", "style.css", "prism.css");
	body();
	
	$tagline = "better- markup- with- php";

	eq_div("header");
	
		eq_text("🎯eq<sub>.php</sub>", "h1", "center");
		eq_text(explode("-", $tagline), "t");
		
	eq_div_end();
	
	eq_div("content");
	eq_div("grid");

	eq_text(@'<!--<!DOCTYPE html>
	<html>
	<head>
	<title>eq.php</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="prism.css">
	</head>-->', ["div class='box'","pre", "code"], "language-html");
	
	eq_text("➡️", ["div class='box'", "h2"]);

	eq_text('eq_start("title=eq.php", "style.css", "prism.css");', ["div class='box'", "pre", "code"], "language-php");

	eq_div_end();
	eq_div_end();
	
	
	eq_script("prism.js");
	body_end();
	eq_end();
?>