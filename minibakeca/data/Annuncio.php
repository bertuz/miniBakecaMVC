<?php

/**
  * Value object rappresentante le informazioni del dominio applicativo inerenti a un annuncio.
  *
  * Questo oggetto è utilizzato sia dalle istanze di Model del layer MVC, che dal persistent layer
  * rappresentante le informazioni inerenti a un annuncio.
  * Questo tipo di oggetto è scambiato tra i due layer M(VC)<->data al fine di eseguire operazioni CRUD. 
 * @see \AnnuncioModel
*/
class AnnuncioData {
	/**
	* @var int $ID
	*/
	public $ID;

	/**
	* @var string $title
	*/	
	public $title;

	/**
	* @var string $description
	*/	
	public $description;

	/**
	* @var int $date data e ora in timestamp
	*/	
	public $date;
	
	/**
	* @var string $name
	*/
	public $name;
	
	/**
	* @var string $email
	*/
	public $email;
	
	/**
	* @var int $views
	*/
	public $views;
	
	/**
	* @var int $answers
	*/
	public $answers;
}

/**
 * Interfaccia DAO che definisce operazioni inerenti agli value object AnnuncioData
 * @see AnnuncioData AnnuncioData
*/
interface AnnuncioDAO {
	/**
	 * @return AnnuncioData|null|boolean **null** nel caso non sia stato trovato, **false** nel caso si siano riscontrati problemi con il persistent layer
	*/
	public function findByID($ID);

	/**
	 * @param AnnuncioData $annuncio 
	 * @return boolean **true** nel caso l'update nel persistent layer sia andato a buon fine, false altrimenti
	*/
	public function update(AnnuncioData $annuncio);

	/**
	 * @param AnnuncioData $annuncio 
	 * @return boolean **true** nel caso l'inserimento nel persistent layer sia andato a buon fine, false altrimenti
	*/	
	public function insertAnnuncio(AnnuncioData $annuncio);
}

?>