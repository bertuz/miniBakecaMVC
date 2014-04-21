<?php

class AnnunciView extends View {
	protected $route;

	function __construct($route, Model $model = null) { 
		$this->route = $route;
		$this->model = $model;
	}

	function output() {
		echo apply_template(__SITE_PATH . '/templates/annunci.tpl', array("annunci" => $this->model->getData()->annunci, "route" => $this->route));
	}
}

?>