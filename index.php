<?php

require "eq2.php";

eq_start("eq_title=Wow, Pictures", "https://fonts.googleapis.com/css?family=Roboto:600|Work+Sans:600|Open+Sans:300,400");

eq_style("style.css");

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
for($i = 0; $i < 500; $i++) {
	eq_image("https://picsum.photos/200?random={$i}", "together");
}
eq_div_end();



eq_end();


?>