<?php

require "eq2.php";

eq_start();

eq_title("Hello World");
eq_style("style.css");

eq_div("main");
eq_text(["This", "Is", "A", "Test", "Ain't", "It?"], ["p", "b"]);
eq_div_end();

eq_end();


?>