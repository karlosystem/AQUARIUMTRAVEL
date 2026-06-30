<?php
require_once("header.php");
?>
<?php
$IsEmpresa = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_Empresa = new cls_tbl_empresas($IsEmpresa);

$IsActionG = "";
if($do=='create') {

if($IsEmpresa>0 && !$cls_Empresa->IsExistEmpresa())
$IsEmpresa = 0 ;

$IsActionG = 1;

}else{
if($cls_Empresa->IsExistEmpresa())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Empresa";
else
$MessageForm = "Empresa Registrada";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_Empresa';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_Empresa.php';
</script>

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>admin/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>admin/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>admin/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />
<!--  Calendar  -->

<script type="text/javascript" src="<?php print _URL?>admin/js/jquery.MultiFile.js" ></script>

<script type="text/javascript" src="<?php print _URL?>include/tiny_mce/tiny_mce.js"></script>


<div id="content">
<h2><?php print $MessageForm ;?></h2>
<form method="post" enctype="multipart/form-data" name="frm_Empresa" id="frm_Empresa" >
  <table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
      <tbody><tr>
            <td height="30" align="left" class="maintitle">Gesti&oacute;n de Registro de Empresas</td>
	  </tr>
  </tbody></table>
      
  <table width='100%' border='0' cellspacing='1' cellpadding='0' align='center' class="tableborder" >
	<tr>
		<td width="185"  height='35' align='right' class='tdrow1'>Raz&oacute;n Social</td>
		<td width="750" align="left" class='tdrow2' id="titulo">
		  <input type="text" id="get_txttitulo" name="get_txtrazon" title="Por favor ingrese la razon social de la Empresa" value="<?php echo $cls_Empresa->gettxt_razon()?>" maxlength="200" class="Field500" />
		  </td>
	</tr>
      
      
      <tr>
		<td width="185"  height='35' align='right' class='tdrow1'>Direccion</td>
		<td width="750" align="left" class='tdrow2' id="titulo">
		  <input type="text" id="get_txttitulo" name="get_txtdireccion" title="Por favor ingrese algun titulo del Empresa" value="<?php echo $cls_Empresa->gettxt_domicilio()?>" maxlength="200" class="Field500" />
		  </td>
	</tr>
    
     <tr>
		<td width="185"  height='35' align='right' class='tdrow1'>Correo Electronico</td>
		<td width="750" align="left" class='tdrow2' id="titulo">
		  <input type="text" id="get_txtemail" name="get_txtemail" title="Por favor ingrese la direccion de correo" value="<?php echo $cls_Empresa->gettxt_email()?>" maxlength="200" class="Field200" />
		  </td>
	</tr>
    
     <tr>
		<td width="185"  height='35' align='right' class='tdrow1'>Numero de RUC</td>
		<td width="750" align="left" class='tdrow2' id="titulo">
		  <input type="text" id="get_txtruc" name="get_txtruc" title="Por favor ingrese algun titulo del Empresa" value="<?php echo $cls_Empresa->gettxt_ruc()?>" maxlength="11" class="Field100" />
		  </td>
	</tr>
    
    <tr>
		<td width="185"  height='35' align='right' class='tdrow1'>Telefono</td>
		<td width="750" align="left" class='tdrow2' id="titulo">
		  <input type="text" id="gettxt_telefono" name="gettxt_telefono" title="Por favor ingrese el numero de Telefono" value="<?php echo $cls_Empresa->gettxt_telefono()?>" maxlength="11" class="Field200" />
		  </td>
	</tr>
    
    
    
    
	    <?php if($id!="") { ?>
        <tr >
	    <td height="35" align="right" class="tdrow1">Fecha de Creaci&oacute;n </td>
	    <td align="left" class="tdrow2">
	      <input name="textfield" type="text" disabled="disabled" class="Field120" id="textfield" value="<?php echo $cls_Empresa->getdate_fecha()?>"/>	    </td>
	    </tr>
        <?php } ?>
	   <tr height="35">
        <td valign="middle" align="center" colspan="4" class="tdDivision" style="vertical-align:middle;">
	    <?php if($IsActionG==0) { ?>
          
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_empresas.php'" class='btn_black' size="22" />              </td>
      </tr>
        </table>
</form>
</div>
<?php
require_once("footer.php");
?>