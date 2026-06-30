<?php
require_once("header.php");
?>
<?php
$IsHoteles = (int)$_GET['id']; # Action | Create
$do = SecureGet($_GET['do']); # Action | Modify

$cls_hoteles = new cls_tbl_hoteles($IsHoteles);

$IsActionG = "";
if($do=='create') {

if($IsHoteles>0 && !$cls_hoteles->IsExistHoteles())
	$IsHoteles = 0 ;
	$IsActionG = 1;
}else{

if($cls_hoteles->IsExistHoteles())
	$IsActionG = 0 ;
else
	$IsActionG = 1;
}

if($IsActionG==0)
$MessageForm = "Actualizar Hoteles";
else
$MessageForm = "Crear Hoteles";

$cls_languages = new language();
$languages = $cls_languages->tep_get_languages();
?>
<script language="javascript" type="text/javascript" >
var MyForm = 'frm_hoteles';
var IsAction = '<?php print $IsActionG?>';
var urlProcess = 'proc_hoteles.php';
</script>

<!--  Calendar  -->
<script type='text/javascript' src='<?php print _URL?>admin/calendar_picker/zapatec.js'></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar.js"  charset="iso-8859-1"></script>
<script type="text/javascript" src="<?php print _URL?>admin/calendar_picker/calendar-es.js" charset="iso-8859-1"></script>
<link href="<?php print _URL?>admin/calendar_picker/zpcal.css" rel="stylesheet" type="text/css" />
<link href="<?php print _URL?>admin/calendar_picker/fancyblue.css" rel="stylesheet" type="text/css" />

