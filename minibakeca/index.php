<?php
/**
 * File di inizializzazione dell'applicativo, compresa la fase di configurazione dell'ambiente.
*/

// error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * Costante utilizzata nell'applicativo per output di debugging o codice da eseguire solo durante il debug
*/
define ('DEBUG', true);

/**
 * Definisce il path assoluto di base dell'applicativo
*/
define ('__SITE_PATH', realpath(dirname(__FILE__)));

/**
 * Politiche di autoloading adottate al posto dell'utilizzo dei nuovi namespaces.
 *
 * Al posto della nuova funzionalità (almeno per me che non utilizzo php da qualche anno)
 * degli namespaces ho utilizzato un approccio _convention over configuration_ che rispecchia molto la nuova funzionalità.
 *
 * L'organizzazione a directory dell'applicativo rispecchia dei teorici namespaces:
 * - **controllers**: contiene i controller utilizzati, compreso il front controller
 * - **models**: contiene i models dell'architettura MVC
 * - **data**: contiene gli _Object Data_ (o bean a dir si voglia) utilizzati per rappresentare i
 * dati del dominio applicativo e le classi/interfaccie DAO che consentono di comunicare con il persistent layer.
 * - **routing**: contiene i router utilizzati
 *
 * Sulla base di tale struttura __autoload carica automaticamente classi e interfacce nel seguente modo:
 * - Le classi/interfacce terminanti in "View" saranno automaticamente cercate e caricate dalla directory _views_ 
 * - Le classi/interfacce terminanti in "Controller" saranno automaticamente cercate e caricate dalla directory _controllers_
 * - Le classi/interfacce terminanti in "Model" saranno automaticamente cercate e caricate dalla directory _models_
 * - Le classi/interfacce terminanti in "Router" saranno automaticamente cercate e caricate dalla directory _routing_ 
 * - Le classi/interfacce terminanti in "Data" saranno automaticamente cercate e caricate dalla directory _data_ 
 * - Le classi/interfacce terminanti in "DAO" saranno automaticamente cercate e caricate dalla directory _data_  
*/
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

/**
 * Inizializza il framework MVC attivando il Front Controller e delegandogli la continuazione dell'esecuzione
 *
 * Il framework è inizializzato solo e soltanto nel caso l'url sia conforme al seguente standard:
 *		?url={nome-routing}      /     {nome-action}   &<parametri opzionali>
 *                 ^---parte necessaria  ^---parte opzionale
 * ovvero il parametro "?url=" seguito da un nome di routing deve _sempre_ essere definito. Pena, il 
 * mancato avvio del framework.
*/
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
?>
