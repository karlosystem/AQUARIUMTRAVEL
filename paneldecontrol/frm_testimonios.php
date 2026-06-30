<?php
require_once("header.php");
?>
<?php
$IsTestimonio = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_testimonios = new cls_tbl_testimonios($IsTestimonio);

$IsActionG = "";
if($do=='create') {

if($IsTestimonio>0 && !$cls_testimonios->IsExistTestimonios())
$IsTestimonio = 0 ;

$IsActionG = 1;

}else{
if($cls_testimonios->IsExistTestimonios())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Testimonio";
else
$MessageForm = "Crear Testimonio";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_testimonio';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_testimonios.php';
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

<div class="container_16">
	<div class="grid_10">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">

<form method="post" enctype="multipart/form-data" name="frm_testimonio" id="frm_testimonio" >
 <div>
		<span class="notification n-success">Registros Obligatorios.</span>
</div>

    <?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
	$data_title = $cls_testimonios->get_testimonios_detail($IsTestimonio,$languages[$i]['id']);
    ?>
 <p>
	<label>
		<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;<?php if ($i == 0) print 'Nombre del Cliente'." :"; ?></label>
 <?php print tep_draw_input_field('get_titletestimonio[' . $languages[$i]['id'] . ']',$data_title[0]['testimonio_txt_title'],'class="input-medium"',TRUE);?> 
	<span id="msg_clientetestimonio" class="notification-input ni-correct"></span>
</p>
	<?php
      }
    ?>
	
	

	<p>
		<label>Fecha de Publicacion:</label>
		 <input name="get_datetestimonio" type="text" class="input-short" id="get_datetestimonio" value="<?php echo $cls_testimonios->getdate_testimonio()?>" Title="Ingrese una fecha del testimonio" />
		 <img src="calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />
		<span id="msg_datetestimonio" class="notification-input ni-correct"></span>
	</p>
	
	
 	 <p>
		<label>Imagen del Cliente:</label>
		 <input name="file_testimonio" type="file" class="input-medium" id="file_testimonio"  title="Extensiones permitidas: .jpg |.jpeg" />
		 <input type="hidden" name="hidden_testimonio" id="hidden_testimonio" value="<?php print $cls_testimonios->gettxt_imgthumb()?>" />
		<span id="msg_fileupload" class="notification-input ni-correct"></span>
	</p>	
	
	<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
	$data_content = $cls_testimonios->get_testimonios_detail($IsTestimonio,$languages[$i]['id']);
    ?>
	 <p>
		<label><?php print tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;Descripción:</label>		
		<textarea name="<?php print 'get_contenttestimonio[' . $languages[$i]['id'] . ']';?>"  id="<?php print 'get_contenttestimonio[' . $languages[$i]['id'] . ']';?>" cols="40" rows="10" class="input-medium"><?php print $data_content[0]['testimonio_txt_content'];?></textarea>
	</p>
	  <?php
      }
    ?>
	
	 <fieldset>
		<legend>Publicar</legend>
		<ul>
			<li><label>
			 <input name="chk_publictestimonio" type="checkbox" id="chk_publictestimonio" value="1" <?php print ($cls_testimonios->gettxt_status()==1)?'checked':'';?>/> 			 <input type="hidden" name="id" id="id"  value="<?php print $IsTestimonio?>"/>
			</label></li>
		</ul>
	</fieldset>
	
	 <fieldset>
		
		<?php if($IsActionG==0) { ?>
		<input type="Button" value="Actualizar Testimonio"  class='submit-green' id="btn_save"/>
        <?php 	}
		else{?>
        <input type="Button" value="Guardar Testimonio" class='submit-green' id="btn_save"/>
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_testimonios.php'" class='submit-gray' />
	</fieldset>

</form>
</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	language: 'es',
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	// Theme options
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,forecolor,fontselect,fontsizeselect,pastetext,pasteword,|,bullist,numlist,|,fullscreen,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false

	// Example content CSS (should be your site CSS)
	//content_css : "css/example.css",

	// Drop lists for link/image/media/template dialogs
	/*
		template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
    */

});
</script>

<script  language="javascript" type="text/javascript" src="js/jform_testimonios.js"></script>

<script language="javascript" type="text/javascript">
$(function(){ 
$('#file_testimonio').MultiFile({ 
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
		
inputField     :    "get_datetestimonio",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>
<?php
require_once("footer.php");
?>