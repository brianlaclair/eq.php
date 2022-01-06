<?php
require ("../../eq.php");

class div {
	
	public $divclass;
	public $text;
	
	function __construct($_class, $_text) {
		$this->divclass = $_class;
		$this->text 	= $_text;
	}
	
	function run() {
		eq_div($this->divclass);
		eq_text($this->text);
		eq_div_end();
	}
	
}

eq_start();

$firstdiv = new div("test", "Hello World");
$firstdiv->run();
$firstdiv->run();
$firstdiv->run();

eq_end();