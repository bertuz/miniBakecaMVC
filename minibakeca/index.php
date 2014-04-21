<?php

define ('DEBUG', true);
define ('__SITE_PATH', realpath(dirname(__FILE__)));


function __autoload ($className) {
	if(preg_match('/View$/', $className))
		require_once('views/' . $className . '.php');

	else if(preg_match('/Controller$/', $className))
		require_once('controllers/'. $className . '.php');

	else if(preg_match('/Model$/', $className))
		require_once('models/'. $className . '.php');

	else if(preg_match('/Router$/', $className))
		require_once('routing/'. $className . '.php');

	else if (preg_match('/Data$/', $className))
		require_once('data/'. substr($className, 0, -4) . '.php');

	else if (preg_match('/DAO$/', $className)) {
		if(file_exists('data/'. substr($className, 0, -3) . '.php'))
			require_once('data/'. substr($className, 0, -3) . '.php');
		else
			require_once('data/'. $className . '.php');
	}
}

// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// require_once('controllers/FrontController.php');

function startFramework() {
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set ("UTC");

	if(!isset($_GET['url']))
		die("Operazione non ammessa da questo miniFramework (url mancante)");

	$cmdsArray = explode('/', $_GET['url']); 
	$cmds = array('routeName'=>$cmdsArray[0], 'action'=>(isset($cmdsArray[1]))? $cmdsArray[1] : null);
	
	$frontController = new FrontController(new Router, $cmds['routeName'], $cmds['action']);
	echo $frontController->output();
}

startFramework();


// Limitazioni dimostrative
// Il rapporto Model-View-Controller è 1:1:1 (ogni view avrà a che fare SEMPRE con UN model e UN controller)
?>
