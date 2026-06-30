<?php
require_once("header.php");
?>
<?php
$IsAds = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_banner = new cls_tbl_banner($IsAds);

$IsActionG = "";
if($do=='create') {

if($IsAds>0 && !$cls_banner->IsExistAds())
$IsAds = 0 ;

$IsActionG = 1;

}else{
if($cls_banner->IsExistAds())
$IsActionG = 0 ;
else
$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Banner";
else
$MessageForm = "Crear Banner";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_banner';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_ads.php';
</script>

<script type="text/javascript" src="../include/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="../include/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="../include/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="../include/colorpicker/js/layout.js?ver=1.0.2"></script>
<link rel="stylesheet" href="../include/colorpicker/css/colorpicker.css" type="text/css" />



<div class="container_16">
	<div class="grid_12">
		<div class="module">
			<h2><span><?php print $MessageForm ;?></span></h2>
				<div class="module-body">
				<form method="post" enctype="multipart/form-data" name="frm_banner" id="frm_banner" >
					<input name="b_width" type="hidden" id="b_width" value="0" />
					<input name="b_height" type="hidden" id="b_height" value="0" />
					<div>
                       <span class="notification n-success">Registros Obligatorios </span>
                    </div>
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_title = $cls_banner->get_infolang_banner($languages[$i]['id']);
					?>
					 <p>
					<label><?php if ($i == 0) print 'Título del banner'." :"; ?>&nbsp;</label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
					<?php print tep_draw_input_field('name_banner[' . $languages[$i]['id'] . ']',$data_title[0]['title'],'class="input-long"',TRUE);?>
		
                     </p>
					<?php
					  }
					?>
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_title = $cls_banner->get_infolang_banner($languages[$i]['id']);
					?>
					 <p>
					<label><?php if ($i == 0) print 'Precio desde:'." :"; ?></label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
					<?php print tep_draw_input_field('description_banner[' . $languages[$i]['id'] . ']',$data_title[0]['description'],'class="input-short" maxlength="300"',FALSE); ?>
					</p>
					<?php
					  }
					?>
					
					<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_hidden = $cls_banner->get_infolang_banner($languages[$i]['id']);
					?>
					 <p>
					<label><?php if ($i == 0) print '(*) Subir imagen'." :"; ?>&nbsp;</label>
					<?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
					<?php print tep_draw_input_field('file_upads[' . $languages[$i]['id'] . ']','','class="input-medium"',false,'file');?>
					<span id="msg_fileupload"></span>	
					
					<?php print tep_draw_input_field('file_updas_hidden[' . $languages[$i]['id'] . ']',$data_hidden[0]['image'],'',false,'hidden');?>
                     </p>
					<?php
					  }
					?>
					
				
					 <p>
					<label>Ubicación del banner:</label>
				<select name="sle_position" class="input-medium" id="sle_position" onchange="ChangePosition(this.value);" title="Seleccione la ubicación del banner">
				<option value="0">Seleccione una ubicación para el banner</option>
	<option value="1" <?php if($cls_banner->getint_position()==1)echo "selected";?> >710px(ancho) x 403px(alto) | Página principal </option>
	<option value="2" <?php if($cls_banner->getint_position()==2)echo "selected";?> >650px(ancho) x 332px(alto) | Ventana Emergente </option>
	<option value="3" <?php if($cls_banner->getint_position()==3)echo "selected";?> >230px(ancho) x 413px(alto) | Publicidad Lateral </option>

				</select>
					
				<input name="hwidth" id="hwidth" type="hidden" value="0" />
				<input name="hheight" id="hheight" type="hidden" value="0" />
				<span id="msg_position" class="notification-input ni-correct"></span>
                     </p>
				
				
				<p id="row_opcadicional1">
					<label>Opcion adicional:</label>
					 Visualizar el titulo <input name="chk_istitle" type="checkbox" value="1" <?php if($cls_banner->getint_titlevisible()==1)echo "checked";?>/>
					<span class="notification-input ni-error">Sorry, try again.</span>
				</p>			
							
				
				<p id="row_opcadicional2" style="display:none;">
					<label>xxx</label>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						   <tr>
							 <td width="23%" height="25" align="left" valign="middle" style="vertical-align:middle;">
							 <span class="tdrow2" style="color:#FFF; font-weight:bold; vertical-align:middle;">Fondo para el titulo </span></td>
							 <td width="4%" align="center" valign="middle" style="vertical-align:middle;"><img src="images/bg_title_rojo.jpg" width="20" height="20" /></td>
							 <td width="3%" style="vertical-align:middle;">
							 <input type="radio" name="rb_imagebg" id="rb_imagebg" value="1" onclick="RbText(this.value);" <?php if($cls_banner->getint_optfondo()==1)echo "checked";?>/>
							 </td>
							 <td width="3%" style="vertical-align:middle;"><img src="images/bg_title_naranja.jpg" width="20" height="20" /></td>
							 <td width="3%" style="vertical-align:middle;">
							 <input type="radio" name="rb_imagebg" id="rb_imagebg" value="2" onclick="RbText(this.value);" <?php if($cls_banner->getint_optfondo()==2)echo "checked";?>/>
							 </td>
							 <td width="3%" style="vertical-align:middle;"><img src="images/bg_title_verde.jpg" width="20" height="20" /></td>
							 <td width="3%" style="vertical-align:middle;">
							 <input type="radio" name="rb_imagebg" id="rb_imagebg" value="3" onclick="RbText(this.value);" <?php if($cls_banner->getint_optfondo()==3)echo "checked";?>/>
							 </td>
							 <td width="6%" align="right" valign="middle" style="vertical-align:middle;">Color</td>
							 <td width="4%" style="vertical-align:middle;">
							 <input type="radio" name="rb_imagebg" id="rb_imagebg" value="4" onclick="RbText(this.value);" <?php if($cls_banner->getint_optfondo()==4)echo "checked";?>/>
							 </td>
							 <td width="48%" style="vertical-align:middle;">
							 <input name="get_bgcolor" type="text" class="Field70" id="get_bgcolor" maxlength="7" value="<?php echo $cls_banner->gettxt_optcolor();?>" />
							 </td>
						   </tr>
						 </table>
				</p>	
				
				
				<p>
				<label>Enlace del Banner:</label>
				<input type="text" value="<?php echo $cls_banner->gettxt_url();?>" id="txt_url" class="input-long" name="txt_url" />
				<input type="checkbox" name="chk_ispopup" id="chk_ispopup" onclick="StatusPopUp(this.checked);" value="1" <?php if($cls_banner->getint_ispopup()==1)echo "checked";?>/>Abrir en una nueva ventana
				 <div id="whpopup" style="width:520px; float:left;"><strong>Ancho</strong>
					<input name="txt_wpopup" type="text" class="Field50" id="txt_wpopup" value="<?php echo $cls_banner->getint_popupw();?>"/>
					<strong>Alto</strong>
					<input name="txt_hpopup" type="text" class="Field50" id="txt_hpopup" value="<?php echo $cls_banner->getint_popuph();?>"/>
					Ingrese el ancho y alto de la nueva ventana
					<span id="msg_dimensionpoup"></span>
				  </div>
                </p>
				
				<p>
					<label>Destino:</label>
					<select name="txt_target" id="txt_target" class="input-short">
						<option value="_self"  <?php print ($cls_banner->gettxt_destino()=="_self")?"selected":"";?>>Misma P&aacute;gina</option>
						<option value="_blank" <?php print ($cls_banner->gettxt_destino()=="_blank")?"selected":"";?>>Nueva P&aacute;gina</option>
					</select>
				</p>
				
				
				<p>
					<label>Orden:</label>
					<input name="txt_order" type="text" class="input-short" id="txt_order" title="Ingrese un número válido" value="<?php echo $cls_banner->getint_orden();?>" >
					<span id="msg_order" class="notification-input ni-correct"></span>
				</p>
				
				
				<p>
					<label>Publicar Banner:</label>
					  <input name="txt_status" type="checkbox" id="txt_status" value="1" <?php print($cls_banner->getint_estado()==1)?'checked':'';?>/>
					  <input type="hidden" name="id" id="id"  value="<?php print $IsAds?>"/>   
				</p>
				
				
				 <fieldset>								
				<?php if($IsActionG==0) { ?>
				  <input type="Button" value="Actualizar banner"  class='submit-green' id="btn_save"/>
				<?php 	}
				else{?>
				<input type="Button" value="Guardar banner" class='submit-green' id="btn_save"/>
				 <?php }?>
				&nbsp;&nbsp;
				<input type="Button" value="Regresar" onclick="javascript:window.location='inf_banner.php'" class='submit-gray' />								
                 </fieldset>

				</form>
				</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>
<script  language="javascript" type="text/javascript" src="js/jform_banner.js"></script>
<script>
ChangePosition('<?php echo $cls_banner->getint_position();?>');
RbText(<?php echo $cls_banner->getint_optfondo();?>);
StatusPopUp('<?php echo $cls_banner->getint_ispopup();?>');

$(document).ready(function() {
	  $('#get_bgcolor').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val("#"+hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
});
</script>
<?php
require_once("footer.php");
?>
