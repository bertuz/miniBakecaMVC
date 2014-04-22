<?php

/**
  * Value object rappresentante le informazioni del dominio applicativo inerenti a una serie di annunci.
  *
  * Questo oggetto è utilizzato sia dalle istanze di Model del layer MVC, che dal persistent layer
  * rappresentante le informazioni inerenti ad un insieme di annunci.
  * Questo tipo di oggetto è scambiato tra i due layer M(VC)<->data al fine di eseguire operazioni CRUD. 
 * @see \AnnunciModel
*/
class AnnunciData {
	/**
	 * @var AnnuncioData[] array di annunci
	*/
	public $annunci = array();
}

/**
 * Interfaccia DAO che definisce operazioni inerenti agli value object AnnunciData
 * @see AnnunciData AnnunciData
*/
interface AnnunciDAO {
	/**
	 * @param string $orderBy campo del value object sul quale ordinare la lista
	 * @param boolean $desc
	 * @return AnnunciData|boolean false nel caso si siano riscontrati problemi con il persistent layer 
	*/
	public function getAnnunci($orderBy, $desc);
}

?>