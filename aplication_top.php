<?php
  ob_start();
  session_start();

 define('PAGE_PARSE_START_TIME', microtime());
 ini_set('error_reporting', E_ALL);
 ini_set('display_errors', '1');
 
 
 ini_set('register_globals','Off');
 
 if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }

 /*$PHP_SELF = (isset($HTTP_SERVER_VARS['PHP_SELF']) ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_SERVER_VARS['SCRIPT_NAME']);*/
 
 
 /*$_SERVER['PHP_SELF'] = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);*/
 
 $PHP_SELF = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
 
 

 
 
/*if (!ini_get('register_globals')) {
    $superglobals = array($_SERVER, $_ENV,
        $_FILES, $_COOKIE, $_POST, $_GET,$_REQUEST);
    if (isset($_SESSION)) {
        array_unshift($superglobals, $_SESSION);
    }
    foreach ($superglobals as $superglobal) {
        extract($superglobal, EXTR_SKIP);
    }
    ini_set('register_globals', true);
}
*/ 
 



 #Idioma por defecto ...

require_once("init.php");	
// comprobar para ver si php implementado funciones de administración de sesiones - si no, incluyen php3/php4 sesión de clase compatibles
   include('include/sessions.php');
 
  //establecer los parámetros de la cookie de sesión
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, DIR_WS_ADMIN);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', DIR_WS_ADMIN);
  }
  
  
  if ( (PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals') == false) ) {
    extract($_SESSION, EXTR_OVERWRITE+EXTR_REFS);
  }
   
if (!ini_get('register_globals')) {
	$types_to_register = array('GET','POST','COOKIE','SESSION','SERVER','REQUEST');
		
		if (isset($_SESSION)) {
          array_unshift($types_to_register, $_SESSION);
        }
		foreach ($types_to_register as $type) {
		if (@count(${'HTTP_' . $type . '_VARS'}) > 0) {
		extract(${'HTTP_' . $type . '_VARS'}, EXTR_OVERWRITE);
		  } 
		 }
 }
 
 
  #SESSION COUNTRY - ESTADO - CIUDAD
  #        PERÚ    - AREQUIPA - CAYLLOMA
  #
  #DEFAULT_COUNTRY -> PE

  
  require_once('include/class/cls_tbl_language.php');
  $lng = new language();

    // SET LANGUAGE
  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    //include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();
	$language_dir = $lng->language['directory'];
    $languages_id = $lng->language['id'];
	$languages_code = $lng->language['code'];
  }
  
  
  if (!tep_session_is_registered('language_dir') || isset($_GET['language']) ) {
    
	if (!tep_session_is_registered('language_dir')) {
      tep_session_register('language_dir');
      tep_session_register('languages_id');
	  tep_session_register('languages_code');
    }
	
    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
	  $lng->set_language($_GET['language']);
    }
	else {
      $lng->get_browser_language();
    }
    
    $language_dir = $lng->language['directory'];
    $languages_id = $lng->language['id'];
	$languages_code = $lng->language['code'];
	
	//print $language_dir."----";
	//exit();
  }
  
  $language_dir = "espanol";
  require_once(DIR_WS_LANGUAGES . $language_dir .'.php');
  
  $current_page = basename($PHP_SELF);

  if (file_exists(DIR_WS_LANGUAGES . $language_dir . '/' . $current_page)) {
   require_once(DIR_WS_LANGUAGES . $language_dir . '/' . $current_page);
  }
  
?>