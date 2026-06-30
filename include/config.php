<?php

$GLOBALS['CONFIG_DB']["dbType"] = "mysql";
$GLOBALS['CONFIG_DB']["dbEncoding"] = "UTF8";
$GLOBALS['CONFIG_DB']["dbServer"] = "localhost";
$GLOBALS['CONFIG_DB']["dbUser"] = "root";
$GLOBALS['CONFIG_DB']["dbPass"] = "";
$GLOBALS['CONFIG_DB']["dbDatabase"] = "aquarium";
$GLOBALS['CONFIG_DB']["tablePrefix"] = "tbl_";
$GLOBALS['CONFIG_DB']["CharacterSet"] = "UTF-8";
$GLOBALS['CONFIG_DB']["MetaKeywords"] = "";
$GLOBALS['CONFIG_DB']["MetaDesc"] = "";

// Cookie Settings
define('COOKIE_SUFX', md5(_URL)); 
define('COOKIE_PATH', preg_replace('|https?://[^/]+|i', '', _URL.'/' ));
define('COOKIE_NAME', 'phpcts_'.COOKIE_SUFX);
define('COOKIE_KEY', 'phpcts_key_'.COOKIE_SUFX);
define('COOKIE_TIME', 864000);		//	10 days : 60(sec)*60(min)*24(hrs)*10(days)


if(_SEOMOD == 1) 
	define('_FEXT', 'html');
else
	define('_FEXT', 'php');

?>
