<?php

class AnnunciModel extends Model { 
    private $orderElem = "date";
    private $desc = true;
     
    public function __construct() { }

    public function setOrder($orderElem, $desc = true) {
        if(property_exists(AnnuncioData, $orderElem))
            $this->orderElem = $orderElem;
        else
            return false;

    	$this->desc = $desc;

        return true;
    }

    public function getOrderElem() {
        return $this->orderElem;
    }

    public function getOrderDesc() {
        return $this->desc;
    }

    public function fetch() {
    	$annunciDao = DAOFactory::getFactory()->getAnnunciDAO();

        if(is_null($annunciDao)) {
            $this->data = null;
            return false;
        }

    	$this->data = $annunciDao->getAnnunci($this->orderElem, $this->desc);

        if($this->data === false) {
            $this->data = null;
            return false;
        }

        return true;
    }
} 

?>
