<?php

require_once(__SITE_PATH . '/lib/templateEngine.php');

/**
 * View del layer MVC
 *
 * In questo framework le View renderizzano una risposta all'utente ottenendo le informazioni dal modello a cui sono state associate, il quale
 * è stato aggiornato e modificato dalle operazioni invocate precedentemente dal Controller.
 * 
 * La View può anche non avvalersi di un Model nel caso renderizzi pagine statiche.
*/
abstract class View {
	/**
	 * @var String
	*/
	protected $route;

	/**
	 * @var Model
	*/	
	protected $model;

	/**
	 * @param String $route path richiesto dall'utente
	 * @param Model|null $model
	*/
	abstract public function __construct($route, Model $model = null);

	/**
	 * Renderizza una risposta all'utente (es: pagina HTML)
	*/
	abstract public function output();
}

?>