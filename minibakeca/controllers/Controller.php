<?php

/**
 * Classe padre di tutti i controller implementati
 *
 * Il controller, per scelta architetturale, è stato definito come quel tipo di oggetto adibito
 * **adibito solo e soltanto ad eseguire operazioni sul modello** della tripla M-V-C istanziata, in base all'azione richiesta
 * dall'utente. Nel caso nessuna azione sia specificata dall'utente, verrà eseguita una operazione predefinita,
 * (che può essere semplicemente lasciata come definita in questa classe, ossia una _no-op_ function).
 *
 * Molti framework (incluso JSF) sviluppano architetture MVC nelle quali i Controller hanno il compito di 
 * istanziare le view e i model più opportuni all'azione da compere. Sebbene questa non sia una pratica cattiva,
 * ma anzi necessaria in contesti di sviluppo reali, diverge dal pattern MVC originale così come era stato pensato,
 * nel quale il compito del controller è solo quello di chiamare delle operazioni sul modello in base a degli eventi
 * avvenuti sulla view.
 *
 *
 * Le azioni di cui si fa carico ciascun Controller sono definite per mezzo di nuovi metodi implementati,
 * le quali sono chiamate dal _front controller_,
 * mentre questa classe padre definisce semplicemente una no-op action di default, la quale può essere
 * oggetto di _override_ da parte delle classi figlie.
 * @see \FrontController front controller
*/
Class Controller {

	/**
	 * Il modello associato al controller.
	 * @type Model
	*/
	protected $model;

	/**
	 * @param Model $model modello associato al Controller
	*/
	public function __construct(Model $model) { 
		$this->model = $model;
    }

    /**
     * No-op. Funzione eseguita dal FrontController nel caso nessuna azione sia stata specificata nell'url di richiesta.
     * Le classi figlie possono eseguire un override al fine di poter eseguire qualsiasi operazione voluta.
    */
    public function defaultOp() { }	
}

?>
