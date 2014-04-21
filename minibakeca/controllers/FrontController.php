<?php

class FrontController { 
    private $controller; 
    private $view; 

    private function handleException($e = null) {
        $model = new FrameworkErrorModel($e);
        $this->view = new FrameworkErrorView(null, $model);
        // echo "PROBLEMI!" . $e->getMessage();
    }
     
    public function __construct(Router $router, $routeName, $action = null) { 
        $model = null;

        $route = $router->getRoute($routeName); 
        $modelName = $route->getModel();
        $controllerName = $route->getController(); 
        $viewName = $route->getView(); 
         
        if(!empty($modelName))
            $model = new $modelName;

        if(!empty($controllerName))
            $this->controller = new $controllerName($model); 

        $this->view = new $viewName($routeName, $model); 

        if(isset($this->controller)) {
            try {
                if(empty($action))
                    $this->controller->defaultOp();
                else { 
                    if(! method_exists($this->controller, $action))
                        throw new Exception("controller $controllerName - questa azione non esiste: " . $action);

                    $this->controller->{$action}();  
                }
            }catch(Exception $e) {
                $this->handleException($e);
            }   
        } 
    } 
     
    public function output() {
        $this->view->output();
    }
}

?>
