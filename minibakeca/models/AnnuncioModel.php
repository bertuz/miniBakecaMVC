<?php

class AnnuncioModel extends Model { 
    private $ID;
    private $validationMessages;
     
    public function __construct() { }

    public function setID($ID) {
    	$this->ID = $ID;
    }

    public function getValidationMessages() {
        return $this->validationMessages;
    }

    public function fetch() {
    	$annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();

        if(is_null($annuncioDao))
            return false;

        if(is_numeric($this->ID))
    	   $this->data = $annuncioDao->findByID($this->ID);
        else
            $this->data = null;

        
        if($this->data === false)
            return false;

        return true;
    }

    public function reportVisualization() {
        $annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();

        if(isset($this->data)) {
            $this->data->views = $this->data->views + 1;
            $annuncioDao->update($this->data);
        }
    }

    /**
     * @return true se l'inserimento è avvenuto correttamente, array asociativo "nomeattributo"=>"messaggio errore" nel caso i dati non siano conformi, false se l'inserimento non è avvenuto correttamente
    */
    public function insert(AnnuncioData $annuncio) {
        $retErrs = array();
        $annuncioDao;
        $insRet;

        $this->data = $annuncio;
        $this->validationMessages = null;

        // check dei campi
        if(!is_null($annuncio->ID))
            $retErrs['ID'] = "id non può essere impostato nel caso di inserimento";

        if(empty($annuncio->title))
            $retErrs['title'] = "Titolo obbligatorio";

        if(empty($annuncio->description))
            $retErrs['description'] = "Descrizione obbligatoria";

        if(empty($annuncio->name))
            $retErrs['name'] = "Nome obbligatorio";

        if(empty($annuncio->email))
            $retErrs['email'] = "Email obbligatoria";
        else if(!filter_var($annuncio->email, FILTER_VALIDATE_EMAIL))
            $retErrs['email'] = "Formato email errato";

        if(sizeof($retErrs) > 0) {
            $this->validationMessages = $retErrs;
            return false;
        }

        $annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();
        $insRet = $annuncioDao->insertAnnuncio($annuncio);
        
        // if($insRet)
        //     $this->data = $annuncio;

        return $insRet;
    }
} 

?>
