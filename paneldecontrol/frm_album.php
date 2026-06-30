<?php
require_once("header.php");
?>
<?php
$IsAlbum = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_album = new cls_tbl_album($IsAlbum);

$IsActionG = "";
if($do=='create') {

if($IsAlbum>0 && !$cls_album->IsExistAlbum())
$IsAlbum = 0 ;

$IsActionG = 1;

}else{
if($cls_album->IsExistAlbum())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Album";
else
$MessageForm = "Crear Album";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();

?>
<script language="javascript" type="text/javascript" src="<?php print _URL;?>js/jquery.maskedinput-1.2.2.js"></script>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_album';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_album.php';
</script>
<script type="text/javascript" src="<?php print _URL?>include/tiny_mce/tiny_mce.js"></script>

<div class="container_16">
	<div style="clear:both;"></div>
	
		<div class="grid_12">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
		
<form method="post"  name="frm_album" id="frm_album" >
			<div>
				<span class="notification n-success">Registros Obligatorios</span>
			</div>
			
			<?php
				 for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
				 $data_title = $cls_album->get_infolang_album($languages[$i]['id']);
			 ?>
			 <p>
				<label><?php if ($i == 0) print 'Título del album'." :"; ?>&nbsp;
				<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
				</label>
				<?php print tep_draw_input_field('txt_titlealbum[' . $languages[$i]['id'] . ']',$data_title[0]['title'],'class="input-medium"',TRUE); ?>
				<span class="notification-input ni-correct"></span>
			</p>
			<?php
			  }
			?>
			
			<?php
			for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			$data_content = $cls_album->get_infolang_album($languages[$i]['id']);
			?>
			 <p>
				<label>
				<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
				<?php if ($i == 0) print 'Descripción'." :"; ?>&nbsp;</label>
				<textarea name="<?php print 'txt_descriptionalbum[' . $languages[$i]['id'] . ']';?>"  id="<?php print 'txt_descriptionalbum[' . $languages[$i]['id'] . ']';?>" cols="40" rows="10" class="input-medium"><?php print $data_content[0]['description'];?></textarea>
			</p>
			<?php
			  }
			?>
			
			 <p>
				<label>Fecha del album (DIA / MES / AÑO)</label>
				<input name="txt_albumdate" type="text" class="input-short" id="txt_albumdate" value="<?php print change2ymd($cls_album->gettxt_datealbum())?>" title="Ingrese una fecha válida" />
				<span id="msg_albumdate" class="notification-input ni-correct"></span>
			</p>
			
			 <fieldset>
				<legend></legend>
				<ul>
					<li><label>
					<input type="hidden" name="id" id="id"  value="<?php print $IsAlbum?>"/>
					<input name="txt_status" type="checkbox" id="txt_status" value="1" <?php print ($cls_album->getint_status()==1)?'checked':'';?>/> Publicar</label></li>
				</ul>
			</fieldset>
			
			 <fieldset>

		<?php if($IsActionG==0) { ?>
          <input type="Button" value="Actualizar album"  class='submit-green' id="btn_save"/>
        <?php 	}
		else{?>
        <input type="Button" value="Guardar album" class='submit-green' id="btn_save"/>
         <?php }?>
        &nbsp;&nbsp;
        <input type="Button" value="Regresar" onclick="javascript:window.location='inf_album.php'" class='submit-gray' />
		
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
	theme : "simple",
	language: 'es'
});
</script>

<script  language="javascript" type="text/javascript" src="js/jform_album.js"></script>
<script>
jQuery(function($){
$("#txt_albumdate").mask("99/99/9999",{placeholder:"0"});
});
</script>

<!--  Footer  -->
<?php
require_once("footer.php");
?>