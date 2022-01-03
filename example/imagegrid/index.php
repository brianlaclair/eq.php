<?php
require "../../eq.php";

eq_start("eq_title=Wow, Pictures");

eq_style(
"body {
 background-color: #000;
 margin:			0px;
 padding:			0px;
 overflow:			hidden;
}

.center {
	margin:			auto;
	width:			200%;
}

.together {
	margin:			-2px;
	transition-duration: 0.5s;
}

.together:hover {
	border-radius:	50%;
}");

eq_div("center");
	$picArray = [];
	for($i = 0; $i < 500; $i++) {
		array_push($picArray, "https://picsum.photos/100?random={$i}");
	}
	eq_image($picArray, "together");
eq_div_end();



eq_end();
?>