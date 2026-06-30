<?php
require_once("header.php");
?>
<?php
$IsContent = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_contenido = new cls_tbl_contenido($IsContent);

$IsActionG = "";
if($do=='create') {

if($IsContent>0 && !$cls_contenido->IsExistContent())
$IsContent = 0 ;

$IsActionG = 1;

}else{
if($cls_contenido->IsExistContent())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Página";
else
$MessageForm = "Crear Página";


$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_content';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_content.php';
</script>

<script type="text/javascript" src="<?php print _URL?>include/tiny_mce/tiny_mce.js"></script>

<div class="container_16">
	<div style="clear:both;"></div>
	<div class="grid_12">
		 <div class="module">
		 	<h2><span><?php print $MessageForm ;?></span></h2>
				<div class="module-body">
				<form method="post" enctype="multipart/form-data"  name="frm_content" id="frm_content">
					<div>
                       <span class="notification n-success">Campos Obligatorios.</span>
                    </div>
					
					
					
					
					<p>
					<label>Secci&oacute;n</label>

					<select name="seccion" id="seccion" style="width:210px" >
					<option value="0" <?php print ($cls_contenido->getfk_seccion()==0)?'selected':'';?> >Seleccione Libre (En caso para las publicidades)</option>		
			<?php	$sql   = "SELECT * FROM tbl_seccion WHERE int_estado='1' ORDER BY pk_seccion ASC";
					$secID = new cls_tbl_seccion();
					$rowsecID = $secID->lista($sql);	
					for($i=0;$i<count($rowsecID);++$i)
					{	  
						if($rowsecID[$i]['pk_seccion']==$cls_contenido->getfk_seccion())
							echo "<option value='".$rowsecID[$i]['pk_seccion']."' selected>".$rowsecID[$i]['txt_nombre']."</option>";
						else
							echo "<option value='".$rowsecID[$i]['pk_seccion']."'>".$rowsecID[$i]['txt_nombre']."</option>";				
					}	// while
			?>			</select>
					  *	
				</p>
					
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_title = $cls_contenido->get_infolang_page($languages[$i]['id']);
					?>
					<p>
					<label><?php if ($i == 0) print 'Título de la página'." :"; ?></label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
					<?php print tep_draw_input_field('get_titlepage[' . $languages[$i]['id'] . ']',$data_title[0]['title'],'class="input-medium"',TRUE); ?>
                    </p>
					<?php
					  }
					?>
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_metatitle = $cls_contenido->get_infolang_page($languages[$i]['id']);
					?>
					<p>
					<label><?php if ($i == 0) print 'Meta Title de la página'." :"; ?></label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
					<?php print tep_draw_input_field('get_metatitlepage[' . $languages[$i]['id'] . ']',$data_metatitle[0]['metatitle'],'class="input-long"',TRUE); ?>
                    </p>
					<?php
					  }
					?>
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_metadescription = $cls_contenido->get_infolang_page($languages[$i]['id']);
					?>
					<p>
					<label><?php if ($i == 0) print 'Meta Description de la página'." :"; ?></label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
					<?php print tep_draw_input_field('get_metadescriptionpage[' . $languages[$i]['id'] . ']',$data_metadescription[0]['metadescription'],'class="input-long"',TRUE); ?>
                    </p>
					<?php
					  }
					?>
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_metalink = $cls_contenido->get_infolang_page($languages[$i]['id']);
					?>
					<p>
					<label><?php if ($i == 0) print 'Meta Link de la página'." :"; ?></label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
					<?php print tep_draw_input_field('get_metalinkpage[' . $languages[$i]['id'] . ']',$data_metalink[0]['metalink'],'class="input-long"',TRUE); ?>
                    </p>
					<?php
					  }
					?>
					
					
					
				 	<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_content = $cls_contenido->get_infolang_page($languages[$i]['id']);
					?>	
					 <fieldset>
					<label><?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;<?php if ($i == 0) print 'Contenido de la página'." :"; ?></label>
					
						<textarea name="<?php print 'get_contentpage[' . $languages[$i]['id'] . ']';?>"  id="<?php print 'get_contentpage[' . $languages[$i]['id'] . ']';?>" cols="40" rows="10"><?php print $data_content[0]['details'];?></textarea>
					</fieldset>
					<?php
					  }
					?>
					
					
					
					
					 <p>
						<label>Imagen</label>
						<input name="file_uppages" type="file" class="input-medium" id="file_uppages" accept="jpeg|jpg" />
						<input name="chk_remove" type="checkbox" id="chk_remove" title="Active la casilla si va a remover la imagen del contenido" value="1" />
						<input type="hidden" name="imagen" id="imagen" value="<?php print $cls_contenido->gettxt_imagen()?>" />						
					 </p>
					 
					  <p>
						<label>Orden</label>
						<input type="text" value="<?php echo $cls_contenido->getint_order()?>" id="txt_order" class="input-short" name="txt_order" title="Ingrese el orden del contenido" >
						<span id="msg_order" class="notification-input ni-correct"></span>
                      </p>
					  
						<fieldset>
							<legend>Publicar</legend>
							<ul>
								<li><label>
								<input name="chk_status" type="checkbox" id="chk_status" value="1" <?php print ($cls_contenido->getint_estado()==1)?'checked':'';?>/>
					  			<input type="hidden" name="id" id="id"  value="<?php print $IsContent?>"/>  
								</label></li>
							</ul>
						</fieldset>
						
						<fieldset>
						
						<?php if($IsActionG==0) { ?>
						  <input type="Button" value="Actualizar Contenido"  class="submit-green" size="22"  id="btn_save"/>
						<?php 	}
						else{?>
						<input type="Button" value="Guardar Contenido" class="submit-green" size="22" id="btn_save"/>
						 <?php }?>
						&nbsp;&nbsp;
						<input type="Button" value="Regresar" onclick="javascript:window.location='inf_contenido.php'" class="submit-gray"/>
							
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
	height: "680",
	language: 'es',
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	// Theme options
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,forecolor,fontselect,fontsizeselect,pastetext,pasteword,|,bullist,numlist",
	theme_advanced_buttons2 : "fullscreen,image,code",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	
	// Drop lists for link/image/media/template dialogs 
	template_external_list_url : "js/template_list.js", 
	external_link_list_url : "js/link_list.js", 
	external_image_list_url : "js/image_list.js", 
	media_external_list_url : "js/media_list.js",


	// Example content CSS (should be your site CSS)
	content_css : "<?php echo _URL?>css/content.css"

	// Drop lists for link/image/media/template dialogs
	/*
		template_external_list_url : "js/template_list.js",
		external_link_list_url : "js/link_list.js",
		external_image_list_url : "js/image_list.js",
		media_external_list_url : "js/media_list.js",
    */

});
</script>
<script  language="javascript" type="text/javascript">
(function() {
  
   
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;
      
	  if(jQuery.trim($('#txt_order').val())==""){$("#msg_order").html($('#txt_order').attr('title')).addClass('msg-error'); $('#txt_order').focus(); status=false;
      }else{ $("#msg_order").html("").removeClass('msg-error');}
	  
	  
	  if(!status) return false;
	  
      if(status) {
		  $(submitButton).attr("value", "Por favor espere...");
		  $(submitButton).attr("disabled", "true");
			
		if(IsAction==0){
		editar();
		}else{
		registrar();
		}
	  }
	  
   });

})(jQuery);
</script>
<?php
require_once("footer.php");
?>