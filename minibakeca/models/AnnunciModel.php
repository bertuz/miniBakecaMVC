<?php

/**
 * Modello utilizato per insiemi di annunci.
 * Il value object utilizzato per rappresentare gli annunci è di tipo _AnnunciData_
 * @see AnnunciData
*/
class AnnunciModel extends Model { 
    /**
     * @var String campo del value Object attraverso il quale ordinare la lista da recuperare
    */
    private $orderElem = "date";

    /**
     * @var boolean indica se ordinare la lista recuperata in modo ascendente o discendente
    */
    private $desc = true;
     
    public function __construct() { }

    /**
     * Imposta l'ordine con il quale verranno recuperati gli annunci
     * @param String $orderElem campo del value Object attraverso il quale ordinare la lista da recuperare
     * @param boolean indica se ordinare la lista recuperata in modo ascendente o discendente
    */
    public function setOrder($orderElem, $desc = true) {
        if(property_exists(AnnuncioData, $orderElem))
            $this->orderElem = $orderElem;
        else
            return false;

    	$this->desc = $desc;

        return true;
    }

    /**
     * @return String
    */
    public function getOrderElem() {
        return $this->orderElem;
    }

    /**
     * @return boolean
    */
    public function getOrderDesc() {
        return $this->desc;
    }

    /*
     * Recupera tutti gli annunci presenti in base alle impostazioni d'ordine impostate attraverso setOrder()
     *
     * - L'operazione popolerà l'attributo _$data_ con un Value Object di tipo _AnnunciData_
     * - L'opeazione descriverà l'esito dell'operazione popolando l'attributo _$operation_ con un Value Object di tipo _OperationData_
     *
     * @see $data i dati recuperati
     * @return boolean **false** se la lista è vuota o l'operazione di recupero non è avvenuta correttamente, **true** altrimenti
    */
    public function fetch() {
    	$annunciDao = DAOFactory::getFactory()->getAnnunciDAO();

        $this->operation = new OperationData("fetch");

        if(is_null($annunciDao)) {
            $this->data = null;
            $this->operation->success = false;
            return false;
        }

    	$this->data = $annunciDao->getAnnunci($this->orderElem, $this->desc);

        if($this->data === false) {
            $this->data = null;
            $this->operation->success = false;
            return false;
        }

        $this->operation->success = true;
        return true;
    }
} 

?>
