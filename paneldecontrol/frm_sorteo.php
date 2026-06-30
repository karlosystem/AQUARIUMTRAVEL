<?php
require_once("header.php");
?>
<?php
$IsSorteo = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_sorteo = new cls_tbl_sorteo($IsSorteo);

$IsActionG = "";
if($do=='create') {

if($IsSorteo>0 && !$cls_sorteo->IsExistSorteo())
$IsSorteo = 0 ;

$IsActionG = 1;

}else{
if($cls_sorteo->IsExistSorteo())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Sorteo";
else
$MessageForm = "Crear Sorteo";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_sorteo';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_sorteo.php';
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
<form method="post" enctype="multipart/form-data" name="frm_sorteo" id="frm_sorteo" >
  <table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
      <tbody><tr>
            <td height="30" align="left" class="maintitle">Gesti&oacute;n de Sorteo de Premios</td>
	  </tr>
  </tbody></table>
      
  <table width='100%' border='0' cellspacing='1' cellpadding='0' align='center' class="tableborder" >
	<tr>
		<td class='tdrow1'  height='35' align='right'>Titulo del Sorteo</td>
		<td align="left" class='tdrow2' id="titulo">
		  <input type="text" id="get_txttitulo" name="get_txttitulo" title="Por favor ingrese algun titulo del sorteo" value="<?php echo $cls_sorteo->gettxt_titulo()?>" maxlength="200" class="Field500" />
		  * <span id="msg_titulo"></span> 		  
          </td>
	</tr>
    
	<tr>
		<td class='tdrow1'  height='35' align='right'>Ganador del Sorteo</td>
		<td align="left" class='tdrow2' id="titulo">
		  <input type="text" id="get_txtganador" name="get_txtganador" title="Por favor ingrese el nombre del ganador" value="<?php echo $cls_sorteo->gettxt_ganador()?>" size="80" class="Field500" />
		  *	<span id="msg_ganador"></span>	  </td>
	</tr>
    
    <tr>
		<td class='tdrow1'  height='35' align='right'>Empresa</td>
		<td align="left" class='tdrow2' id="empresa">
		  <input type="text" id="get_txtempresa" name="get_txtempresa" title="Por favor ingrese el nombre de la empresa" value="<?php echo $cls_sorteo->gettxt_empresa()?>" maxlength="200" class="Field500" />
		  *	<span id="msg_empresa"></span>	 </td>
	</tr>

    
    <tr>
		<td class='tdrow1'  height='35' align='right'>Cargo</td>
		<td align="left" class='tdrow2' id="cargo">
		  <input type="text" id="get_txtcargo" name="get_txtcargo"  title="Por favor ingrese el cargo del ganador" value="<?php echo $cls_sorteo->gettxt_cargo()?>"  maxlength="200" class="Field500" />
		  *	<span id="msg_cargo"></span>   </td>
	</tr>

    
	<tr >
        <td align="right" style="vertical-align:top" valign="top" class="tdrow1">Comentario del Sorteo</td>
        <td height="30" align="left" class="tdrow2">
<?php
$oFCKeditor = new FCKeditor('get_contentsorteo') ;
$oFCKeditor->BasePath = '../adapter/fckeditor/';
$oFCKeditor->ToolbarSet = 'ISC_NOTICE' ;
$oFCKeditor->Value = $cls_sorteo->gettxt_content();
$oFCKeditor->Config['SkinPath'] = _URL."/adapter/fckeditor/editor/skins/office2003/";
$oFCKeditor->Height = 350;
$oFCKeditor->Width =  550;
$oFCKeditor->Create() ;
?>
 
          * </tr>
	  <tr >
	    <td height="35" align="right" class="tdrow1">Thumb ( Imagen )</td>
	    <td align="left" class="tdrow2">
	      <input name="fileup_sorteo" id="fileup_sorteo" type="file" class="MultiFile txt_negro" size="50" accept="jpeg|jpg" />
	    	    
	      *
	      <input type="hidden" name="h_thumbsorteo" id="h_thumbsorteo" value="<?php print $cls_sorteo->gettxt_imgthumb();?>"/></td>
	    </tr>
	  <tr >
	    <td height="35" align="right" class="tdrow1">Fecha del sorteo</td>
	    <td align="left" class="tdrow2">
        <input name="getdate_dateadd" title="por favor ingrese la fecha de sorteo" type="text" class="Field70" id="getdate_dateadd" value="<?php
        if(tep_not_null($cls_sorteo->getdate_dateadd()) && $cls_sorteo->getdate_dateadd()!='0000-00-00')
		echo Date::convert($cls_sorteo->getdate_dateadd(),'Y-m-d','d-m-Y');?>" size="20" maxlength="10" />
        <img src="../adapter/calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />(dia/mes/año)
         <span id="msg_datesorteo"></span> 
        </td>
	    </tr>
	  <tr >
        <td width="185" height="35" align="right" class="tdrow1">Publicar Sorteo</td>
        <td width="750" align="left" class="tdrow2">
        <input name="chksorteo" type="checkbox" id="chksorteo" value="1"  <?php echo ($cls_sorteo->gettxt_status()==1)?'checked':''?>/>      
        <input type="hidden" name="id" id="id"  value="<?php print $IsSorteo?>"/>
        </td> 
	  </tr>
      
	    <?php if($id!="") { ?>
        <tr >
	    <td height="35" align="right" class="tdrow1">Fecha de Creaci&oacute;n </td>
	    <td align="left" class="tdrow2">
	      <input name="textfield" type="text" disabled="disabled" class="Field120" id="textfield" value="<?php echo $cls_sorteo->getdate_fecha()?>"/>
	    </td>
	    </tr>
        <?php } ?>
	   <tr height="35">
        <td valign="middle" align="center" colspan="4" class="tdDivision" style="vertical-align:middle;">
	    <?php if($IsActionG==0) { ?>
          <input type="Button" value="Actualizar Sorteo"  class='btn_blue2' size="22"  id="btn_save"/>
        <?php 	}
		else{?>
        <input type="Button" value="Guardar Sorteo" class='btn_blue2' size="22" id="btn_save"/>
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_sorteo.php'" class='btn_black' size="22" />              </td>
      </tr>
        </table>
</form>
</div>

<script  language="javascript" type="text/javascript" src="js/jform_sorteo.js"></script>

<script language="javascript" type="text/javascript">
$(function(){ 
$('#file_sorteo').MultiFile({ 
accept:'jpg|jpeg', max:1, STRING: { 
remove:'Quitar', 
selected:'Selecionado: $file', 
denied:'Tipo de archivo no válido: $ext!', 
duplicate:'Archivo ya seleccionado:\n$file!' 
} 
}); 
});
</script>
<script language="javascript" type="text/javascript">

/*  CALENDAR  */
var cal = new Zapatec.Calendar.setup({
		
inputField     :    "getdate_dateadd",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>
<?php
require_once("footer.php");
?>