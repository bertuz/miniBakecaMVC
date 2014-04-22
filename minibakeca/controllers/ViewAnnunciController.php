<?php

/**
 * Controller utilizzato per il reperimento della lista di annunci
 * Il controller lavora a stretto contatto con la logica offerta dal model _AnnunciModel_, unico modello accettato
*/
class ViewAnnunciController extends Controller {

    /**
     * tenta l'operazione di fetching degli annunci
    */
    public function view() {
    	// $this->model->setID($_GET['idAnnuncio']);
        if(!$this->model->fetch())
            throw new Exception("Problemi con il reperimento dei dati dal il database");
    }

    /**
     * Come _view_, ma definisce un ordine della lista in base alla data
    */
    public function orderDate() {
        $desc = ($_GET['desc'] === "true")? true : false;
        
        $prova = $this->model->setOrder("date", $desc);

        $this->view();
    }

    /**
     * chiama una view in caso nessuna azione sia definita
     * @see \ViewAnnuncioController::view view
    */
    public function defaultOp() {
    	$this->view();
    }

    /**
     *
     * @param AnnunciModel $model modello associato al Controller
     * @override 
    */
    public function __construct(AnnunciModel $model) { 
        $this->model = $model;
    }    
}

?>