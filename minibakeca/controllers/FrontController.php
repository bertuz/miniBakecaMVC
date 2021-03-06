<?php

/**
 * Entry point del framework implementato
 *
 * Oggetto aggiuntivo rispetto al classico modello M-V-C, ma essenziale in applicativi web
 * a causa della natura di Internet e delle sue caratteristiche.
 *
 * FLUSSO ESECUTIVO DEL FRAMEWORK
 * ------------------------------
 *
 * Il front controller:
 * - Riceve tutte le richieste (routing + eventuali azioni)
 * - In base al router di cui dispone sceglie e istanzia la tripla _Model - View - Controller_ necessaria. Nel caso 
 * di semplice visualizzazione di pagine o di alcune azioni, è possibile che alcuni routing non necessitino di View, Model o Controller.
 * - Associa lo stesso _Model_ istanziato al _Controller_ e _View_ istanziati
 * - Fa eseguire al controller l'eventuale richiesta di azione ricevuta. Per motivi semplificativi **una sola azione per richiesta è possibile**
 * - Chiama l'operazione di generazione contenuti della _View_ istanziata attraverso il metodo output()
 * - Fine dell'esecuzione
 *
 * Nel caso il front controlelr riceva eccezioni durante le operazioni chiamate sui vari componenti MVC, istanzierà una tripla M-V-C-
 * al fine di visualizzare una pagina d'errore predefinita.
 *
 * @see \Router router
 * @see \Model model
 * @see \View view
*/
class FrontController { 
    /**
     * Il controller istanziato per la tripla M-V-C scelta
     * @type \Controller 
     */
    private $controller; 

    /**
     * La view istanziata per la tripla M-V-C scelta
     * @type \View 
     */
    private $view; 

    /**
     * Istanzia una tripla M-V-C adatta alla gestione di una eccezione sollevata durante le operazioni
     * sui model, view o controller.
     *
     * @param Exception $e l'eccezione sollevata, se esistente.
    */
    private function handleException($e = null) {
        $model = new FrameworkErrorModel($e);
        $this->view = new FrameworkErrorView(null, $model);
    }
    
    /**
     * @param \Router $router il router utilizzato per reperire la tripla M-V-C necessaria
     * @param string $routeName la posizione (routing) richiesta
     * @param string $action l'azione da eseguire richiesta sullo specifico routing dichiarato (opzionale)
     * @see \Router router
    */ 
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
     
    /**
     * Renderizza una risposta all'utente chiedendo la generazione di output alla View istanziata
     * @see \View view
    */
    public function output() {
        $this->view->output();
    }
}

?>
