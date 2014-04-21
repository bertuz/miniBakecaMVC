<?php

class AnnuncioView extends View {

	function __construct($route, Model $model = null) {
		$this->model = $model;
	}

	public function output() {
		echo apply_template(__SITE_PATH . '/templates/navigation_bar.tpl');	
		
		if(is_null($this->model->getData()))
			echo apply_template(__SITE_PATH . '/templates/no_annuncio.tpl');	
		else
			echo apply_template(__SITE_PATH . '/templates/annuncio.tpl', array("dati"=> $this->model->getData()));
	}
}
?>