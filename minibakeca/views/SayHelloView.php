<?php

class SayHelloView extends View {
	function __construct($route, Model $model = null){ }

	function output() {
		echo apply_template(__SITE_PATH . '/templates/hello.tpl', array("nome"=> "Matteo"));
	}
}
?>