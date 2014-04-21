<?php

require_once('MysqlDB.php');

class DAOFactory {
	private static $instance;
 
	public function __construct() { }

	/**
	 * Set the factory instance
	 * @param App_DaoFactory $f
	 */
	public static function setFactory(DAOFactory $f) {
		self::$instance = $f;
	}

	/**
	 * Get a factory instance. 
	 * @return DAOFactory
	 */
	public static function getFactory() {
		if(!self::$instance)
			self::$instance = new self;
 
		return self::$instance;
	}

	/**
	 * DAO
	 * Se voglio cambiare DAO basta cambiare l'implementazione qui (i.e. cambio di database)
	 * ecco il vantaggio di questo pattern di tipo factory
	 * @return AnnuncioDAO interfaccia DAO di Annuncio, null con problemi di connessione al DB
	 */
	public function getAnnuncioDAO() {
		try {
			return new AnnuncioMysqlDAO(MysqlDB::getInstance());
		}catch(Exception $e){
			return null;
		}
	}

	public function getAnnunciDAO() {
		try {
			return new AnnunciMysqlDAO(MysqlDB::getInstance());
		}catch(Exception $e){
			return null;
		}
	}	
}
?>