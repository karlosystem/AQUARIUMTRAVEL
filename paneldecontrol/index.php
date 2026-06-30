<?php
	@ob_start();
	@session_start();
	require_once("../init.php");
	
$cls_user = new cls_tbl_administrador();
$doAction = SecureGet($_GET['ToDo']);


if($doAction=='logout'){
 $cls_user->logout();
 header("Location: home.php");
 exit();
}

if( $cls_user->is_user_logged_in()) {
	header("Location: home.php");
	exit();
}

if(tep_not_null($doAction) && $doAction =='processLogin'){

$user = SecurePost($_POST['get_username']);
$user = trim($user);
$pass = SecurePost($_POST['get_password']);
$clearpass = $pass;
$pass = md5($pass);
$IsRemember = SecurePost($_POST['remember']);

if($user != '' && (ctype_alnum($user) === TRUE) && $clearpass != '')
	{
	
	$user = secure_sql($user);
	$query = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]administrador WHERE username = '".$user."' AND password = '".$pass."' AND int_status = '1'");
	$count = $GLOBALS['CONNECT_DB']->CountResult($query);
	
	  if($count == 0) 
		{
		$error = '<div class="messagelogin_error">Su nombre de usuario y la contraseña no coinciden.</div>';
		}
		elseif($count == 1) 
		{
		$cls_user->log_user_in($user, $clearpass, $IsRemember, false);
		header('Location: home.php');
		exit();
		
		}
		
	}
	else
	{
		$error = '<div class="messagelogin_error">Su nombre de usuario y la contraseña no coinciden.</div>';
	}
	
}	
?>
<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Panel de Administracion</title>

	<!--- CSS --->
	<link rel="stylesheet" href="css/style.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="css/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form name="frm_login" id="frm_login" method="post" action="index.php?ToDo=processLogin">
				<div class="login">CONTROL DE ACCESO</div>
				<div class="username-text">Usuario:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="get_username" id="get_username" />
				</div>
				<div class="password-field">
					<input type="password" name="get_password" id="get_password" placeholder="Password" />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Recordarme</label>
				<div class="forgot-usr-pwd">Olvido su <a href="#">usuario</a> o <a href="#">password</a>?</div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
		<div id="footer">
			Panel de Administracion <a href="http://azmind.com">www.aquariumtravel.com.pe</a><a href="#"></a>
		</div>
	</body>
    
<script language="javascript" type="text/javascript">
		$('#frm_login').submit(function() {
			
			if(jQuery.trim($("#get_username").val())=='')
			{
				alert('Aviso, ingrese su nombre de usuario');
				$("#get_username").focus();
				$("#get_username").select();
				return false;
			}

			if(jQuery.trim($("#get_password").val())=='')
			{
				alert('Aviso, ingrese su password');
				$("#get_password").focus();
				$("#get_password").select();
				return false;
			}

			// Everything is OK
			return true;
		});


		

</script>    
</html>
