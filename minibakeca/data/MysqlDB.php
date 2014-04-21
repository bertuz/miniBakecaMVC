<?php

class MysqlDB {
  static protected $instance;

   /**
    * @var PDO
    */
  protected $connection;

 	protected function __construct($db_host, $db_user, $db_pass, $db_name) {
 		$this->connection = new PDO("mysql:host=" . $db_host, $db_user, $db_pass);

    if (! $this->connection->query("use $db_name"))
      throw new Exception("Accesso al DB non avvenuto.");
 	}

 	public static function getInstance() {
   	if(!self::$instance) {
 	   	require(__SITE_PATH . '/config/config.php');
    	self::$instance = new self($db_host, $db_user, $db_password, $db_name);
   	}

		return self::$instance;
	}

 	// proxy call
 	public function call($method, $args) {
   	$callable = array($this->connection, $method);
   	if(is_callable($callable)) {			
      $ret = call_user_func_array($callable, $args);

      return $ret;
		}
	}
}

?>