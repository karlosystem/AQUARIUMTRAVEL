<?php

class cls_tbl_administrador{ 
  
  var $pk_usuario;
  var $name; # Nombre completo del usuario;
  var $username; # Nombre de usuario;
  var $password; #Password del usuaro;
  var $email; # E-mail del usuario;
  var $reg_ip; # IP de la PC en la que se ha registrado
  var $last_sign; # Ultimo Acceso
  var $int_status; # Estado del usuario; 1<>Activo; 0 <> Inactivo;
  var $reg_date; # Fecha en la que elusuario ha sido registrado;
  
  
   function cls_tbl_administrador($id=0)
	{

	if(validar_numero($id) && $id>0)
	{
		$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]administrador WHERE pk_usuario = '".$id."' ORDER BY pk_usuario DESC");
		$fila = $GLOBALS['CONNECT_DB']->Fetch($sql);
		$this->setpk_user($fila['pk_usuario']);
		$this->setuser_name($fila['name']);
		$this->setuser_username($fila['username']);
		$this->setuser_password($fila['password']);
		$this->setuser_email($fila['email']);
		$this->setuser_regip($fila['reg_ip']);
		$this->setuser_lastsign($fila['last_signin']);
		$this->setuser_intstatus($fila['int_status']);
		$this->setuser_regdate($fila['reg_date']);
	}else{
		$this->setpk_user('');
		$this->setuser_name('');
		$this->setuser_username('');
		$this->setuser_password('');
		$this->setuser_email('');
		$this->setuser_regip('');
		$this->setuser_lastsign('');
		$this->setuser_intstatus('');
		$this->setuser_regdate('');
	}
	
	$GLOBALS['CONNECT_DB']->FreeResult($sql);

}


function setpk_user($pk_usuario){  $this->pk_usuario = $pk_usuario;}function getpk_user(){  return $this->pk_usuario; }
function setuser_name($name){  $this->name = $name;}function getuser_name(){  return $this->name; }
function setuser_username($username){  $this->username = $username;}function getuser_username(){  return $this->username; }
function setuser_password($password){  $this->password = $password;}function getuser_password(){  return $this->password; }
function setuser_email($email){  $this->email = $email;}function getuser_email(){  return $this->email; }
function setuser_regip($reg_ip){  $this->reg_ip = $reg_ip;}function getuser_regip(){  return $this->reg_ip; }
function setuser_lastsign($last_sign){  $this->last_sign = $last_sign;}function getuser_lastsign(){  return $this->last_sign; }
function setuser_intstatus($int_status){  $this->int_status = $int_status;}function getuser_intstatus(){  return $this->int_status; }
function setuser_regdate($reg_date){  $this->reg_date = $reg_date;}function getuser_regdate(){  return $this->reg_date; }


   
function remove()
{
	$sql = "DELETE FROM [|PREFIX|]administrador WHERE  pk_usuario = '".$this->getpk_user()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
}


function IsExistUser(){
$SQL = "SELECT * FROM [|PREFIX|]administrador WHERE pk_usuario='".$this->getpk_user()."' ";
$QueryExist = $GLOBALS['CONNECT_DB']->Query($SQL);
$Count = $GLOBALS['CONNECT_DB']->CountResult($QueryExist);
if($Count==0)
return false ;
else
return true ;
$GLOBALS['CONNECT_DB']->FreeResult($QueryExist);
}

function save_usuario()
{
	
	$array_user = array("name"=>$this->getuser_name(),
						"username"=>$this->getuser_username(),
						"password"=>$this->getuser_password(),
						"email"=>$this->getuser_email(),
						"reg_ip"=>$this->getuser_regip(),
						"last_signin"=>$this->getuser_lastsign(),
						"int_status"=>$this->getuser_intstatus(),
						"reg_date"=>$this->getuser_regdate()
						);
	insert($array_user,"[|PREFIX|]administrador");
	$id = $GLOBALS['CONNECT_DB']->LastId();
    $this->setpk_user($id);

}


function modify_usuario()
{	
	$array_user = array("name"=>$this->getuser_name(),
						"username"=>$this->getuser_username(),
						"password"=>$this->getuser_password(),
						"email"=>$this->getuser_email(),
						"reg_ip"=>$this->getuser_regip(),
						"last_signin"=>$this->getuser_lastsign(),
						"int_status"=>$this->getuser_intstatus(),
						"reg_date"=>$this->getuser_regdate()
						);
   $array_where = array("pk_usuario"=>$this->getpk_user());
   update($array_user,"[|PREFIX|]administrador",$array_where);

}

