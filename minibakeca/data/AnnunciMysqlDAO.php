<?php

/**
 * Implementazione dell'interfaccia AnnunciDAO per DB mysql
*/
class AnnunciMysqlDAO implements AnnunciDAO {
	protected $dbConnection;

	/**
	 * @param MysqlDB $dbConnection
	*/
	public function __construct($dbConnection) {
		$this->dbConnection = $dbConnection;
	}

	/**
	 * @param String $orderBy campo su cui ordinare la lista
	 * @param $desc true/false per ordinare in senso contrario o meno la lista
	 * @return AnnunciData|boolean  false nel caso siano stati riscontrati problemi con il DB
	*/
	public function getAnnunci($orderBy, $desc) {
		$ret = new AnnunciData();
		$res;
		$dir = ($desc == true)? "DESC" : "ASC";

		$SQL = "SELECT * FROM annuncio ORDER BY " . $orderBy . " " . $dir;

		try {
			$stmt = $this->dbConnection->call("prepare",array($SQL));
			
	    	// $stmt->bindParam(":orderBy", $orderBy);
	    	$stmt->execute();

	    	$res = $stmt->fetchAll(PDO::FETCH_OBJ);

	    	if(!$res)
		      return false;

		    foreach($res as $annuncioDB) {
		    	$newAnnuncio = new AnnuncioData();

	        	foreach (get_object_vars($annuncioDB) as $key => $value) {
	        	    $newAnnuncio->$key = $value;
	        	}
	        	
		    	// converto la data in formato php (timestamp)
		    	$newAnnuncio->date = strtotime($newAnnuncio->date);

		    	array_push($ret->annunci, $newAnnuncio);
        	}

			return $ret;	    	
    	}catch(Exception $e) {
    		return false;
    	}		
	}
}

?>