<?php

require_once(__SITE_PATH . '/data/DAOFactory.php');

/**
 * Modello del layer MVC
 *
 * I modelli utilizzati in questo framework incorporano **tutte** le logiche di business logic dell'applicazione.
 * A fini semplificativi, e per attenersi quanto più possibile al pattern MVC originale,
 *  un solo Model è assegnato ad ogni View e Controller, mantenendo un rapporto 1:1:1 MVC (si veda documentazione del FrontController).
 *
 * Per scelta personale (e per amore di modularizzazione e flessibilità) i _Model_ del layer MVC  **non** implementano nessuna logica di persistenza 
 * dei dati, bensì utilizzano le potenzialità del data layer implementato tramite la logica dei DAO.
 * Per comunicare con gli oggetti di tale layer, i model utilizzano i value object implementati nel data layer, i quali inoltre permettono di rappresentante le informazioni del dominio applicativo del Model in questione.
 * Così facendo le _View_ associate al _Model_ potranno comodamente reperire tutte le informazioni necessarie da visualizzare sempre tramite lo stesso oggetto.
*/
abstract class Model {
    /**
     * @var mixed value object che rappresenta il dominio in cui il Model opera.
     * questa proprietà è utilizzata per mantenere oggetti che descrivono l'elemento del dominico applicativo sul quale questo Model opera (es: _AnnuncioData_ _AnnunciData_ ecc)
    */
	protected $data;

    /**
     * @var OperationData rappresenta l'ultima operazione chiamata sul model (solitamente dai controller ai quali è  associato il model).
     * Nel caso avvengano più operazioni, solo l'ultima è rappresentata (possibile miglioramento).
     * Per maggiori informazioni si faccia riferimento alla documentazione di OperationData
     * @see OperationData
    */
    protected $operation;
    
    /**
     * @return boolean indica se il modello ha già un value object sul quale operare 
    */
    public function isFetched() {
        return !is_null($this->data);
    }


    /**
     * @return OperationData restituisce l'ultima operazione chiamata sul model (solitamente dai controller ai quali è  associato il model).
    */
    public function getOperationData() {
        if(!is_null($this->operation))
            return clone $this->operation;
    }

    /**
     * @return mixed value object che rappresenta il dominio in cui il Model opera.
     * Il value object restituito, nel caso sia clonabile, è una copia clonata del value object.
    */
    public function getData() {
        $reflection;

        if(!is_null($this->data)) {
            if(method_exists($this->data, "__clone")) {
                $reflection = new ReflectionMethod($this->data, "__clone");
                
                if(! $reflection->isPublic())
                    return $this->data;
            }
            
            return clone $this->data;
        }
        else
            return null;
    }
}

?>