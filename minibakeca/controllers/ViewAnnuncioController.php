<?php

/**
 * Controller utilizzato per azioni inerenti a un specifico annuncio.
 * Il controller lavora a stretto contatto con la logica offerta dal model _AnnuncioModel_, unico modello accettato
 */
class ViewAnnuncioController extends Controller {
    
    /**
     * Reperisce un annuncio in base a un id specifico, passato tramite il parametro $_GET['idAnnuncio']
    */
    protected function fetchAnnuncio() {
    	$this->model->setID($_GET['idAnnuncio']);
        
        // potrei aver inserito una attributo di stato che segnalasse il problema del reperimento,
        // avviare comunque la view e visualizzare un errore, ma volevo provare la sollevazione di 
        // eccezioni dal controller. Nel caso il DB non funzioni a modo, viene visualizzata una pagina
        // standard di errore del framework. Not bad!
        if(!$this->model->fetch())
            throw new Exception("Problemi con il reperimento dei dati dal il database");
    }

    /**
     * Chiama fetchAnnuncio e nel caso l'annuncio sia reperito con successo viene aggiornato il suo numero
     * di visualizzazioni
     * @see fetchAnnuncio() fetchAnnuncio
     * @see \AnnuncioModel
    */
    public function view() {
        $this->fetchAnnuncio();

    	if($this->model->isFetched())
    		$this->model->reportVisualization();
    }

    /**
     * Reperisce l'annuncio e chiama la logica sul model adibita alla segnalazione di interesse dell'annuncio
     * @see \AnnuncioModel AnnuncioModel
    */
    public function interested() {
        $interesse;

        $this->fetchAnnuncio();

        if($this->model->isFetched()) {
            $interesse = new InteresseData();
            $interesse->email = $_POST['email'];

            // Questo poteva essere fatto anche nella logica del controller anziché nel modello, ma ho preferito mantenerlo il più legger possibile
            // imitando il più possibile il pattern MVC originale (! è un progettino didattico-dimostrativo!)
            $this->model->sendInterest($interesse);
        }
    }

    /**
     * Reperisce l'annuncio nel caso nessuna azione sia definita
     * @see view() view
    */
    public function defaultOp() {
    	$this->view();
    }

    /**
     *
     * @param AnnuncioModel $model modello associato al Controller
     * @override 
    */
    public function __construct(AnnuncioModel $model) { 
        $this->model = $model;
    }    
}

?>