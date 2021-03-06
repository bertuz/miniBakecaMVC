<?php

/**
 * Controller utilizzato per la pagina di inserimento di un annuncio (routing "insAnnuncio").
 * Il controller lavora a stretto contatto con la logica offerta dal model _AnnuncioModel_, unico modello accettato
 * @see \AnnuncioModel
*/
class InsAnnuncioController extends Controller {

    /**
     * Tenta il salvataggio dell'annuncio inserito operando sul modello a cui è associato
     * @see \AnnuncioModel AnnuncioModel
    */
    public function save() {
        $annuncio = new AnnuncioData();

        $annuncio->title = $_POST['title'];
        $annuncio->description = $_POST['description'];
        $annuncio->name = $_POST['name'];
        $annuncio->email = $_POST['email'];
        $annuncio->date = $_POST['date'];

        $this->model->insert($annuncio);
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