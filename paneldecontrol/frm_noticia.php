<?php
require_once("header.php");
?>
<?php
$IsNoticia = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_noticia = new cls_tbl_noticia($IsNoticia);

$IsActionG = "";
if($do=='create') {

if($IsNoticia>0 && !$cls_noticia->IsExistNoticia())
$IsNoticia = 0 ;

$IsActionG = 1;

}else{
if($cls_noticia->IsExistNoticia())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Noticia";
else
$MessageForm = "Crear Noticia";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_noticia';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_noticia.php';
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
	<div style="clear:both;"></div>
			<div class="grid_12">
				<div class="module">
				<h2><span><?php print $MessageForm ;?></span></h2>
				<div class="module-body">
				<form method="post" enctype="multipart/form-data" name="frm_noticia" id="frm_noticia" >
					<div>
						<span class="notification n-success">Registros Obligatorios</span>
					</div>
					
					 <?php
						for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
						$data_title = $cls_noticia->get_notice_detail($IsNoticia,$languages[$i]['id']);
					 ?>
					 <p>
						<label>
						<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
						<?php if ($i == 0) print 'Título de la noticia'." :"; ?>
						
						</label>						
						<?php print tep_draw_input_field('get_titlenotice[' . $languages[$i]['id'] . ']',$data_title[0]['notice_txt_title'],'class="input-medium"',TRUE);?> 
						<span id="msg_datetestimonio" class="notification-input ni-correct"></span>
					 </p>
					<?php
					  }
					?>
					
					 <p>
						<label>Fecha de la Noticia:</label>
						<input name="get_datenoticia" type="text" class="input-short" id="get_datenoticia" value="<?php echo $cls_noticia->gettxt_fecha()?>" title="Ingrese una fecha de la noticia" />
						<img src="calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />
						<span id="msg_datenoticia" class="notification-input ni-correct"></span>
					</p>
					
					 <p>
						<label>Imagen de la Noticia:</label>
						<input name="file_noticia" type="file" class="input-medium" id="file_noticia" title="Extensiones permitidas: .jpg |.jpeg" />
						<input type="hidden" name="hidden_noticia" id="hidden_noticia" value="<?php print $cls_noticia->gettxt_imagen()?>" />
						
					 </p>
					 
					  <?php
						for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
						$data_content = $cls_noticia->get_notice_detail($IsNoticia,$languages[$i]['id']);
						?>
	
						 <p>
							<label>
							<?php print tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
							Descripción de la Noticia:</label>
							<textarea name="<?php print 'get_contentnotice[' . $languages[$i]['id'] . ']';?>"  id="<?php print 'get_contentnotice[' . $languages[$i]['id'] . ']';?>" rows="7" cols="90" class="input-medium"><?php print $data_content[0]['notice_txt_content'];?></textarea>
						</p>
						
						<?php
						  }
						?>
      
						<fieldset>
							<legend></legend>
							<ul>
								<li><label>
								<input type="hidden" name="id" id="id"  value="<?php print $IsNoticia?>"/>
								<input name="chk_publicnoticia" type="checkbox" id="chk_publicnoticia" value="1" <?php print ($cls_noticia->gettxt_estado()==1)?'checked':'';?>/> Publicar</label></li>
							</ul>
						</fieldset>
						
				<fieldset>

					<?php if($IsActionG==0) { ?>
					  <input type="Button" value="Actualizar Noticia"  class='submit-green' id="btn_save"/>
					<?php 	}
					else{?>
					<input type="Button" value="Guardar Noticia" class='submit-green' id="btn_save"/>
					 <?php }?>
					&nbsp;&nbsp;
					<input type="Button" value="Regresar" onClick="javascript:window.location='inf_noticia.php'" class='submit-gray' />       
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

<script  language="javascript" type="text/javascript" src="js/jform_noticia.js"></script>

<script language="javascript" type="text/javascript">
$(function(){ 
$('#file_noticia').MultiFile({ 
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
		
inputField     :    "get_datenoticia",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>
<?php
require_once("footer.php");
?>