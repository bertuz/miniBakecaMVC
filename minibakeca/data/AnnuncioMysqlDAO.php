<?php

/**
 * Implementazione dell'interfaccia AnnuncioDAO per DB mysql
*/
class AnnuncioMysqlDAO implements AnnuncioDAO {
	protected $dbConnection;

	/**
	 * @param MysqlDB $dbConnection
	*/
	public function __construct($dbConnection) {
		$this->dbConnection = $dbConnection;
	}

	/**
	 * @param int ID
	 * @return AnnuncioData|null|boolean  null in caso non esista l'ID recuperato, false nel caso siano stati riscontrati problemi con il DB
	*/
	public function findByID($ID) {
		$ret = new AnnuncioData();
		$SQL = "SELECT * FROM annuncio WHERE ID = :id";
		$stmt;
		$res;

		try {
			$stmt = $this->dbConnection->call("prepare",array($SQL));

	    	$stmt->bindParam("id", $ID);
	    	$stmt->execute();

	    	$res = $stmt->fetch(PDO::FETCH_OBJ);
    	} catch(Exception $e) {
    		return false;
    	}

    	if(!$res) {
	      return null;
	    }

    	if($stmt->rowCount() == 0)
	      return null;
    	else {
        	foreach (get_object_vars($res) as $key => $value) {
        	    $ret->$key = $value;
        	}    	
    	}

    	// converto la data in formato php (timestamp)
    	$ret->date = strtotime($ret->date);

		return $ret;
	}

	/**
	 * @param AnnuncioData $annuncio 
	 * @return boolean **true** nel caso l'update nel persistent layer sia andato a buon fine, false altrimenti
	*/	
	public function update(AnnuncioData $annuncio) {
		$res;
		$SQL = "REPLACE INTO `annuncio` (`title`,`description`,`date`,`name`,`email`,`views`,`answers`,`ID`) VALUES(:title, :description, :date, :name, :email, :views, :answers, :ID);";

		$stmt = $this->dbConnection->call("prepare", array($SQL));

		$stmt->bindParam(":ID" , $annuncio->ID);
		$stmt->bindParam(":title" , $annuncio->title);
		$stmt->bindParam(":description" , $annuncio->description);
		$stmt->bindParam(":date" , date('Y-m-d H:i:s', $annuncio->date));
		$stmt->bindParam(":name" , $annuncio->name);
		$stmt->bindParam(":email" , $annuncio->email);
		$stmt->bindParam(":views" , $annuncio->views);
		$stmt->bindParam(":answers" , $annuncio->answers);

		$res = $stmt->execute();

		if(!$res)
			return false;

		if($stmt->rowCount() == 0)
			return false;
		else
			return true;
	}

	/**
	 * Nel caso l'inserimento dell'annuncio nel persistent layer ha successo, viene aggiornato il campo ID del value object passato 
	 * @param AnnuncioData $annuncio 
	 * @return boolean **true** nel caso l'inserimento nel persistent layer sia andato a buon fine, false altrimenti
	*/	
	public function insertAnnuncio(AnnuncioData $annuncio){
		$SQL = "REPLACE INTO `annuncio` (`title`,`description`,`date`,`name`,`email`,`views`,`answers`,`ID`) VALUES(:title, :description, DEFAULT, :name, :email, DEFAULT, DEFAULT, DEFAULT);";

		$stmt = $this->dbConnection->call("prepare", array($SQL));

		$stmt->bindParam(":title" , $annuncio->title);
		$stmt->bindParam(":description" , $annuncio->description);
		$stmt->bindParam(":name" , $annuncio->name);
		$stmt->bindParam(":email" , $annuncio->email);

		$res = $stmt->execute();

		if(!$res)
			return false;

		if($stmt->rowCount() == 0)
			return false;
		
		$annuncio->ID = $this->dbConnection->call("lastInsertId", array());

		return true;
	}
}

?>