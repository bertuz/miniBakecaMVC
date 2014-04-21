<?php

require_once(__SITE_PATH . '/lib/templateEngine.php');

abstract class View {
	protected $route;
	protected $model;

	abstract public function __construct($route, Model $model = null);
	abstract public function output();
}

?>