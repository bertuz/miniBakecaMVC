<?php

/**
 * Modello utilizato per un annuncio.
 * Il value object utilizzato per rappresentare gli annunci è di tipo _AnnuncioData_
 * @see AnnuncioData
*/
class AnnuncioModel extends Model { 
    /**
     * @var int ID del modello da recuperare
    */
    private $ID;

    /**
     * @var DataInteresse value object utilizzato per compeltare l'operazione di interesse verso l'annuncio (vedi sendInterest)
     * @see sendInterest()
    */
    private $dataInteresse;
     
    public function __construct() { }


    /**
     * @param int $ID id dell'annuncio da recuperare
    */
    public function setID($ID) {
    	$this->ID = $ID;
    }

    /**
     * @return String email di chi ha espresso il proprio interesse all'annuncio
    */
    public function getDataInteresse() {
        return clone($this->dataInteresse);
    }

    /**
     * Recupera l'annuncio in base all'id impostato attraverso setID()
     *
     * - L'operazione popolerà l'attributo _$data_ con un Value Object di tipo _AnnuncioData_
     * - L'opeazione descriverà l'esito dell'operazione popolando l'attributo _$operation_ con un Value Object di tipo _OperationData_
     *
     * @see $data l'annucnio recuperato
     * @return boolean **false** se l'operazione di recupero non è avvenuta correttamente, **true** altrimenti
    */    
    public function fetch() {
        $this->operation = new OperationData("fetch");

    	$annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();

        if(is_null($annuncioDao))
            return false;

        if(is_numeric($this->ID))
    	   $this->data = $annuncioDao->findByID($this->ID);
        else
            $this->data = null;

        
        if($this->data === false)
            return false;

        $this->operation->success = true;
        return true;
    }

    /**
     * Incrementa il numero di visualizzazioni dell'annuncio e lo salva
     *
     * - L'operazione aggiornerà l'attributo _$data_ con un Value Object di tipo _AnnuncioData_
     * - L'opeazione descriverà l'esito dell'operazione popolando l'attributo _$operation_ con un Value Object di tipo _OperationData_
     *
     * @see $data l'annuncio
     * @return boolean **false** se l'operazione è avvenuta correttamente, **true** altrimenti
    */        
    public function reportVisualization() {
        $this->operation = new OperationData("reportVisualization");

        $annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();

        if(isset($this->data)) {
            $this->data->views = $this->data->views + 1;
            $annuncioDao->update($this->data);
        }

        $this->operation->success = true;
        return true;
    }

    private function sendMailInterest(){
         $to = $this->data->email;
         $subject = "Qualcuno ha espresso interesse per il tuo annuncio!";
         $body = "Ciao,\n\nil tuo annuncio '" . $this->data->title . "' ha ricevuto un interessa dal seguente indirizzo mail " . $this->dataInteresse->email . ". Contattalo per maggiori informazioni!\nUn saluto, \n minibakeca.";

        if (!mail($to, $subject, $body))
            return false;
           
        return true;
    }

    /**
     * Invia una mail all'autore dell'annuncio con i riferimenti relativi all'interessato, incrementa il numero di persone interessate all'annuncio e lo salva in modo permanente
     *
     * - L'operazione aggiornerà l'attributo _$data_ con un Value Object di tipo _AnnuncioData_
     * - L'opeazione descriverà l'esito dell'operazione popolando l'attributo _$operation_ con un Value Object di tipo _OperationData_
     * 
     * @param InteresseData $interesse nel caso i campi del value object InteresseData non siano conformi, l'operazione sarà annullata e le informazioni relative ai campi saranno disponibili nella property _$operation_, opportunamente aggiornata
     * @return boolean **false** se l'operazione è avvenuta correttamente, **true** altrimenti
     * @see $data l'annuncio
    */      
    public function sendInterest($interesse) {
        $retErrs = array();
        $annuncioDao;

        $this->operation = new OperationData("sendInterest");
        $this->dataInteresse = $interesse;

        if(empty($interesse->email)) 
            $retErrs['email'] = "Email obbligatoria";
        else if(!filter_var($interesse->email, FILTER_VALIDATE_EMAIL))
            $retErrs['email'] = "Formato email errato";

        if(sizeof($retErrs) > 0) {
            $this->operation->success = false;
            $this->operation->errors = $retErrs;
            return false;
        }

        // Aggiorno il numero di interessi
        $this->data->answers++;

        $annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();
        $annuncioDao->update($this->data);

        
        if (!$this->sendMailInterest()) {
            $this->operation->success = false;
            $this->operation->errors = null;
            return false;
        }

        $this->operation->success = true;
        return true;
    }


    /**
     * Inserisce un nuovo annuncio salvandolo in modo permanente
     *
     * - L'operazione aggiornerà l'attributo _$data_ con il Value Object di tipo _AnnuncioData_ passato
     * - L'opeazione descriverà l'esito dell'operazione popolando l'attributo _$operation_ con un Value Object di tipo _OperationData_
     * 
     * @param AnnuncioData $annuncio nel caso i campi del value object _AnnuncioData_ non siano conformi, l'operazione sarà annullata e le informazioni relative ai campi saranno disponibili nella property _$operation_, opportunamente aggiornata.
     * @see $data l'annuncio
     * @return Array|boolean **true** se l'inserimento è avvenuto correttamente, **false** nel caso i campi dell'annuncio non siano conformi oppure l'inserimento non sia avvenuto con successo
    */
    public function insert(AnnuncioData $annuncio) {
        $retErrs = array();
        $annuncioDao;
        $insRet;

        $this->operation = new OperationData("sendInterest");

        $this->data = $annuncio;

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
            $this->operation->errors = $retErrs;
            return false;
        }

        $annuncioDao = DAOFactory::getFactory()->getAnnuncioDAO();
        $insRet = $annuncioDao->insertAnnuncio($annuncio);
        
        $this->operation->success = true;
        return $insRet;
    }
} 

?>