function lista($sql="")
{
	if(!tep_not_null($sql)){
	$sql = $GLOBALS['CONNECT_DB']->Query("SELECT * FROM [|PREFIX|]administrador ORDER BY pk_usuario DESC");
	}else{
	$sql = $GLOBALS['CONNECT_DB']->Query($sql);
	}
	
	$i=0;
	while($Fetch = $GLOBALS['CONNECT_DB']->Fetch($sql))
	{
		$arreglo[$i]['pk_usuario'] = $Fetch['pk_usuario'];
		$arreglo[$i]['name'] = $Fetch['name'];
		$arreglo[$i]['username'] = $Fetch['username'];
		$arreglo[$i]['password'] = $Fetch['password'];
		$arreglo[$i]['email'] = $Fetch['email'];
		$arreglo[$i]['reg_ip'] = $Fetch['reg_ip'];
		$arreglo[$i]['last_signin'] = $Fetch['last_signin'];
		$arreglo[$i]['int_status'] = $Fetch['int_status'];
		$arreglo[$i]['reg_date'] = $Fetch['reg_date'];
		
	 $i++;
	}
	
	$GLOBALS['CONNECT_DB']->FreeResult($sql);
	return $arreglo;
}


 function estado($estado)
{	$est=$estado;
	if($estado=="")
	{
	$estado=($this->getuser_intstatus()=="1")?"0":"1";
	}

	$sql = "UPDATE [|PREFIX|]administrador
				SET int_status='".$estado."'
			WHERE pk_usuario = '".$this->getpk_user()."'";
	$GLOBALS['CONNECT_DB']->Query($sql);
	if($est=="")
	{
		$icono = "ico_estado".$estado.".gif";
		print "<a href='javascript:modifystatus(".$this->getpk_user().")'>
 			  <img src='"._URL."/images/icons/".$icono."' border='0'></a>";
	}
}

 
   
   function lookup_cookies(){
	
		if( empty($_COOKIE[COOKIE_NAME]) || empty($_COOKIE[COOKIE_KEY]) )
			return 0;
	return 1;
   }
   
   function lookup_sessions(){

		if( empty($_SESSION[COOKIE_NAME]) || empty($_SESSION[COOKIE_KEY]))
			return 0;
	return 1;
  }
  
  function is_user_logged_in(){
    
	if( $this->lookup_cookies() ){
		
		if( !$this->check_user_login_info($_COOKIE[COOKIE_NAME], $_COOKIE[COOKIE_KEY]) )
		{	
			logout();
			return 0;
		}
		else {
			if( !$this->lookup_sessions()){

				#session_register(COOKIE_NAME, COOKIE_KEY); obsoleto
				$_SESSION[COOKIE_NAME] = $_COOKIE[COOKIE_NAME];
				$_SESSION[COOKIE_KEY] = $_COOKIE[COOKIE_KEY];
			}
			elseif( strcmp($_COOKIE[COOKIE_NAME], $_SESSION[COOKIE_NAME])  || strcmp($_COOKIE[COOKIE_KEY], $_SESSION[COOKIE_KEY]) ) 
				return 0;
		  return 1;
		}
	}		
		if($this->lookup_sessions() ){
			if( !$this->check_user_login_info($_SESSION[COOKIE_NAME], $_SESSION[COOKIE_KEY]) )
				return 0;
		return 1;
		}
	return 0;
	}
	
	
	
	
	function check_user_login_info($username, $user_key){
       
		if( strlen($user_key) != 32 )
			return 0; 
	
		$buffer = str_replace(" ", "", $username);
		if( !ctype_alnum($buffer) )
			return 0;
		
		$sql = "SELECT username, password FROM [|PREFIX|]administrador WHERE username= '".$username."'";
		
		$result = $GLOBALS['CONNECT_DB']->Query($sql);
		if( !$result ) 
			return 0;
		$rows = $GLOBALS['CONNECT_DB']->CountResult($result) ;
		if( $rows == 0 )
			return 0;
		$row = $GLOBALS['CONNECT_DB']->Fetch($result);
		$GLOBALS['CONNECT_DB']->FreeResult($result);
		
		// check if passwords match
		if( strcmp($user_key, md5($row['password'])) )
			return 0;
	return 1;
	}
	
	
	
	function confirm_login( $username, $pass, $hashed = false ){

		$buffer = str_replace(" ", "", $username);
		if( !ctype_alnum($buffer) )
			return 0;
	
		$sql = "SELECT pk_usuario, username, password, int_status FROM [|PREFIX|]administrador WHERE username= '".$username."'";
		$result = $GLOBALS['CONNECT_DB']->Query($sql);
		if( !$result ) 
			return 0;
		$rows = $GLOBALS['CONNECT_DB']->CountResult($result) ;
		if( $rows == 0 )
			return 0;
		$row = $GLOBALS['CONNECT_DB']->Fetch($result);
		$GLOBALS['CONNECT_DB']->FreeResult($result);
		$password = ($hashed) ? $pass : md5($pass);	
		
		// check if passwords match
		if( strcmp($password, $row['password']) ) 
			return 0;
		
	return 1;
	}
	
	
	
	function is_user_account_active($user_id, $username)
		{
	if($user_id != '')
	{
		$sql = "SELECT int_status FROM [|PREFIX|]administrador WHERE pk_usuario = '".$user_id."'";
	}
	elseif($username != '')
	{
		$sql = "SELECT int_status FROM [|PREFIX|]administrador WHERE username = '".secure_sql($username)."'";
	}
	$result = $GLOBALS['CONNECT_DB']->Query($sql);
	$row = $GLOBALS['CONNECT_DB']->Fetch($result);
	$GLOBALS['CONNECT_DB']->FreeResult($result);
	
	if( $row['int_status'] == U_INACTIVE )
		return 0;
		return 1;
	}
	
	
	
	function log_user_in($username, $pass, $remember = false, $hashed = false){

	if(!$this->confirm_login($username, $pass, false))
		return 0;
	$key = ($hashed) ? md5($pass) : md5(md5($pass));
	
	#session_register(COOKIE_NAME, COOKIE_KEY);
	session_regenerate_id(true);
	
	$_SESSION[COOKIE_NAME] = $username;
	$_SESSION[COOKIE_KEY] = $key;
	#if($remember == 1){

		setcookie(COOKIE_NAME, $username, time()+COOKIE_TIME, COOKIE_PATH);
		setcookie(COOKIE_KEY, $key, time()+COOKIE_TIME, COOKIE_PATH);
	#}

		$sql = "UPDATE [|PREFIX|]administrador SET last_signin  = '".time()."' WHERE username= '".$username."'";
		$result = $GLOBALS['CONNECT_DB']->Query($sql);
		$GLOBALS['CONNECT_DB']->FreeResult($result);
	return 1;
	}
  
  
  
  function logout(){

	setcookie(COOKIE_NAME, ' ', time()-COOKIE_TIME, COOKIE_PATH);
	setcookie(COOKIE_KEY, ' ',  time()-COOKIE_TIME, COOKIE_PATH);

	$_SESSION = array();
	@session_destroy();
	return 1;
}


	function get_last_referer() {
	
		if( !empty($_SERVER['HTTP_REFERER']))
		{
			$referer = strip_tags($_SERVER['HTTP_REFERER']);
			$referer = str_replace( array("<",">", "'", '"'), "", $referer);
			$referer = preg_replace('|https?://[^/]+|i', '', $referer );
			return $referer;
		}
	
	return false;
	}



