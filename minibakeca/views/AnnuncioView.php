<?php

class AnnuncioView extends View {

	function __construct($route, Model $model = null) {
		$this->route = $route;
		$this->model = $model;
	}

	public function output() {
		$paramsTpl = array("dati"=> $this->model->getData(), "route"=> $this->route);
		$operationObj;

		echo apply_template(__SITE_PATH . '/templates/navigation_bar.tpl');	
		
		if(is_null($this->model->getData())) {
			echo apply_template(__SITE_PATH . '/templates/no_annuncio.tpl');	
			return;
		}

		if($this->model->getOperationData()->operationName == "sendInterest") {
			$operationObj = $this->model->getOperationData();

			$paramsTpl['interestSuccess'] = $operationObj->success;
			
			if($operationObj->success == false) {
				$paramsTpl['errors'] = $operationObj->errors;
				$paramsTpl['values'] = $this->model->getDataInteresse();
			}
		}
		
		echo apply_template(__SITE_PATH . '/templates/annuncio.tpl', $paramsTpl);
			
	}
}
?>