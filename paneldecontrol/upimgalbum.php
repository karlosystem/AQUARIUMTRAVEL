<?php
@ob_start();
@session_start();

require_once("../init.php") ;
require_once("loadclass.php") ;


$UserLoadTemp = new cls_tbl_administrador();

$InfoUser = $UserLoadTemp->fetch_user_info($_SESSION[COOKIE_NAME]);
$CUser = (int)$InfoUser['pk_usuario'];

$UserLoad = new cls_tbl_administrador($CUser);

if(!$UserLoad->is_user_logged_in())
header("Location: index.php");

$id = (tep_not_null($_GET['id']))?$_GET['id']:$_POST['id'] ;

$cls_albumup = new cls_tbl_album($id);
$count_exists = $cls_albumup->countgalleryalbum_list("SELECT * FROM [|PREFIX|]album WHERE pk_album =  '".$id."'");
$cls_albumup->replace = 'n';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Añadir imagenes al album</title>
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.tdrow2 {
	color:#FFF;
}
-->
</style>

</head>
<body>
<script language="javascript" type="text/javascript"  src="<?php print _URL?>js/jquery-1.4.1.min.js"></script>
<script type="text/javascript"  src="js/jquery.MultiFile.js" ></script>
<div id="mainwindow_photo">
<?php
if($count_exists>0) {
?>
<?php
#move uplaod photos
if(tep_not_null($_POST['btn_submit'])){
ini_set('memory_limit', '128M');
$message_info = $cls_albumup->save_images('file');
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
 <td>
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border='0' align='center' cellpadding='0' cellspacing='1' class="tableborder">
      <tr>
        <td height="26" colspan="2" class='maintitle'>:: Seleccione los archivo de imagenes a subir : </td>
      </tr>
      <tr>
       <td width="171" height="25" valign="top" class='tdrow1'>&nbsp;&nbsp;&nbsp;Seleccione de imagenes: 
         <input name="hcodsoc" type="hidden" id="hcodsoc" value="<?php print $hcodsoc?>" /></td>
       <td width="364" class='tdrow2'>
        <input name="file[]" type="file" id="T8B" class="MultiFile input_file" accept="jpeg|jpg" maxlength="20" size="33"/>        </td>
      </tr>
      <?php 
	  if(tep_not_null($message_info)){ 
	 echo "<tr>";
     echo "<td height=\"30\" colspan=\"2\" align=\"center\" class=\"header\">";
	 echo $message_info;
	 echo "</td>";
     echo "</tr>";
	  }
	  ?>
      <tr>
        <td height="30" colspan="2" align="center" class="header">
		<input name="button" type="button" class="inputbutton-login" id="button" value="Actualizar" onclick="javascript:window.opener.location.reload();" />
		<input name="btn_submit" type="submit" class="inputbutton-login" value="Subir Imagenes" />		</td>
      </tr>
    </table>
  </form>
</td>
</tr>
</table>
<script language="javascript" type="text/javascript">
$(function(){ // wait for document to load 
 $('#T8B').MultiFile({ 
  STRING: {
   file: '<em title="Haz click aqui para remover la imagen seleccionada" onclick="$(this).parent().prev().click()">$file</em>',
   remove: '<img src="images/icons/ico_trash.png" height="16" width="16" alt="Remover la iagen seleccionada" title="Remover la iagen seleccionada" border=0/>',
  denied:'El archivo seleccionado no es válido: $ext\nIntente de nuevo...'
  }
 }); 
});
</script>
<?php
 }else{
 echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"tableborder\">
      <tr>
        <td height=\"26\" class=\"maintitle\">Aviso, el album seleccionado no existe no ha sido removido de la base de datos.</td>
      </tr>
	  </table>
	  ";
 }
?>
</div>
</body>
</html>
