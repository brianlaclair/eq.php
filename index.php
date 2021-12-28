<?php
	require "eq.php";
	html();
	head();
		eq_title("{$_GET['a']} - A Page");
		eq_script("https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js");
		eq_script("alert('hello world');");
		eq_style("style.css");
	head_end();
	body();

	$names = ["Brian LaClair", "AJ Margolis", "Jack Otherthings", "Test Name", "Josh Vermey", "Kyle Landon"];

	eq_div("right");
	
		eq_text(["eq<sub>.php</sub>"], "h1", "center");
		eq_text(["The table below will demonstrate absolutely nothing of value", "But! It will show a cool functionality of eq.php", "We can even keep adding to this array", "Yup, literally as much as you want"], "p", "center");
	
			eq_table("phpTable");
			eq_table_row("ID", "First", "Last", "Another", "Table");
			
			$count = 1;
			
			foreach ($names as $name) {
				$_name = explode(" ", $name);
				eq_table_row($count, $_name[0], $_name[1], "Testing"[$count], "tablestuff"[$count]);
				$count++;
			}
			
			eq_table_end();
	
	eq_div_end();
	
	body_end();
	html_end();
?>