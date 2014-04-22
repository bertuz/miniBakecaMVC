<?php

require_once(__SITE_PATH . "/models/Model.php");

/**
 * Modello utilizzato nella gestione e rappresentazione all'utente degli errori interni al framework
*/
class FrameworkErrorModel extends Model { 
	
	/**
	 * @param Exception $exception l'eccezione che non ha permesso il normale flusso esecutivo del framework  (es: esecuzione di azioni non riconosciute dai Controller scelti dal frontcontroller)
	*/     
    public function __construct($exception) {
        $this->data = $exception;
    }
} 

?>
