<?php
	require "../eq.php";
	eq_start("title=eq.php", "style.css", "prism.css", "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js");
	body();
	
	$tagline = "better- markup- with- php";

	eq_div("header");
	
		eq_text("🎯eq<sub>.php</sub>", "h1", "center");
		eq_text(explode("-", $tagline), "t");
		
	eq_div_end();
	
	eq_div("content");
	
	eq_div("grid");
		eq_div("box");
			eq_text("There's a better way to write HTML now.", "h2", "center");
			eq_text(["eq.php is a PHP library that exists to make your life easier", "Why focus on ever-changing, messy, and randomly deviating markup within your PHP?", "<b>eq.php takes the trial-and-error out of markup and allows you to make your page beautiful with sensible functions</b>"], "p", "center");
		eq_div_end();
		eq_div("box");
		eq_div_end();
		eq_div("box");
			eq_button("get eq.php", "", "button");
		eq_div_end();
	
	eq_div_end();
	
	eq_div("grid");

	eq_text(@'<!--<!DOCTYPE html>
	<html>
	<head>
	<title>eq.php</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="prism.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>-->', ["div class='box'","pre", "code"], "language-html");
	
	eq_text("eq ➡️", ["div class='box'", "h2"], "middle");

	eq_text('eq_start("title=eq.php", "style.css", "prism.css", "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js");', ["div class='box'", "pre", "code"], "language-php");

	eq_div_end();
	eq_div_end();
	
	
	eq_script("prism.js");
	body_end();
	eq_end();
?>