function fetch_user_info($username){

	$buffer = str_replace(" ", "", $username);
	if( !ctype_alnum($buffer) )
	return 0;
	
		
	$user = array();
	$sql = "SELECT * FROM [|PREFIX|]administrador WHERE username= '".$username."'";
	$result = $GLOBALS['CONNECT_DB']->Query($sql);
	if( !$result ) 
		return false;
	$count = $GLOBALS['CONNECT_DB']->CountResult($result);
	if( !$count )
		return false;
	
	$row = $GLOBALS['CONNECT_DB']->Fetch($result);
	$GLOBALS['CONNECT_DB']->FreeResult($result);
	foreach($row as $k => $v){
		$user[$k] = stripslashes($v);
	}
	
	//$user['pk_usuario'] = (int) $user['pk_usuario'];
	//$GLOBALS['CONNECT_DB']->Query("UPDATE [|PREFIX|]administrador SET last_signin = '".time()."' WHERE username = '".$username."'");
	return $user;
}




function fetch_user_advanced($unique_id = '') {
	
		$user = array();
		if(empty($unique_id))
			return false;
	
		$sql = "SELECT * FROM [|PREFIX|]administrador WHERE  pk_usuario= '".$unique_id."'";
		$result = $GLOBALS['CONNECT_DB']->Query($sql);
		if( !$result )
			return false;
		$count = $GLOBALS['CONNECT_DB']->CountResult($result);
		if( !$count )
			return false;
		
		$row = $GLOBALS['CONNECT_DB']->Fetch($result);
		$GLOBALS['CONNECT_DB']->FreeResult($result);
		
		foreach($row as $k => $v){
			$user[$k] = stripslashes($v);
		}
	return $user;
}


function username_to_id($username)
{
	if(!$username) return false;
	$username = trim($username);
	$username = secure_sql($username);
	$sql = "SELECT pk_usuario FROM [|PREFIX|]administrador where username LIKE '".$username."'";
	$result = $GLOBALS['CONNECT_DB']->Query($sql);
	if(!$result)
		return 0;
	$total = $GLOBALS['CONNECT_DB']->CountResult($result);
	if($total > 0)
	{
		$r = $GLOBALS['CONNECT_DB']->Fetch($result);
		$GLOBALS['CONNECT_DB']->FreeResult($result);
		return $r['pk_usuario'];
	}
	return 0;
}


}
?>