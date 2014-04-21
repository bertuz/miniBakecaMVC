<?php

class ViewAnnuncioController extends Controller {

    public function view() {
    	$this->model->setID($_GET['idAnnuncio']);

        // potrei aver inserito una attributo di stato che segnalasse il problema del reperimento,
        // avviare comunque la view e visualizzare un errore, ma volevo provare la sollevazione di 
        // eccezioni dal controller. Nel caso il DB non funzioni a modo, viene visualizzata una pagina
        // standard di errore del framework. Not bad!
    	if(!$this->model->fetch())
    		throw new Exception("Problemi con il reperimento dei dati dal il database");

    	if($this->model->isFetched())
    		$this->model->reportVisualization();
    }

    public function defaultOp() {
    	$this->view();
    }
}

?>