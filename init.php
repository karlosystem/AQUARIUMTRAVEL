<?php
    
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set("track_errors","1");

	@set_time_limit(0);
	@ob_start();
	ini_set("magic_quotes_runtime", "off");
	
	require_once("include/constants.php");
	require_once("include/config.php");
    require_once("include/function.php");
	noCache();
	
	if (get_magic_quotes_gpc()) {
		$_POST		= stripslashes_deep($_POST);
		$_GET		= stripslashes_deep($_GET);
		$_COOKIE	= stripslashes_deep($_COOKIE);
		$_REQUEST	= stripslashes_deep($_REQUEST);
    }
	
require_once('include/class/database/mysql.php');
STSSetEncoding(GetConfig('CharacterSet'));

$db_type = 'MySQLDb';
$db = new $db_type();

$connection = $db->Connect(GetConfig("dbServer"), GetConfig("dbUser"), GetConfig("dbPass"), GetConfig("dbDatabase"));
$db->TablePrefix = GetConfig("tablePrefix");

if (!$connection) {
	list($error, $level) = $db->GetError();
			// If we're in the control panel, we can show the actual message
	//if(defined("CTS_ADMIN")) {
				$error = str_replace(GetConfig('dbServer'), "[database server]", $error);
				$error = str_replace(GetConfig('dbUser'), "[database user]", $error);
				$error = str_replace(GetConfig('dbPass'), "[database pass]", $error);
				$error = str_replace(GetConfig('dbDatabase'), "[database]", $error);

			print "<div style=\"font-size:12px;font-family:Arial;border: 1px solid #D8000C;margin: 10px 0px;padding:15px 10px 15px 50px;color: #D6010E;background-color: #FFBABA;\">";
			print "<strong>No es posible conectarse a la Base de Datos: </strong>".$error;
			print "</div>";
			exit;
		//}
}

$GLOBALS['CONNECT_DB'] = &$db;
if(GetConfig('dbEncoding') != '') {
$GLOBALS['CONNECT_DB']->Query("SET NAMES ".GetConfig('dbEncoding'));
}

#Configuración General :::
#SQL Config Table
$QueryConfig = $GLOBALS['CONNECT_DB']->Query("SELECT configuration_key, configuration_value FROM [|PREFIX|]configuration ");
while($FetchConf = $GLOBALS['CONNECT_DB']->Fetch($QueryConfig)){
 define($FetchConf['configuration_key'],$FetchConf['configuration_value']);
}

require_once("loadclass.php");
?>