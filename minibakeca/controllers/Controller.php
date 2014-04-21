<?php

Class Controller {
	protected $model;

	public function __construct(Model $model) { 
		$this->model = $model;
    }

    public function defaultOp() { }	

}

?>