<div class="container_16">
	<div style="clear:both;"></div>
	
		<div class="grid_12">
		<div class="module">
		<h2><span><?php print $MessageForm ;?></span></h2>
		<div class="module-body">
		
	<form method="post" enctype="multipart/form-data" name="frm_hoteles" id="frm_hoteles" >
			<div>
				<span class="notification n-success">Registros Obligatorios</span>
			</div>
			
			<?php
			for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			$data_title = $cls_hoteles->get_hoteles_detail($IsHoteles,$languages[$i]['id']);
			?>
			 <p>
			 <label><?php if ($i == 0) print 'Nombre del Hotel'." :"; ?>&nbsp;</label>
			 <?php echo tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;
			  <?php print tep_draw_input_field('get_titlehoteles[' . $languages[$i]['id'] . ']',$data_title[0]['hoteles_txt_title'],'class="input-medium"',TRUE);?> 
				<span id="msg_titlehoteles" class="notification-input ni-correct"></span>
			</p>
			<?php
		  	}
			?>
			
			 <p>
				<label>Ubicacion del Hotel:</label>
				<select name="sle_departamento" class="input-short" id="sle_departamento" title="Seleccione un departamento">
					 <option value=""> Seleccione la ubicacion:</option>
				  	<?php print cls_tbl_departamento::ListaDepartamentos($cls_hoteles->getfk_departamento());?>
				</select>
				<span class="notification-input ni-correct" id="msg_ubicacion"></span>
			</p>
			
			
			 <p>
				<label>Cadena de Hoteles:</label>
				<select name="sle_cadena" class="input-short" id="sle_cadena" title="Seleccione una cadena">
				  <option value=""> Seleccione la cadena</option>
				  <?php print cls_tbl_cadena::ListaCadenas($cls_hoteles->getfk_cadena());?>
				</select>
				<span id="msg_titlehotelescadena" class="notification-input ni-correct"></span>
			</p>
			
			 <p>
				<label>Direccion y Telefono:</label>
				<input class="input-long" type="text" name="txt_direccion" id="txt_direccion" value="<?php print $cls_hoteles->gettxt_direccion()?>" />
				<span class="notification-input ni-correct"></span>
			</p>
			
			<?php
			for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			$data_content = $cls_hoteles->get_hoteles_detail($IsHoteles,$languages[$i]['id']);
			?>
			 <fieldset>
				<label><?php print tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;Descripción del Hotel:</label>
				
				<?php
				$oFCKeditor = new FCKeditor('get_contenthoteles[' . $languages[$i]['id'] . ']') ;
				$oFCKeditor->BasePath = '../adapter/fckeditor/';
				$oFCKeditor->ToolbarSet = 'ISC_NOTICE' ;
				$oFCKeditor->Value = $data_content[0]['hoteles_txt_content'];

				$oFCKeditor->Config['SkinPath'] = _URL."/adapter/fckeditor/editor/skins/office2003/";
				$oFCKeditor->Height = 350;
				$oFCKeditor->Width =  570;
				$oFCKeditor->Create() ;
			 ?>
			</fieldset>
			<?php
			  }
			?>
			
			<?php
			for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
			$data_content = $cls_hoteles->get_hoteles_detail($IsHoteles,$languages[$i]['id']);
			?>
			 <fieldset>
				<label><?php print tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;Servicios del Hotel:</label>
				
				<?php
							$oFCKeditor = new FCKeditor('get_servicioshoteles[' . $languages[$i]['id'] . ']') ;
							$oFCKeditor->BasePath = '../adapter/fckeditor/';
							$oFCKeditor->ToolbarSet = 'ISC_NOTICE' ;
							$oFCKeditor->Value = $data_content[0]['hoteles_txt_servicios'];
							$oFCKeditor->Config['SkinPath'] = _URL."/adapter/fckeditor/editor/skins/office2003/";
							$oFCKeditor->Height = 450;
							$oFCKeditor->Width =  570;
							$oFCKeditor->Create() ;
				?>
			</fieldset>
			<?php
			  }
			?>
			
			<?php
					for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
					$data_content = $cls_hoteles->get_hoteles_detail($IsHoteles,$languages[$i]['id']);
			?>
			 <fieldset>
					<label><?php print tep_image(DIR_WS_ADS_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;Descripcion de Habitaci&oacute;n:</label>
					
					<?php
						$oFCKeditor = new FCKeditor('get_habitacionhoteles[' . $languages[$i]['id'] . ']') ;
						$oFCKeditor->BasePath = '../adapter/fckeditor/';
						$oFCKeditor->ToolbarSet = 'ISC_NOTICE' ;
						$oFCKeditor->Value = $data_content[0]['hoteles_txt_habitacion'];
						$oFCKeditor->Config['SkinPath'] = _URL."/adapter/fckeditor/editor/skins/office2003/";
						$oFCKeditor->Height = 450;
						$oFCKeditor->Width =  570;
						$oFCKeditor->Create() ;
					 ?> 
			 </fieldset>
			<?php
				}
			?>
			
			
			<p>
				<label>Fecha de Ingreso:</label>
				<input name="get_datehoteles" type="text" class="input-short" id="get_datehoteles" value="<?php echo $cls_hoteles->gettxt_fecha()?>" title="Ingrese una fecha de ingreso" />
				<img src="calendar_picker/calendar_edit.png" name="icon_calendar" width="16" height="16" id="icon_calendar" />
				<span class="notification-input ni-correct" id="msg_datehoteles"></span>
			</p>
			
			
			 <p>
				<label>Vista Previa de Foto Destacada:</label>
				<?php
						$resize_img = base64_encode(ADMIN_PHOTOBIG_HOTELES.$cls_hoteles->gettxt_imagen()); 					 	
				?>
				<img src="resize.php?image=<?php print $resize_img?>&h=290&w=461" />
			</p>
			
			 <p>
				<label>Calidad del Hotel</label>
				 <select name="sle_estrellas" id="sle_estrellas" class="input-short">
					 <option value="1" <?php print ($cls_hoteles->gettxt_estrellas()==1)?'selected':'';?>>1 Estrella</option>
					 <option value="2" <?php print ($cls_hoteles->gettxt_estrellas()==2)?'selected':'';?>>2 Estrellas</option>
					 <option value="3" <?php print ($cls_hoteles->gettxt_estrellas()==3)?'selected':'';?>>3 Estrellas</option>
					 <option value="4" <?php print ($cls_hoteles->gettxt_estrellas()==4)?'selected':'';?>>4 Estrellas</option>
					 <option value="5" <?php print ($cls_hoteles->gettxt_estrellas()==5)?'selected':'';?>>5 Estrellas</option>
				</select>
				<span class="notification-input ni-correct" id="msg_calidad"></span>
			</p>
			
			 <p>
				<label>Precio Habitacion Simple:</label>
				<input class="input-short" type="text" name="txt_precio_simple" id="txt_precio_simple" value="<?php print $cls_hoteles->gettxt_precio_simple()?>" />
				<span class="notification-input ni-correct"></span>
			</p>
			
			 <p>
				<label>Precio Habitacion Doble:</label>
				<input class="input-short" type="text" name="txt_precio_doble" id="txt_precio_doble" value="<?php print $cls_hoteles->gettxt_precio_doble()?>" />	
				<span class="notification-input ni-correct"></span>
			</p>
			
			 <p>
				<label>Precio Habitacion  Triple:</label>
				<input class="input-short" type="text" name="txt_precio_triple" id="txt_precio_triple" value="<?php print $cls_hoteles->gettxt_precio_triple()?>" />	
				<span class="notification-input ni-correct"></span>
			</p>
			
			 <p>
				<label>Precio Habitacion Ni&ntilde;os:</label>
				<input class="input-short" type="text" name="txt_precio_nino" id="txt_precio_nino" value="<?php print $cls_hoteles->gettxt_precio_nino()?>" />	
				<span class="notification-input ni-correct"></span>
			</p>
			
			 <p>
				<label>Link de Hotel:</label>
				<input class="input-long" type="text" name="txt_link" id="txt_link" value="<?php print $cls_hoteles->gettxt_link()?>" />
				<span class="notification-input ni-correct"></span>
			</p>
			
			 <p>
				<label>Foto de Fachada:</label>
				<input name="file_hoteles" type="file" class="input-medium" id="file_hoteles"/>
				<input name="chk_remove" type="checkbox" id="chk_remove" title="Active la casilla si va a remover la imagen" value="1" />
				<input type="hidden" name="hidden_hoteles" id="hidden_hoteles" value="<?php print $cls_hoteles->gettxt_imagen()?>" /> 
			</p>
			
			<fieldset>
				<legend>Publicar Hotel:</legend>
				<ul>
					<li><label><input name="chk_publichoteles" type="checkbox" id="chk_publichoteles" value="1" <?php print ($cls_hoteles->gettxt_estado()==1)?'checked':'';?>/></label></li>
				</ul>
				<input type="hidden" name="id" id="id"  value="<?php print $IsHoteles?>"/>
			</fieldset>
			
			 <fieldset>
				<legend>Destacado:</legend>
				<ul>
					<li><label>
					<input name="chk_destacado" type="checkbox" id="chk_destacado" value="1" <?php print ($cls_hoteles->gettxt_destacado()==1)?'checked':'';?>/>
					</label></li>
				</ul>
			</fieldset>
			
			 <p>
				<label>Agregar Foto(s) del Hotel:</label>
				<input name="file[]" type="file"  class="multi input-medium" accept="jpeg|jpg"/>
			</p>
			
			 <p>
				<label>Foto de Hoteles:</label>
			  	<div id="container_photo_models">
				<?php print $cls_hoteles->listphotohoteles_gallery(); ?>
				</div>			   
			</p>
			
			<div style="clear:both;"></div>
			 
			<p>
			  <fieldset>

					<?php if($IsActionG==0) { ?>
					  <input type="Button" value="Actualizar Hotel"  class='submit-green' id="btn_save"/>
					<?php 	}
					else{?>
					<input type="Button" value="Guardar Hotel" class='submit-green' id="btn_save"/>
					 <?php }?>
					&nbsp;&nbsp;
					<input type="Button" value="Regresar" onClick="javascript:window.location='inf_hoteles.php'" class='submit-gray' />       
              </fieldset>
			</p>				
							
			  </form>
					</div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>

</div>

<script type="text/javascript" src="<?php print _URL?>admin/js/jquery.MultiFile.js" ></script>

<script language="javascript" type="text/javascript">
(function() {
   $("#btn_save").click(function(e){
	  
	  var submitButton = $("#btn_save");
      var $this = this; var status=true;

	  if(jQuery.trim($('#get_datehoteles').val())=="" || $('#get_datehoteles').val()=='0000-00-00' ){$("#msg_datehoteles").html($('#get_datehoteles').attr('title')).addClass('msg-error'); $('#get_datehoteles').focus(); status=false;
      }else{ $("#msg_datehoteles").html("").removeClass('msg-error');}
	
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

<script language="javascript" type="text/javascript">
$(function(){ 
$('#file_hoteles').MultiFile({ 
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
		
inputField     :    "get_datehoteles",     // id of the input field
ifFormat       :    "%Y-%m-%d",     // format of the input field
button         :    "icon_calendar",  // trigger button (well, IMG in our case)
showsTime      :     false

});

</script>

<?php
require_once("footer.php");
?>
