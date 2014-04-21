<?php

/**
 * Rappresenta un instradamento del front controller
*/
class Route { 
    protected $model; 
    protected $view; 
    protected $controller; 
  	
  	/**
 	 * aa
	*/   
    public function __construct($model, $view, $controller) { 
        $this->model = $model; 
        $this->view = $view; 
        $this->controller = $controller;         
    } 

	/**
 	 * @return String
	*/
    public function getModel() {
    	return $this->model;
    }

    public function getView() {
    	return $this->view;
    }

    public function getController() {
    	return $this->controller;
    }
}

/**
 * 
*/
class Router { 
    private $table = array(); 
     
    public function __construct() { 
        $this->table['home'] = new Route('AnnunciModel', 'AnnunciView', 'ViewAnnunciController');
        $this->table['viewAnnuncio'] = new Route('AnnuncioModel', 'AnnuncioView', 'ViewAnnuncioController');
        $this->table['insAnnuncio'] = new Route('AnnuncioModel', 'InsAnnuncioView', 'InsAnnuncioController');
        $this->table['sayHello'] = new Route(null, 'SayHelloView', null);
        $this->table['notFound'] = new Route(null, 'NotFoundView', null);
    } 
     
    public function getRoute($route) { 
    	$ret = null;
        
        if(empty($route))
            $ret = $this->table['home'];
        else
            $ret = $this->table[$route];
        
        if(! isset($ret))
        	$ret = $this->table['notFound'];

        return $ret;
    } 
}
?>