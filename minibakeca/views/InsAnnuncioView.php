<?php

class InsAnnuncioView extends View {

	function __construct($route, Model $model = null) {
		$this->route = $route;
		$this->model = $model;
	}

	private function renderValidationErrors($fromValidation = true) {
		if($fromValidation) {
			$params = array("errorMessage"=> "Fai attenzione ai seguenti errori e riprova:");
			$params['errors'] = $this->model->getValidationMessages();
		}
		else
			$params = array("errorMessage"=> "Un errore imprevisto ha impedito il salvataggio dell'annuncio. Per favore, riprova.");
		
		$params['values'] = $this->model->getData();

		echo apply_template(__SITE_PATH . '/templates/ins_annuncio.tpl', $params);
	}

	private function renderInsertionComplete() {
		echo apply_template(__SITE_PATH . '/templates/ins_annuncio_complete.tpl', array("idAnnuncio"=> $this->model->getData()->ID));	
	}

	private function renderToInsert() {
		echo apply_template(__SITE_PATH . '/templates/ins_annuncio.tpl');	
	}

	private function renderInsertionFailed() {
		$this->renderValidationErrors(false);
	}

	public function output() {
		if(is_object($this->model->getData())) {
			if(!is_null($this->model->getValidationMessages()))
				$this->renderValidationErrors();

			else if(!empty($this->model->getData()->ID))
				$this->renderInsertionComplete();
			
			else
				$this->renderInsertionFailed();
		}
		else
			$this->renderToInsert();
	}
}
?>