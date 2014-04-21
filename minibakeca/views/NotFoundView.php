<?php

class NotFoundView extends View {

	function __construct($route, Model $model = null) {
		$this->model = $model;
	}

	public function output() {
		echo apply_template(__SITE_PATH . '/templates/not_found.tpl');
	}
}
?>